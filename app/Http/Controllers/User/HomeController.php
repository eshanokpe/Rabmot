<?php

namespace App\Http\Controllers\User;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\AddVehicleRenewal;
use App\Models\User;
use App\Models\VehicleType;
use App\Models\Processhistory;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $user = Auth::user(); 
        $user = User::find($id);

        $tokenCount = $user->latestTokenCount();
        $referralsCount = $user->referrer_count;
        $referralLink = route('signup') . '?ref=' . $user->referral_code;
        $vehicle = AddVehicleRenewal::where('user_id', $id)->get();
        $vehicleCount = $vehicle->count(); 
        $getaddvehicle = AddVehicleRenewal::with('vehicleTypeInfo')->where('user_id', $id)->get();
        
        return view('user.home', compact('vehicleCount','getaddvehicle','referralLink', 'referralsCount','tokenCount'));
    }
 
    public function addvehicle()
    {
        $id = Auth::user()->id;
        $vehicleList = VehicleType::all();

        return view('user.pages.addvehicle', compact('vehicleList'));
    }

    public function processHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $processhistory = ProcessHistory::where('user_id', $id)
                                        ->latest()
                                        ->get();

        return view('user.pages.processhistory', compact('id', 'email', 'processhistory'));
    }

    public function deleteprocesshistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Process History deleted successfully', 
        ]);
    }

    public function transactionHistory()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $transactionhistory = ProcessHistory::where('user_id', $id)
                                       // ->where('status',0)
                                        ->get();

        return view('user.pages.transactionhistory', compact('id', 'email', 'transactionhistory'));
    }

    public function deletetransactionhistory(Request $request){
        $id =  $request->itemId;
        $history = ProcessHistory::findOrFail($id);
        $history->delete();
        return response()->json([
            'message' => 'Transaction History deleted successfully', 
        ]);
    }

    public function Profile(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        $userdetails = User::where('id', '=', $id)->first();
       return view('user.pages.profile.profile', compact('userdetails'));
    }

    public function editprofile(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        
        $userdetails = User::where('id', '=', $id)->first();
        return view('user.pages.profile.editprofile', compact('userdetails'));
    }
    public function updateProfile(Request $request){
        $validated = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ]); 
 
        # check if user profile image is null, then validate
        if (auth()->user()->profile_image == null) {
             $validate_image = Validator::make($request->all(), [
                'profile_image' => ['required', 'image', 'max:1000']
            ]);
             # check if their is any error in image validation
            if ($validate_image->fails()) {
                return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
            }
        }
 
        # check if their is any error
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }
        $imageName = auth()->user()->profile_image ;
 
        # check if the request has profile image
        if ($request->hasFile('profile_image')) {
             // Delete old image if it exists
            if (auth()->user()->profile_image) {
                // Delete the old image from the public directory
                $oldImagePath = public_path('assets/profileimages/') . auth()->user()->profile_image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('profile_image');
            $profile_image = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/profileimages'), $profile_image);
            $imageName = $profile_image;
        }
        
 
        # update the user info
        auth()->user()->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'profile_image' => $imageName
        ]);
        return response()->json(['code' => 200, 'msg' => 'Profile updated successfully.']);
    }

    public function indexT()
    {
        $topics = Topic::all();
 
        return view('user.pages.topics.index', compact('topics'));
    }
    public function create()
    {
        return view('user.pages.topics.create');
    }

    public function store(Request $request)
    {
        $topic_id= 'TOPIC' . Str::random(4);
        $authors_id = Auth::user()->id;
        $fullname = Auth::user()->fullname;
        $email = Auth::user()->email;

        //dd($request->input());
        $topic = new Topic();
        $topic->topic_id = $topic_id;
        $topic->title = $request->input('title');
        $topic->content = $request->input('content');
        $topic->author = $fullname;
        $topic->author_pics = $email;
        $topic->save();

        return redirect()->route('topics.index');
    }

       
    public function show($id){
        $topic = Topic::findOrFail($id);
        return view('user.pages.topics.show', compact('topic'));
    }

    public function edit($id)
    {
        $topic = Topic::find($id);

        return view('user.pages.topics.edit', compact('topic'));
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->title = $request->input('title');
        $topic->content = $request->input('content');
        $topic->save();

        return redirect()->route('topics.index');
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();

        return redirect()->route('topics.index');
    }

    public function storeC(Request $request, $topicId)
    {
        $commentId = 'COMMENT' . Str::random(4);
        
        $authors_id = Auth::user()->id;
        $fullname = Auth::user()->fullname;
        $email = Auth::user()->email;

        $comment = new Comment();
        $comment->topic_id = $topicId;
        $comment->comment_id = $commentId;
        $comment->content = $request->input('content');
        $comment->author = $fullname;
        $comment->author_pics = $email;
        $comment->save();

        return redirect()->route('topics.show', $topicId);
    }

    public function editC($topic, $comment)
    {
        $topic = Topic::findOrFail($topic);
        $comment = Comment::findOrFail($comment);

        return view('user.pages.topics.edit', compact('topic', 'comment'));
    }

    public function updateC(Request $request, $topicId, $commentId)
    {
        $comment = Comment::find($commentId);
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('topics.show', $topicId);
    }

    public function destroyC($topic, $comment)
    {
        
        $comment = Comment::where('topic_id', $topic)->where('id', $comment)->first();
        //dd($comment);
        if ($comment) {
            // Delete the comment
            $comment->delete();

            // Redirect back to the previous page with a success message
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            // Comment not found, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to delete the comment.');
        }
    }
   
    public function faq()
    {
        $id = Auth::user()->id;
        $email = Auth::user()->email;

       return view('user.pages.faq', compact('id', 'email'));
    }

}
