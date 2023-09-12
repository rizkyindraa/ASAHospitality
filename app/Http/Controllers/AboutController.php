<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\About;

class AboutController extends Controller
{
    public function about_index() 
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    public function about_konten_update(Request $request, About $about)
    {   
        $request->validate([
            'title' => 'required',
            'post' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'post.required' => 'Masukkan Post'
        ]); 

        About::where('id', $about->id)
            ->update([
                'title' => $request->title,
                'post' => $request->post,
            ]);   
        return back()->with('status', 'About Berhasil Terupdate');
    }

    public function about_foto_update(Request $request, About $about)
    {
        $request->validate([
            'about_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'about_picture.image' => 'Harus Berupa Gambar',
            'about_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'about_picture.max' => 'Maksimal size 2mb'
        ]);

        $pic = $request->file('about_picture');
        $pic_name = $about->about_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1270, 720, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        About::where('id', $about->id)
            ->update([
                'about_picture' => $pic_name
            ]);

        return back()->with('status', 'Foto Telah Berhasil Terupdate');
    }
}
