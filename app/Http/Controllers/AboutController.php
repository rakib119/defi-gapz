<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{


    public function edit()
    {
        return view('backend.about.edit', [
            'about' => About::first()
        ]);
    }


    public function update(Request $request)
{
        $about = About::first();
        $request->validate([
            'photo' => 'nullable|mimes:jpg,jpeg,png',
            'description' => 'required',
        ]);
        if ($request->hasFile('photo')) {
            $base_path = public_path('dashboard/assets/about/');
            $old_path = $base_path . $about->photo;
            if (file_exists($old_path)) {
                unlink($old_path);
            }
            // get file extention
            $photo_name = Str::random(15) . "." . $request->file('photo')->getClientOriginalExtension();
            Image::make($request->file('photo'))->save($base_path . $photo_name);
            $about->photo = $photo_name;
            $about->save();
        }
        $about->description = $request->description;
        $about->save();
        return back()->with("success", "success");
    }
}
