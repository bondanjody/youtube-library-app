<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        // Tampilkan semua video milik user yang login
        $videos = Video::with('category')
            ->where('created_by', Auth::user()->username)
            ->latest()
            ->get();

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::where('created_by', Auth::user()->username)->get();
        return view('videos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'link' => 'required|url|unique:videos,link',
            'category_id' => 'required|exists:categories,category_id',
        ]);

        Video::create([
            'title' => $request->title,
            'link' => $request->link,
            'category_id' => $request->category_id,
            'created_by' => Auth::user()->username,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil disimpan.');
    }

    public function edit(Video $video)
    {
        // Pastikan hanya pemilik video yang bisa edit
        if ($video->created_by !== Auth::user()->username) {
            abort(403);
        }

        $categories = Category::where('created_by', Auth::user()->username)->get();
        return view('videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        if ($video->created_by !== Auth::user()->username) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string',
            'link' => 'required|url|unique:videos,link,' . $video->id,
            'category_id' => 'required|exists:categories,category_id',
        ]);

        $video->update([
            'title' => $request->title,
            'link' => $request->link,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if ($video->created_by !== Auth::user()->username) {
            abort(403);
        }

        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
