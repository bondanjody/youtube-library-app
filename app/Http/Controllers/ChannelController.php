<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::where('created_by', Auth::user()->username)->get();
        return view('channels.index', compact('channels'));
    }

    public function create()
    {
        return view('channels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel_name' => 'required|string|max:100',
            'channel_url' => 'required|url|unique:channels,channel_url',
        ]);

        Channel::create([
            'channel_name' => $request->channel_name,
            'channel_url' => $request->channel_url,
            'created_by' => Auth::user()->username,
        ]);

        return redirect()->route('channels.index')->with('success', 'Channel berhasil ditambahkan.');
    }

    public function edit(Channel $channel)
    {
        $this->authorizeChannel($channel);
        return view('channels.edit', compact('channel'));
    }

    public function update(Request $request, Channel $channel)
    {
        $this->authorizeChannel($channel);

        $request->validate([
            'channel_name' => 'required|string|max:100',
            'channel_url' => 'required|url|unique:channels,channel_url,' . $channel->channel_id . ',channel_id',
        ]);

        $channel->update($request->only(['channel_name', 'channel_url']));

        return redirect()->route('channels.index')->with('success', 'Channel berhasil diperbarui.');
    }

    public function destroy(Channel $channel)
    {
        $this->authorizeChannel($channel);
        $channel->delete();
        return redirect()->route('channels.index')->with('success', 'Channel berhasil dihapus.');
    }

    // Cek apakah user adalah pemilik channel
    private function authorizeChannel(Channel $channel)
    {
        if ($channel->created_by !== Auth::user()->username) {
            abort(403, 'Tidak diizinkan.');
        }
    }
}
