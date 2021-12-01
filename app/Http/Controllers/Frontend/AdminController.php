<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
         $this->middleware(['admin']);
    }

    public function getPost(){
        $posts = Post::with(['user','category'])->paginate(5);

        if($posts){
            foreach ($posts as $post){
                $post->setAttribute('add_at',$post->created_at->diffForHumans());
                $post->setAttribute('comments_count',$post->comments->count());
            }
            return response()->json([
                'status'=>200,
                "data" =>$posts
            ]);
        }else{
            return response()->json([
                'status'=>200,
                'msg'=>'There is no post'
            ]);
        }
    }

    public function getCategory(){
        $categories = Category::all();
        if($categories){
            return response()->json([
                'status'=>200,
                "data" =>$categories
            ]);
        }else{
            return response()->json([
                'status'=>200,
                'msg'=>'There is no post'
            ]);
        }
    }
    public function addPost(Request $request)
    {
        //validation
        $filename ='';
        if($request->hasFile('image')){
            $filename = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('assets/img'),$filename);
        }
        $post = Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'category_id'=>$request->category_id,
            'user_id'=>Auth::id(),
            'image'=>$filename,
            'slug'=>Str::slug($request->title),
        ]);
        if($post){
            return response()->json(['data'=>$post]);
        }else{
            return response()->json(['msg']);
        }
    }
    public function updatePost(Request $request)
    {
        //validation
        $post = Post::find($request->id);
        //$filename = $post->image;

        if($request->hasFile('image')){
            $post->image = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('assets/img'),$post->image);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->slug = Str::slug($request->title);
        //$post->image != '' ?$filename : $post->image;

        $post->save();

        return response()->json(['data'=>$post]);

    }
    public function deletePosts(Request $request){
        $ids = $request->posts_ids;
        DB::table('posts')->whereIn('id',$ids)->delete();
        return response()->json(['message'=>'deleted']);
    }

}
