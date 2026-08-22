<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\gambar;

class gambarcontrol extends Controller
{
    public function index()
    {
        $gambars = gambar::latest()->get();

        return view('gambar.index', compact('gambars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('gambar');

        $path = $file->store('gambar', 'public');

        gambar::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()
            ->route('gambar.index')
            ->with('success', 'Gambar berhasil diupload');
    }

    public function destroy(gambar $gambar)
    {
        Storage::disk('public')->delete($gambar->path);

        $gambar->delete();

        return redirect()
            ->route('gambar.index')
            ->with('success', 'Gambar berhasil dihapus');
    }
}