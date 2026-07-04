<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Exception;
use Redirect;
use SeerbitLaravel\Facades\Seerbit; 
use App\Models\PaymentModel;
use App\Models\ProcessHistory;
use App\Models\NewDriverLicense;
use App\Models\VehicleRegistration;
use App\Models\ChangeOfOwnership;
use App\Models\InternationalDriverLicense;
use App\Models\DealerPlateNumber;
use App\Models\VehiclePaperRenewal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Cart;
use App\Models\User;
use App\Mail\PendingMode;
use App\Mail\WelcomeWithCredentialsMail;
use Mail;
use App\Mail\InvoiceMail;
use Carbon\Carbon;

class PaymentController extends Controller
{
    // Remove auth middleware so guests can access
    public function __construct()
    {
        // No auth middleware here
    }

    public function initiatePayment(Request $request)
    {
        // Get data from request OR session (works for both GET and POST)
        $orderNo         = $request->input('orderNo')       ?? session('orderNo');
        $total           = $request->input('total')         ?? session('total');
        $fullname        = $request->input('fullname')      ?? session('fullname');
        $email           = $request->input('email')         ?? session('email');
        $process_id      = $request->input('process_id')    ?? session('process_id');
        $process_type    = $request->input('process_type')  ?? session('process_type');
        $address         = $request->input('address')       ?? session('address');
        $delivery_option = $request->input('delivery_option') ?? session('delivery_option');
        $scan_email      = $request->input('scan_email')    ?? session('scan_email');
        $location        = $request->input('location')      ?? session('location');
        $lagos_address   = $request->input('lagos_address') ?? session('lagos_address');

        // Validate required fields
        if (!$orderNo || !$email || !$process_id || !$total) {
            return redirect()->route('home')->with('error', 'Missing required payment details.');
        }

        $amount = (float) str_replace(',', '', $total);
        $transaction_ref = 'SB-' . strtoupper(bin2hex(random_bytes(6)));
 
        $payload = [
            "amount"            => $amount,
            "callbackUrl"       => route('home.payment'),
            "country"           => "NG",
            "currency"          => "NGN",
            "email"             => $email,
            "full_name"         => $fullname,
            "paymentReference"  => $transaction_ref,
            "productType"       => $process_type,
            "productId"         => $process_id,
            "address"           => $address,
            "delivery_option"   => $delivery_option,
            "scan_email"        => $scan_email,
            "location"          => $location,
        ];

        // Initialize payment
        $paymentResponse = Seerbit::Standard()->Initialize($payload);
        $redirectLink = $paymentResponse['data']['payments']['redirectLink'] ?? null;
        $statusMsg = $paymentResponse['data']['message'] ?? '';

        if ($statusMsg === "Successful" && $redirectLink) {
            // Save payment record
            $payment = PaymentModel::create([
                'process_id'        => $process_id,
                'process_type'      => $process_type,
                'paymentReference'  => $transaction_ref,
                'full_name'         => $fullname,
                'email'             => $email,
                'orderNo'           => $orderNo,
                'address'           => $address ?? '',
                'location'          => $location ?? '',
                'scan_email'        => $scan_email ?? '',
                'lagos_address'     => $lagos_address ?? '',
                'delivery_option'   => $delivery_option ?? '',
                'amount'            => $amount,
                'status'            => "0",
            ]);

            // Get phone safely (only if logged in)
            $phone = Auth::check() ? Auth::user()->phone : '';

            // Send invoice email
            try {
                $invoiceDate = Carbon::now()->format('dm');
                $invoiceCount = PaymentModel::whereDate('created_at', Carbon::today())->count() + 1;
                $invoiceNumber = $invoiceDate . str_pad($invoiceCount, 3, '0', STR_PAD_LEFT);

                // Get application data based on service type
                $application = match(true) {
                    $process_type === 'New Driver License'                       => NewDriverLicense::where('process_id', $process_id)->first(),
                    $process_type === 'New Vehicle Registration (Lagos)'         => VehicleRegistration::where('process_id', $process_id)->first(),
                    $process_type === 'Change of Ownership & Re-Registration'   => ChangeOfOwnership::where('process_id', $process_id)->first(),
                    $process_type === "International Driver's License"           => InternationalDriverLicense::where('process_id', $process_id)->first(),
                    $process_type === "Dealer's Plate Number"                   => DealerPlateNumber::where('process_id', $process_id)->first(),
                    $process_type === 'Vehicle Papers Renewal'                  => VehiclePaperRenewal::where('process_id', $process_id)->first(),
                    default => null
                };

                Mail::to($email)->send(new InvoiceMail(
                    $orderNo,
                    $fullname,
                    $email,
                    $phone,
                    [],
                    collect([(object)['name' => $process_type, 'price' => $amount]]),
                    $amount,
                    $invoiceNumber,
                    Carbon::now()->format('M d, Y'),
                    $application
                ));
            } catch (Exception $e) {
                \Log::warning('Invoice email failed: ' . $e->getMessage());
            }

            return redirect($redirectLink);
        }

        return redirect()->back()->with('error', 'Failed to initialize payment. Please try again.');
    }

