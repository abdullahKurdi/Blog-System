<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->paginate(5);

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::whereSlug($slug)->first();
//        return response()->json($post);
        if ($post){
            return response()->json([
                "data"=>[
                    'id'=>$post->id,
                    'slug'=>$post->slug,
                    'body'=>$post->body,
                    'added_at'=>$post->created_at->diffForHumans(),
                    'comments_count'=>$post->comments->count(),
                    'image'=>$post->image,
                    'title'=>$post->title,
                    'user'=>$post->user,
                    'category'=>$post->category,
                    'comments'=> $this->formattedComment($post->comments),
                ],
                'status'=>200,
                'msg'=>'succsessfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'msg'=>'Not Found'
            ]);
        }
    }

    public function formattedComment($comments){
        $new_comments=[];
        foreach ($comments as $comment){
            array_push($new_comments , [
               'id'=>$comment->id,
               'body'=>$comment->body,
               'user'=>$comment->user,
               'added_at'=>$comment->created_at->diffForHumans()
            ]);
        }
        return $new_comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function categoryPost($slug)
    {
        $category = Category::whereSlug($slug)->first();
        //$posts = $category->posts;
        if ($category) {
            //$posts = $category->posts;
            $posts = Post::with('user')->where('category_id' ,$category->id)->get();
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
        }else{
            return response()->json([
                'status'=>404,
                'msg'=>'Not Found'
            ]);
        }

    }

    public function searchPost($query){
        $posts = Post::with('user')->where('title' ,'like','%'.$query.'%');
        $postsNumber = count($posts->get());

        if(intval($postsNumber) > 0){
            foreach ($posts->get() as $post){
                $post->setAttribute('add_at',$post->created_at->diffForHumans());
                $post->setAttribute('comments_count',$post->comments->count());
            }
            $posts = $posts->paginate(intval($postsNumber));
            return response()->json([
                'status'=>200,
                "data" =>$posts
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'msg'=>'There is no post'
            ]);
        }
    }
}
