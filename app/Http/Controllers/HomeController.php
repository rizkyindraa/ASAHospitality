<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Slider;

class HomeController extends Controller
{
    public function slider_index() 
    {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.home.slider.index', compact('sliders'));
    }

    public function slider_create() 
    {
        return view('admin.home.slider.createslider');
    }

    public function slider_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'slider_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1280,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle',
            'slider_picture.required' => 'Masukkan Background Image',
            'slider_picture.image' => 'Harus Berupa Gambar',
            'slider_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'slider_picture.max' => 'Maksimal size 2mb',
            'slider_picture.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1280x720'
        ]);

        $pic = $request->file('slider_picture');
        $file = public_path('/assets');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slider_picture' => $pic_name
        ]); 
        return redirect('/slider')->with('status', 'Slider Berhasil Disimpan !');
    }

    public function slider_update(Slider $slider) 
    {
        return view('admin.home.slider.editslider', compact('slider'));
    }

    public function slider_konten_update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Pilih Subtitle'
        ]);

        Slider::where('id', $slider->id)
            ->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle
            ]);

        return back()->with('status', 'Slider Telah Berhasil Terupdate');
    }

    public function slider_picture_update(Request $request, SLider $slider)
    {
        $request->validate([
            'slider_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1270,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'slider_picture.image' => 'Harus Berupa Gambar',
            'slider_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'slider_picture.max' => 'Maksimal size 2mb',
            'slider_picture.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1280x720'
        ]);

        $pic = $request->file('slider_picture');
        $pic_name = $slider->slider_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Slider::where('id', $slider->id)
            ->update([
                'slider_picture' => $pic_name
            ]);

        return back()->with('status', 'Backgroud Image Telah Berhasil Terupdate');
    }

    public function destroy_slider($id)
    {
        $slider = Slider::findorfail($id);
        $file = public_path('/assets/').$slider->slider_picture;
        if (file_exists($file)) {
            @unlink($file);
        }
        $slider->delete();
        return back()->with('delete', 'Slider Telah Terhapus !');
    }
}
