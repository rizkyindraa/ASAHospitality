<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function facility_index() 
    {
        $facilities = Facility::latest()->paginate(10);
        return view('admin.facility.index', compact('facilities'));
    }

    public function facility_create() 
    {
        return view('admin.facility.createfacility');
    }

    public function facility_edit(Facility $facility) 
    {
        return view('admin.facility.editfacility', compact('facility'));
    }

    public function facility_search(Request $request)
    {
        $keyword = $request->cari;
        $facilities = Facility::where([
                                ['facilities_name', 'like', "%".$keyword."%"]
                            ])
                            ->orWhere([
                                ['subtitle', 'like', "%".$keyword."%"]
                                ])
                            ->latest()->paginate(10);
        return view('admin.facility.index', compact('facilities'));
    }

    public function facility_store(Request $request)
    {
        $request->validate([
            'facilities_name' => 'required',
            'subtitle' => 'required',
            'facilities_picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048'
        ],
        [
            'facilities_name.required' => 'Masukkan Nama Facility',
            'subtitle.required' => 'Masukkan Subtitle',
            'facilities_picture.required' => 'Masukkan Gambar',
            'facilities_picture.image' => 'Harus Berupa Gambar',
            'facilities_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'facilities_picture.max' => 'Maksimal size 2mb'
        ]);

        $pic = $request->file('facilities_picture');
        $file = public_path('/assets');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(800, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Facility::create([
            'facilities_name' => $request->facilities_name,
            'subtitle' => $request->subtitle,
            'facilities_picture' => $pic_name
        ]); 
        return redirect('/facility')->with('status', 'Facility Berhasil Disimpan');
    }

    public function facility_konten_update(Request $request, Facility $facility)
    {   
        $request->validate([
            'facilities_name' => 'required',
            'subtitle' => 'required'
        ],
        [
            'facilities_name.required' => 'Masukkan Nama Facility',
            'subtitle.required' => 'Masukkan Subtitle'
        ]); 

        Facility::where('id', $facility->id)
            ->update([
                'facilities_name' => $request->facilities_name,
                'subtitle' => $request->subtitle
            ]);   
        return back()->with('status', 'Facility Berhasil Terupdate');
    }

    public function facility_picture_update(Request $request, Facility $facility)
    {
        $request->validate([
            'facilities_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'facilities_picture.image' => 'Harus Berupa Gambar',
            'facilities_picture.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'facilities_picture.max' => 'Maksimal size 2mb'
        ]);

        $pic = $request->file('facilities_picture');
        $pic_name = $facility->facilities_picture;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(800, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Facility::where('id', $facility->id)
            ->update([
                'facilities_picture' => $pic_name
            ]);

        return back()->with('status', 'Foto Telah Berhasil Terupdate');
    }

    public function facility_destroy($id)
    {
        $facility = Facility::findorfail($id);
        $file = public_path('/assets/').$facility->facilities_picture;
        if (file_exists($file)) {
            @unlink($file);
        }
        $facility->delete();
        return back()->with('delete', 'Facility Telah Terhapus !');
    }
}
