<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $firstPost = Http::get("https://gorest.co.in/public/v2/posts?page=1&per_page=1");
        $post = json_decode($firstPost);
        $body = [
            "name" => "salve jorge comentario name",
            "email" => "testecomment@email.com",
            "body" => "salve jorge comentario body"
        ];
        
        $token = $request->header('Authorization');
        $post_comment = Http::withHeaders(["Authorization" => $token])->post("https://gorest.co.in/public/v2/posts/{$post[0]->id}/comments", $body);
        
        return response()->json([
            'post_comment' =>json_decode($post_comment->body())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $userID)
    {
        $body = $request->except('token');
        $token = $request->header('Authorization');
        $post = Http::withHeaders(["Authorization" => $token])->post("https://gorest.co.in/public/v2/users/{$userID}/posts", $body);
        return response()->json([
            'user_post' =>json_decode($post->body())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request)
    // {
    //     $firstPost = Http::get("https://gorest.co.in/public/v2/posts?page=1&per_page=1");
    //     $post = json_decode($firstPost);
    //     $body = [
    //         "name" => "salve jorge comentario name",
    //         "email" => "testecomment@email.com",
    //         "body" => "salve jorge comentario body"
    //     ];
        
    //     $token = $request->header('Authorization');
    //     $post_comment = Http::withHeaders(["Authorization" => $token])->delete("https://gorest.co.in/public/v2/posts/{$post[0]->id}/comments", $body);
        
    //     return response()->json([
    //         'post_comment' =>json_decode($post_comment->body())
    //     ]);
    // }
}
