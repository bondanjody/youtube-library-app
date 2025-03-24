<?php

namespace App\Http\Controllers\API;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChannelAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username = Auth::user()->username;

        $channels = Channel::where('created_by', $username)->get();

        return response()->json(['data' => $channels], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'channel_name' => 'required|string|max:100',
            'channel_url' => 'required|url|unique:channels,channel_url',
        ]);

        $channel = Channel::create([
            'channel_name' => $request->channel_name,
            'channel_url' => $request->channel_url,
            'created_by' => $request->user()->username,
        ]);

        return response()->json(['message' => 'Channel berhasil ditambahkan', 'data' => $$channel], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
