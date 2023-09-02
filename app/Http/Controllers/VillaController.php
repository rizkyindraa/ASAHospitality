<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Villa;
use App\Models\Amenity;
use App\Models\Gallery;
use Intervention\Image\ImageManagerStatic as Image;

class VillaController extends Controller
{
    public function villa_index()
    {
        $villas = Villa::latest()->paginate(10);
        return view('admin.villa.index', compact('villas'));
    }

    public function fitur_index($villa)
    {
        $features = Amenity::where('id_villa', $villa)->latest()->paginate(10);
        $single_villa = Villa::where('id', $villa)->first();
        return view('admin.villa.fitur', compact('features', 'villa', 'single_villa'));
    }

    public function gallery_index($villa)
    {
        $galleries = Gallery::where('id_villa', $villa)->latest()->paginate(10);
        $single_villa = Villa::where('id', $villa)->first();
        return view('admin.villa.gallery', compact('galleries', 'villa', 'single_villa'));
    }

    public function villa_detail($villa)
    {
        $single_villa = Villa::where('id', $villa)->first();
        $features = Amenity::where('id_villa', $villa)->latest()->paginate(10);
        $galleries = Gallery::where('id_villa', $villa)->latest()->paginate(10);
        return view('admin.villa.detailvilla', compact('single_villa', 'features', 'galleries'));
    }

    public function villa_search(Request $request)
    {
        $keyword = $request->cari;
        $villas = Villa::where([
                            ['nama_villa', 'like', "%".$keyword."%"]
                            ])
                            ->orWhere([
                                ['subtitle', 'like', "%".$keyword."%"]
                                ])
                            ->latest()->paginate(10);
        return view('admin.villa.index', compact('villas'));
    }

    public function villa_create()
    {
        return view('admin.villa.createvilla');
    }

    public function villa_store(Request $request)
    {
        $request->validate([
            'nama_villa' => 'required',
            'subtitle' => 'required',
            'size' => 'required',
            'occupancy' => 'required',
            'bed_type' => 'required',
            'deskripsi' => 'required',
            'display' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=600,min_height=800,max_width=4000,max_height=4000',
            'floor_plan' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1280,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'nama_villa.required' => 'Masukkan Nama Villa',
            'subtitle.required' => 'Masukkan Subtitle',
            'size.required' => 'Masukkan Villa Size',
            'occupancy.required' => 'Masukkan Occupancy',
            'bed_type.required' => 'Masukkan Bed Type',
            'display.image' => 'Harus Berupa Gambar',
            'display.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'display.max' => 'Maksimal size 2mb',
            'display.dimensions' => 'Resolusi Gambar Harus Lebih Dari 600x800',
            'floor_plan.image' => 'Harus Berupa Gambar',
            'floor_plan.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'floor_plan.max' => 'Maksimal size 2mb',
            'floor_plan.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1280x720'
        ]);

        $file = public_path('/assets');

        $pic1 = $request->file('display');
        $pic_name1 = time().rand(100,99).".".$pic1->getClientOriginalExtension();
        $img1 = Image::make($pic1);
        $img1->resize(600, 800, function ($constraint) {$constraint->aspectRatio();});
        $img1->save($file.'/'.$pic_name1);

        $pic = $request->file('floor_plan');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Villa::create([
            'nama_villa' => $request->nama_villa,
            'subtitle' => $request->subtitle,
            'size' => $request->size,
            'occupancy' => $request->occupancy,
            'bed_type' => $request->bed_type,
            'deskripsi' => $request->deskripsi,
            'yt_link' => $request->yt_link,
            'ubication' => $request->ubication,
            'display' => $pic_name1,
            'floor_plan' => $pic_name
        ]); 
        return redirect('/villa')->with('status', 'Villa Berhasil Disimpan !');
    }

    public function fitur_store(Request $request, $villa)
    {
        $request->validate([
            'fitur' => 'required'
        ],
        [
            'fitur.required' => 'Masukkan Fitur'
        ]);

        Amenity::create([
            'fitur' => $request->fitur,
            'id_villa' => $villa
        ]); 
        return back()->with('status', 'Fitur Berhasil Disimpan !');
    }

    public function gallery_store(Request $request, $villa)
    {
        $request->validate([
            'gallery' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1250,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'gallery.required' => 'Masukkan Gambar',
            'gallery.image' => 'Harus Berupa Gambar',
            'gallery.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'gallery.max' => 'Maksimal size 2mb',
            'gallery.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1250x720'
        ]);

        $pic = $request->file('gallery');
        $file = public_path('/assets');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Gallery::create([
            'gallery' => $pic_name,
            'id_villa' => $villa
        ]); 
        return back()->with('status', 'Gallery Berhasil Disimpan !');
    }

    public function villa_edit(Villa $villa)
    {
        return view('admin.villa.editvilla', compact('villa'));
    }

