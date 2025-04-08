<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{

    public function index()
    {
        return $this->apiResponse(
            PostResource::collection(Post::latest('id')->paginate())
        );
    }


    public function show(Post $post)
    {
        return $this->apiResponse(
             new PostResource($post)
        );
    }


    public function store(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if($Validator->fails()){
            return $this->apiResponse([], 422, $Validator->errors()->first());
        }

        auth('api')->user()->posts()->create(
            $request->only('title', 'content')
        );

        return $this->apiResponse([], 201);
    }


    public function update(Request $request, Post $post)
    {
        if($post->user_id !== auth('api')->id()) {
            return $this->apiResponse([], 403, 'you dont can update this post');
        }

        $Validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        if($Validator->fails()){
            return $this->apiResponse([], 422, $Validator->errors()->first());
        }

        $post->update($request->only('title', 'content'));

        return $this->apiResponse(new PostResource($post));
    }


    public function destroy(Post $post)
    {
        if($post->user_id !== auth('api')->id()) {
            return $this->apiResponse([], 403, 'you dont can delete this post');
        }

        $post->delete();

        return $this->apiResponse([]);
    }
}
