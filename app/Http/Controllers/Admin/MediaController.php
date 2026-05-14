<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:webp,png,jpg,jpeg,svg,gif,mp4,webm|max:20480',
        ]);

        $path = $request->file('file')->store('media', 'public');

        $media = Media::create([
            'filename'    => $request->file('file')->getClientOriginalName(),
            'path'        => $path,
            'mime_type'   => $request->file('file')->getMimeType(),
            'size'        => $request->file('file')->getSize(),
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'url'     => Storage::disk('public')->url($path),
            'id'      => $media->id,
        ]);
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->path);
        $media->delete();
        return response()->json(['success' => true]);
    }
}