    public function fitur_update(Request $request, Amenity $feature)
    {   
        $request->validate([
            'fitur' => 'required'
        ],
        [
            'fitur.required' => 'Masukkan Fitur'
        ]); 

        Amenity::where('id', $feature->id)
            ->update([
                'fitur' => $request->fitur
            ]);   
        return back()->with('status', 'Fitur Berhasil Terupdate');
    }

    public function villa_konten_update(Request $request, Villa $villa)
    {
        $request->validate([
            'nama_villa' => 'required',
            'subtitle' => 'required',
            'size' => 'required',
            'occupancy' => 'required',
            'bed_type' => 'required',
            'deskripsi' => 'required',
            'yt_link' => 'required',
            'ubication' => 'required'
        ],
        [
            'nama_villa.required' => 'Masukkan Nama Villa',
            'subtitle.required' => 'Masukkan Subtitle',
            'size.required' => 'Masukkan Subtitle',
            'occupancy.required' => 'Masukkan Subtitle',
            'bed_type.required' => 'Masukkan Bed Size',
            'deskripsi.required' => 'Masukkan Deskripsi',
            'yt_link.required' => 'Masukkan Link Youtube',
            'ubication.required' => 'Masukkan Ubication'
        ]);

        Villa::where('id', $villa->id)
            ->update([
                'nama_villa' => $request->nama_villa,
                'subtitle' => $request->subtitle,
                'size' => $request->size,
                'occupancy' => $request->occupancy,
                'bed_type' => $request->bed_type,
                'deskripsi' => $request->deskripsi,
                'yt_link' => $request->yt_link,
                'ubication' => $request->ubication,
            ]);

        return back()->with('status', 'Villa Telah Berhasil Terupdate');
    }

    public function villa_picture_update(Request $request, Villa $villa)
    {
        $request->validate([
            'floor_plan' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1250,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'floor_plan.image' => 'Harus Berupa Gambar',
            'floor_plan.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'floor_plan.max' => 'Maksimal size 2mb',
            'floor_plan.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1250x720'
        ]);

        $pic = $request->file('floor_plan');
        $pic_name = $villa->floor_plan;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Villa::where('id', $villa->id)
            ->update([
                'floor_plan' => $pic_name
            ]);

        return back()->with('status', 'Floor Plan Telah Berhasil Terupdate');
    }

    public function villa_display_update(Request $request, Villa $villa)
    {
        $request->validate([
            'display' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=600,min_height=800,max_width=4000,max_height=4000'
        ],
        [
            'display.image' => 'Harus Berupa Gambar',
            'display.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'display.max' => 'Maksimal size 2mb',
            'display.dimensions' => 'Resolusi Gambar Harus Lebih Dari 600x800'
        ]);

        $pic = $request->file('display');
        $pic_name = $villa->display;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Villa::where('id', $villa->id)
            ->update([
                'display' => $pic_name
            ]);

        return back()->with('status', 'Display Telah Berhasil Terupdate');
    }

    public function gallery_update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'gallery' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=1280,min_height=720,max_width=4000,max_height=4000'
        ],
        [
            'gallery.image' => 'Harus Berupa Gambar',
            'gallery.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'gallery.max' => 'Maksimal size 2mb',
            'gallery.dimensions' => 'Resolusi Gambar Harus Lebih Dari 1280x720'
        ]);

        $pic = $request->file('gallery');
        $pic_name = $gallery->gallery;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(1920, 1080, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Gallery::where('id', $gallery->id)
            ->update([
                'gallery' => $pic_name
            ]);

        return back()->with('status', 'Gallery Telah Berhasil Terupdate');
    }

    public function fitur_destroy($id)
    {
        $feature = Amenity::findorfail($id);
        $feature->delete();
        return back()->with('delete', 'Fitur Telah Terhapus');
    }

    public function gallery_destroy($id)
    {
        $gallery = Gallery::findorfail($id);
        $file = public_path('/assets/').$gallery->gallery;
        if (file_exists($file)) {
            @unlink($file);
        }
        $gallery->delete();
        return back()->with('delete', 'Gallery Telah Terhapus !');
    }

    public function villa_destroy($id)
    {
        $gallery = Gallery::where('id_villa', $id)->get();
        $feature = Amenity::where('id_villa', $id)->get();
        $villa = Villa::findorfail($id);
        $floor_plan = public_path('/assets/').$villa->floor_plan;
        $display = public_path('/assets/').$villa->display;
        if (file_exists($floor_plan)) {
            @unlink($floor_plan);
        }
        if (file_exists($display)) {
            @unlink($display);
        }
        foreach($gallery as $g){
            $file = public_path('/assets/').$g->gallery;
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        $gallery->each->delete();
        $feature->each->delete();
        $villa->delete();
        return back()->with('delete', 'Villa Telah Terhapus');
    }
}
