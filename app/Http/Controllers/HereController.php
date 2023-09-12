<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Way;

class HereController extends Controller
{
    public function here_index() 
    {
        $ways = Way::latest()->paginate(10);
        return view('admin.here.index', compact('ways'));
    }

    public function Here_search(Request $request)
    {
        $keyword = $request->cari;
        $ways = Way::where([
                                ['way_name', 'like', "%".$keyword."%"]
                            ])
                            ->orWhere([
                                ['subtitle', 'like', "%".$keyword."%"]
                                ])
                            ->latest()->paginate(10);
        return view('admin.here.index', compact('ways'));
    }

    public function here_create() 
    {
        return view('admin.here.createhere');
    }

    public function here_edit(Way $way) 
    {
        return view('admin.here.edithere', compact('way'));
    }

    public function here_store(Request $request)
    {
        $request->validate([
            'way_name' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'way_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'way_name.required' => 'Masukkan How to Get Here',
            'subtitle.required' => 'Masukkan Subtitle',
            'description.required' => 'Masukkan Deskripsi',
            'way_picture.required' => 'Masukkan Gambar',
            'way_picture.image' => 'Harus Berupa Gambar',
            'way_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'way_picture.max' => 'Maksimal size 2mb',
        ]);

        $pic = $request->file('way_picture');
        $file = public_path('/assets');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(800, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Way::create([
            'way_name' => $request->way_name,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'way_picture' => $pic_name
        ]); 
        return redirect('/get_here')->with('status', 'How to Get Here Berhasil Disimpan');
    }

    public function here_konten_update(Request $request, Way $way)
    {   
        $request->validate([
            'way_name' => 'required',
            'subtitle' => 'required',
            'description' => 'required'
        ],
        [
            'way_name.required' => 'Masukkan How to Get Here',
            'subtitle.required' => 'Masukkan Subtitle',
            'description.required' => 'Masukkan Deskripsi'
        ]); 

        Way::where('id', $way->id)
            ->update([
                'way_name' => $request->way_name,
                'subtitle' => $request->subtitle,
                'description' => $request->description
            ]);   
        return back()->with('status', 'How to Get Here Berhasil Terupdate');
    }

    public function here_picture_update(Request $request, Way $way)
    {
        $request->validate([
            'way_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'way_picture.image' => 'Harus Berupa Gambar',
            'way_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'way_picture.max' => 'Maksimal size 2mb',
        ]);

        $pic = $request->file('way_picture');
        $pic_name = $way->way_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(800, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Way::where('id', $way->id)
            ->update([
                'way_picture' => $pic_name
            ]);

        return back()->with('status', 'Gambar Telah Berhasil Terupdate');
    }

    public function here_destroy($id)
    {
        $way = Way::findorfail($id);
        $file = public_path('/assets/').$way->way_picture;
        if (file_exists($file)) {
            @unlink($file);
        }
        $way->delete();
        return back()->with('delete', 'How to Get Here Telah Terhapus');
    }
}
