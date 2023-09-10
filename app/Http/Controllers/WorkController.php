<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
    public function work_index() 
    {
        $works = Work::latest()->paginate(10);
        return view('admin.work.index', compact('works'));
    }

    public function work_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle'
        ]);

        Work::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle
        ]); 
        return back()->with('status', 'How We Work Berhasil Disimpan');
    }

    public function work_update(Request $request, Work $work)
    {   
        $request->validate([
            'title' => 'required',
            'subtitle' => 'required'
        ],
        [
            'title.required' => 'Masukkan Title',
            'subtitle.required' => 'Masukkan Subtitle'
        ]); 

        Work::where('id', $work->id)
            ->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle
            ]);   
        return back()->with('status', 'How We Work Berhasil Terupdate');
    }

    public function work_destroy($id)
    {
        $work = Work::findorfail($id);
        $work->delete();
        return back()->with('delete', 'How We Work Telah Terhapus');
    }
}
