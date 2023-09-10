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
            'about_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=600,min_height=800,max_width=4000,max_height=4000'
        ],
        [
            'about_picture.image' => 'Harus Berupa Gambar',
            'about_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'about_picture.max' => 'Maksimal size 2mb',
            'about_picture.dimensions' => 'Resolusi Gambar Harus Lebih Dari 600x800'
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
