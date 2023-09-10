<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Team;

class TeamController extends Controller
{
    public function team_index() 
    {
        $teams = Team::latest()->paginate(10);
        return view('admin.team.index', compact('teams'));
    }

    public function team_search(Request $request)
    {
        $keyword = $request->cari;
        $teams = Team::where([
                                ['nama', 'like', "%".$keyword."%"]
                            ])
                            ->orWhere([
                                ['email', 'like', "%".$keyword."%"]
                                ])
                            ->orWhere([
                                ['no_hp', 'like', "%".$keyword."%"]
                                 ])
                            ->latest()->paginate(10);
        return view('admin.team.index', compact('teams'));
    }

    public function team_create() 
    {
        return view('admin.team.createteam');
    }

    public function team_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'posisi' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=600,min_height=600,max_width=4000,max_height=4000'
        ],
        [
            'nama.required' => 'Masukkan Nama',
            'no_hp.required' => 'Masukkan Nomor Hp',
            'posisi.required' => 'Masukkan Posisi',
            'email.required' => 'Masukkan Email',
            'foto.required' => 'Masukkan Foto',
            'foto.image' => 'Harus Berupa Gambar',
            'foto.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'foto.max' => 'Maksimal size 2mb',
            'foto.dimensions' => 'Resolusi Gambar Harus Lebih Dari 600x600'
        ]);

        $pic = $request->file('foto');
        $file = public_path('/assets');
        $pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
        $img = Image::make($pic);
        $img->resize(600, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        if(!empty($request->input('ig_link')))
        {
            $ig_link = $request->ig_link;
        } else {
            $ig_link = "https://www.instagram.com/";
        }

        if(!empty($request->input('fb_link')))
        {
            $fb_link = $request->fb_link;
        } else {
            $fb_link = "https://www.facebook.com/";
        }

        if(!empty($request->input('tw_link')))
        {
            $tw_link = $request->tw_link;
        } else {
            $tw_link = "https://www.twitter.com/";
        }

        if(!empty($request->input('li_link')))
        {
            $li_link = $request->li_link;
        } else {
            $li_link = "https://www.linkedin.com/";
        }

        Team::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'posisi' => $request->posisi,
            'email' => $request->email,
            'ig_link' => $ig_link,
            'fb_link' => $fb_link,
            'tw_link' => $tw_link,
            'li_link' => $li_link,
            'foto' => $pic_name
        ]); 
        return redirect('/team')->with('status', 'Team Berhasil Disimpan');
    }

    public function team_edit(Team $team) 
    {
        return view('admin.team.editteam', compact('team'));
    }

    public function team_konten_update(Request $request, Team $team)
    {   
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'posisi' => 'required',
            'email' => 'required'
        ],
        [
            'nama.required' => 'Masukkan Nama',
            'no_hp.required' => 'Masukkan Nomor Hp',
            'posisi.required' => 'Masukkan Posisi',
            'email.required' => 'Masukkan Email'
        ]); 

        if(!empty($request->input('ig_link')))
        {
            $ig_link = $request->ig_link;
        } else {
            $ig_link = "https://www.instagram.com/";
        }

        if(!empty($request->input('fb_link')))
        {
            $fb_link = $request->fb_link;
        } else {
            $fb_link = "https://www.facebook.com/";
        }

        if(!empty($request->input('tw_link')))
        {
            $tw_link = $request->tw_link;
        } else {
            $tw_link = "https://www.twitter.com/";
        }

        if(!empty($request->input('li_link')))
        {
            $li_link = $request->li_link;
        } else {
            $li_link = "https://www.linkedin.com/";
        }

        Team::where('id', $team->id)
            ->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'posisi' => $request->posisi,
                'email' => $request->email,
                'ig_link' => $ig_link,
                'fb_link' => $fb_link,
                'tw_link' => $tw_link,
                'li_link' => $li_link,
            ]);   
        return back()->with('status', 'Team Berhasil Terupdate');
    }

    public function team_foto_update(Request $request, Team $team)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=600,min_height=600,max_width=4000,max_height=4000'
        ],
        [
            'foto.image' => 'Harus Berupa Gambar',
            'foto.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, .gif, dan .svg',
            'foto.max' => 'Maksimal size 2mb',
            'foto.dimensions' => 'Resolusi Gambar Harus Lebih Dari 600x600'
        ]);

        $pic = $request->file('foto');
        $pic_name = $team->foto;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(600, 600, function ($constraint) {$constraint->aspectRatio();});
        $img->save($file.'/'.$pic_name);

        Team::where('id', $team->id)
            ->update([
                'foto' => $pic_name
            ]);

        return back()->with('status', 'Foto Telah Berhasil Terupdate');
    }

    public function team_destroy($id)
    {
        $team = Team::findorfail($id);
        $file = public_path('/assets/').$team->foto;
        if (file_exists($file)) {
            @unlink($file);
        }
        $team->delete();
        return back()->with('delete', 'Team Telah Terhapus !');
    }
}
