<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;
use Carbon\Carbon;
use Cart;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();
        return view('admin.pages.promoCodes.index', compact('promoCodes'));
    }

    public function create()
    {
        return view('admin.pages.promoCodes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promo_codes',
            'discount_percentage' => 'required|integer|min:1|max:100',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'usage_limit' => 'nullable|integer|min:1',
        ], [
            'end_datetime.after' => 'The end date must be later than the start date.',
        ]);
        try{
            PromoCode::create($request->all());
            return redirect()->back()->with('success', 'Promo code created successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $promoCode = PromoCode::findOrFail(decrypt($id)); // Find the promo code by ID or throw a 404 error.
        return view('admin.pages.promoCodes.edit', compact('promoCode')); // Return the edit view with promo code data.
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:promo_codes,code,' . $id,
            'discount_percentage' => 'required|numeric|min:1|max:100',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'usage_limit' => 'nullable|integer|min:1',
            'status' => 'required|in:active,expired,deactivated',
        ], [
            'end_datetime.after' => 'The end date must be later than the start date.',
        ]);

        $promoCode = PromoCode::findOrFail($id); // Find the promo code by ID or throw a 404 error.

        // Update promo code attributes
        $promoCode->update([
            'code' => $request->code,
            'discount_percentage' => $request->discount_percentage,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'usage_limit' => $request->usage_limit,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.promocode.index')->with('success', 'Promo code updated successfully.');
    }

    public function applyPromoCode(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
        ]);
        // dd('promoCode');

        $currentDatetime = Carbon::now('Africa/Lagos');
        $promoCode = PromoCode::where('code', $request->promo_code)
            ->where('status', 'active')
            ->where('start_datetime', '<=', $currentDatetime)  
            ->where('end_datetime', '>=', $currentDatetime)  
            ->first();
        if (!$promoCode) {
            return back()->with('error', 'Invalid or expired promo code.');
        }

        // Check usage limit, if applicable
        if ($promoCode->usage_limit !== null && $promoCode->times_used >= $promoCode->usage_limit) {
            return back()->with('error', 'Promo code usage limit has been reached.');
        }
        if ($promoCode) {
            // Calculate the new total based on the discount
            $cartTotal = preg_replace('/[^\d.]/', '', Cart::total());
            
            $discountPercentage = (float) $promoCode->discount_percentage;  // Cast to float if needed

            // dd($promoCode->discount_percentage);
            $discountAmount = ($cartTotal * $discountPercentage) / 100;
            $newTotal = $cartTotal - $discountAmount;
    
            // Flash the new total to the session (only for the current request)
            session()->flash('promo_applied', true);
            session()->flash('new_total', $newTotal);
        } else {
            session()->flash('promo_applied', false);
            session()->flash('new_total', null);
        }

        // Increment usage count
        $promoCode->increment('times_used');

        return back()->with('success', "Promo code applied! You received a {$discountPercentage}% discount.");
    }



}
