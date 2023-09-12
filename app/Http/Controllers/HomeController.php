<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use App\Models\Greeting;
use App\Models\Overview;

class HomeController extends Controller
{
    public function slider_index() 
    {
        $sliders = Slider::latest()->paginate(10);
        return view('admin.home.slider.index', compact('sliders'));
    }

    public function slider_search(Request $request) 
    {
        $keyword = $request->cari;
        $sliders = Slider::where([
                                ['title', 'like', "%".$keyword."%"]
                                ])
                            ->orWhere([
                                ['subtitle', 'like', "%".$keyword."%"]
                                ])
                            ->latest()
                            ->paginate(10);
        return view('admin.home.slider.index', compact('sliders'));
    }

    public function welcome_index() 
    {
        $greeting = Greeting::first();
        return view('admin.home.welcome.index', compact('greeting'));
    }

    public function overview_index() 
    {
        $overview = Overview::first();
        return view('admin.home.overview.index', compact('overview'));
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
            'slider_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle',
            'slider_picture.required' => 'Masukkan Background Image',
            'slider_picture.image' => 'Harus Berupa Gambar',
            'slider_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'slider_picture.max' => 'Maksimal size 2mb'
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
            'subtitle.required' => 'Masukkan Subtitle'
        ]);

        Slider::where('id', $slider->id)
            ->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle
            ]);

        return back()->with('status', 'Slider Telah Berhasil Terupdate');
    }

    public function slider_picture_update(Request $request, Slider $slider)
    {
        $request->validate([
            'slider_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'slider_picture.image' => 'Harus Berupa Gambar',
            'slider_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'slider_picture.max' => 'Maksimal size 2mb'
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

    public function welcome_konten_update(Request $request, Greeting $greeting)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'yt_link' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle',
            'yt_link.required' => 'Masukkan Link Youtube'
        ]);

        Greeting::where('id', $greeting->id)
            ->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'yt_link' => $request->yt_link
            ]);

        return back()->with('status', 'Welcome Telah Berhasil Terupdate');
    }

    public function overview_konten_update(Request $request, Overview $overview)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle'
        ]);

        Overview::where('id', $overview->id)
            ->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle
            ]);

        return back()->with('status', 'Overview Telah Berhasil Terupdate');
    }

    public function welcome_picture_update(Request $request, Greeting $greeting)
    {
        $request->validate([
            'greeting_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'greeting_picture.image' => 'Harus Berupa Gambar',
            'greeting_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'greeting_picture.max' => 'Maksimal size 2mb'
        ]);

        $pic = $request->file('greeting_picture');
        $pic_name = $greeting->greeting_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Greeting::where('id', $greeting->id)
            ->update([
                'greeting_picture' => $pic_name
            ]);

        return back()->with('status', 'Welcome Picture Telah Berhasil Terupdate');
    }

    public function welcome_file_update(Request $request, Greeting $greeting)
    {
        $request->validate([
            'greeting_file' => 'required|mimes:pdf|max:30000'
        ],
        [
            'greeting_file.mimes' => 'Format yang didukung hanya .pdf',
            'greeting_file.max' => 'Maksimal size 30mb'
        ]);

        $files = $request->file('greeting_file');
        $file_name = $greeting->greeting_file;
        $file_dir = public_path('assets');
        $files->move($file_dir, $file_name);

        Greeting::where('id', $greeting->id)
            ->update([
                'greeting_file' => $file_name
            ]);

        return back()->with('status', 'Welcome File Telah Berhasil Terupdate');
    }

    public function overview_picture_update(Request $request, Overview $overview)
    {
        $request->validate([
            'overview_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'overview_picture.image' => 'Harus Berupa Gambar',
            'overview_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'overview_picture.max' => 'Maksimal size 2mb'
        ]);

        $pic = $request->file('overview_picture');
        $pic_name = $overview->overview_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Overview::where('id', $overview->id)
            ->update([
                'overview_picture' => $pic_name
            ]);

        return back()->with('status', 'Overview Picture Telah Berhasil Terupdate');
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
