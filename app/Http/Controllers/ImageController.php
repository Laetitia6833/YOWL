<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $filename = '/images/' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('images'), $filename);
        }

        Image::create([
            'name' => $filename,
        ]);

        return response()->json(['message' => 'image added']);
    }
}
