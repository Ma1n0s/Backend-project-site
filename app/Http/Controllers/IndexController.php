<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // Метод для загрузки изображения
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('image')) {
            
            if ($user->img) {
                Storage::delete('public/' . $user->img);
            }

            $path = $request->file('image')->store('images', 'public');
            $user->img = $path; 
            // $user->save();
        }

        return response()->json(['message' => 'Image uploaded successfully!', 'img' => $user->img]);
    }

    public function getImage()
    {
        $user = Auth::user();
        return response()->json(['img' => $user->img]);
    }
}

