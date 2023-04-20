<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page') ?? 1;
        $per_page = $request->query('per_page') ?? 20;
        $users = Http::get("https://gorest.co.in/public/v2/users?page={$page}&per_page={$per_page}");
        return response()->json([
            'users' =>json_decode($users->body())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $body = $request->except('token');
        $token = $request->header('Authorization');
        $user = Http::withHeaders(["Authorization" => $token])->post("https://gorest.co.in/public/v2/users/", $body);
        return response()->json([
            'new_user' =>json_decode($user->body())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Http::get("https://gorest.co.in/public/v2/users/{$id}");
        return response()->json([
            'user' =>json_decode($user->body())
        ]);
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
    public function destroy(string $id)
    {
        //
    }
}