    public function handleGatewayCallbackSeerbit(Request $request)
    {
        $data = $request->all();

        if (isset($data['message']) && $data['message'] === "Successful") {
            $ref_id = $data['reference'];
            $trans_id = $data['linkingreference'];

            // Get payment record
            $payment = PaymentModel::where('paymentReference', $ref_id)->firstOrFail();
            $payment->update([
                'trans_id' => $trans_id,
                'status'   => 'Successful',
            ]);

            // Update Order status
            Order::where('order_number', $payment->orderNo)->update(['status' => 'paid']);

            // Update application status based on service type
            switch ($payment->process_type) {
                case 'New Driver License':
                    NewDriverLicense::where('process_id', $payment->process_id)
                        ->update(['payment_status' => 'paid', 'status' => 'processing']);
                    break;

                case 'New Vehicle Registration (Lagos)':
                    VehicleRegistration::where('process_id', $payment->process_id)
                        ->update(['payment_status' => 'paid', 'status' => 'processing']);
                    break;

                case 'Change of Ownership & Re-Registration':
                    ChangeOfOwnership::where('process_id', $payment->process_id)
                        ->update(['payment_status' => 'paid', 'status' => 'processing']);
                    break;

                case "International Driver's License":
                    // No status/payment_status columns on this table; tracked via Order + ProcessHistory instead.
                    break;

                case "Dealer's Plate Number":
                    DealerPlateNumber::where('process_id', $payment->process_id)
                        ->update(['payment_status' => 'paid']);
                    break;

                case 'Vehicle Papers Renewal':
                    VehiclePaperRenewal::where('process_id', $payment->process_id)
                        ->update(['payment_status' => 'paid']);
                    break;
            }

            // Resolve owning user (may be null for guests)
            $ownerUser = User::where('email', $payment->email)->first();

            // Create Process History
            ProcessHistory::create([
                'user_id'         => $ownerUser ? $ownerUser->id : null,
                'owner_id'        => null,
                'userType'        => $ownerUser ? 'user' : 'guest',
                'user_email'      => $payment->email,
                'process_number'  => $payment->orderNo,
                'process_id'      => $payment->process_id,
                'process_type'    => $payment->process_type,
                'totalamount'     => $payment->amount,
                'location'        => $payment->location,
                'lagos_address'   => $payment->lagos_address,
                'address'         => $payment->address,
                'delivery_option' => $payment->delivery_option,
                'scan_email'      => $payment->scan_email,
                'status'          => 1,
            ]);

            // Auto-create account for guest users (first-time payers without an account)
            $accountCreated = false;
            $tempPassword   = null;

            if (!$ownerUser) {
                $tempPassword = Str::random(10);
                $phone        = $this->resolvePhone($payment);

                $ownerUser = User::create([
                    'fullname'    => $payment->full_name,
                    'email'       => $payment->email,
                    'phone'       => $phone,
                    'password'    => bcrypt($tempPassword),
                    'email_token' => Str::random(60),
                ]);

                $accountCreated = true;
            }

            // Send welcome + credentials email for new accounts
            if ($accountCreated) {
                try {
                    Mail::to($payment->email)->send(new WelcomeWithCredentialsMail(
                        $payment->full_name,
                        $payment->email,
                        $tempPassword,
                        $payment->process_type,
                        $payment->process_id,
                        $payment->amount
                    ));
                } catch (Exception $e) {
                    \Log::warning('Welcome credentials email failed: ' . $e->getMessage());
                }
            }

            // Send order pending confirmation email
            try {
                $mailUser = (object)['fullname' => $payment->full_name, 'email' => $payment->email];
                Mail::to($payment->email)->send(new PendingMode($mailUser));
            } catch (Exception $e) {
                \Log::error('Confirmation email failed: ' . $e->getMessage());
            }

            // Redirect to success page
            return redirect()->route('application.success', ['ref' => $payment->orderNo])
                ->with('success', 'Payment completed successfully! Your application is now being processed.');
        }

        return redirect()->route('home')->with('error', 'Payment not completed or failed.');
    }

    /**
     * Display payment success page
     */
    public function success(Request $request)
    {
        $orderNo = $request->query('ref');
        
        // Find the order
        $order = Order::where('order_number', $orderNo)->first();
        
        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found.');
        }
        
        // ✅ Get application details based on service type
        $application = null;
        if ($order->process_id) {
            $payment = PaymentModel::where('process_id', $order->process_id)->first();
            $processType = $payment->process_type ?? '';

            $application = match(true) {
                $processType === 'New Driver License'                       => NewDriverLicense::where('process_id', $order->process_id)->first(),
                $processType === 'New Vehicle Registration (Lagos)'         => VehicleRegistration::where('process_id', $order->process_id)->first(),
                $processType === 'Change of Ownership & Re-Registration'    => ChangeOfOwnership::where('process_id', $order->process_id)->first(),
                $processType === "International Driver's License"           => InternationalDriverLicense::where('process_id', $order->process_id)->first(),
                $processType === "Dealer's Plate Number"                    => DealerPlateNumber::where('process_id', $order->process_id)->first(),
                $processType === 'Vehicle Papers Renewal'                   => VehiclePaperRenewal::where('process_id', $order->process_id)->first(),
                default => null
            };
        }

        return view('frontend.pages.products.application-success', [
            'order'       => $order,
            'application' => $application,
            'reference'   => $order->order_number,
        ]);
    }

    /**
     * Resolve the applicant's phone number from the application record.
     * IDL and DPN store phonenumber; VPR does not have it.
     */
    protected function resolvePhone($payment): ?string
    {
        switch ($payment->process_type) {
            case "International Driver's License":
                $app = InternationalDriverLicense::where('process_id', $payment->process_id)->first();
                return $app->phonenumber ?? null;

            case "Dealer's Plate Number":
                $app = DealerPlateNumber::where('process_id', $payment->process_id)->first();
                return $app->phonenumber ?? null;

            default:
                return null;
        }
    }
}