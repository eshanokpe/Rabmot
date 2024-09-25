<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use Auth;

class TopicCommentController extends Controller
{
    public function index()
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
        dd($topic);

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

    public function storeComment(Request $request, $topicId)
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

    public function editComment($topic, $comment)
    {
       
        $topic = Topic::findOrFail($topic);
        $comment = Comment::findOrFail($comment);
        if($topic){
            
        }

        return view('user.pages.topics.edit', compact('topic', 'comment'));
    }

    public function updateComment(Request $request, $topicId, $commentId)
    {
        $comment = Comment::find($commentId);
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('topics.show', $topicId);
    }

    public function destroyComment($topic, $comment)
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
}
 