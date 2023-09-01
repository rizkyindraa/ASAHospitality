<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Voucher;
use App\Models\Registration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function jm_index()
    {
        $memberships = Membership::latest()->paginate(10);
        return view('admin.membership.jenis_membership.index', compact('memberships'));
    }

    public function list_voucher_index()
    {
        $vouchers = DB::table('vouchers')
                        ->select('vouchers.id', 'vouchers.tgl_berubah_status', 'vouchers.tgl_voucher', 'vouchers.no_voucher', 'vouchers.status', 'vouchers.keterangan', 'vouchers.penerima', 'vouchers.id_user', 'members.nama_depan', 'members.nama_belakang', 'users.email')
                        ->leftjoin('users', 'vouchers.id_user', '=', 'users.id')
                        ->leftjoin('members', 'users.id', '=', 'members.id_user')
                        ->latest('vouchers.created_at')
                        ->paginate(10);
        return view('admin.membership.list_voucher.index', compact('vouchers'));
    }

    public function list_voucher_search(Request $request)
    {
        $keyword = $request->cari;
        $vouchers = DB::table('vouchers')
                        ->select('vouchers.id', 'vouchers.tgl_berubah_status', 'vouchers.tgl_voucher', 'vouchers.no_voucher', 'vouchers.status', 'vouchers.keterangan', 'vouchers.penerima', 'vouchers.id_user', 'members.nama_depan', 'members.nama_belakang', 'users.email')
                        ->leftjoin('users', 'vouchers.id_user', '=', 'users.id')
                        ->leftjoin('members', 'users.id', '=', 'members.id_user')
                        ->where([
                            ['vouchers.no_voucher', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['vouchers.penerima', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['members.nama_depan', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['members.nama_belakang', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.email', 'like', "%".$keyword."%"]
                        ])
                        ->latest('vouchers.created_at')
                        ->paginate(10);
        return view('admin.membership.list_voucher.index', compact('vouchers'));
    }

    public function jm_search(Request $request)
    {
        $keyword = $request->cari;
        $memberships = Membership::latest()
                        ->where([
                            ['nama_membership', 'like', "%".$keyword."%"]
                        ])
                        ->latest()
                        ->paginate(10);
        return view('admin.membership.jenis_membership.index', compact('memberships'));
    }

    public function dm_index()
    {
        $registrations = DB::table('registrations')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);

        return view('admin.membership.daftar_membership.index', compact('registrations'));
    }

    public function dm_search(Request $request)
    {
        $keyword = $request->cari;
        $registrations = DB::table('registrations')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['members.nama_depan', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['members.nama_belakang','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['registrations.no_registrasi','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['members.no_hp','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['memberships.nama_membership','like',"%".$keyword."%"]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);
        return view('admin.membership.daftar_membership.index', compact('registrations'));
    }

    public function pm_index()
    {
        $registrations = DB::table('registrations')
                        ->select('registrations.id AS reg_id', 'registrations.*', 'members.*', 'memberships.*', 'users.*')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);
        
        $historyregs = DB::table('registrations')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '<>', 0],
                            ['users.is_verified', '=', 1]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);   

        return view('admin.membership.penerimaan_membership.index', compact('registrations', 'historyregs'));
    }

    public function pm_search(Request $request)
    {
        $keyword = $request->cari;
        $registrations = DB::table('registrations')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1],
                            ['members.nama_depan', 'like', "%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1],
                            ['members.nama_belakang','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1],
                            ['registrations.no_registrasi','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1],
                            ['members.no_hp','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 0],
                            ['users.is_verified', '=', 1],
                            ['memberships.nama_membership','like',"%".$keyword."%"]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);
        return view('admin.membership.penerimaan_membership.index', compact('registrations'));
    }

    public function dms_index()
    {        
        $members = DB::table('registrations')
                        ->select('registrations.id', 'registrations.tgl_registrasi', 'registrations.no_registrasi', 'registrations.tgl_penerimaan_membership', 'members.nama_depan', 'members.nama_belakang', 'members.jenis_kelamin', 'members.no_hp', 'memberships.nama_membership', 'memberships.jumlah_voucher', 'memberships.periode', 'memberships.satuan_periode', 'users.email', 'users.username')
                        ->addSelect(DB::raw('COUNT(vouchers.id) as voucher_used'))
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->leftjoin('vouchers', 'users.id', '=', 'vouchers.id_user')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 1],
                            ['users.is_verified', '=', 1]
                        ])
                        ->groupBy('registrations.id', 'registrations.created_at', 'registrations.tgl_registrasi', 'registrations.no_registrasi', 'registrations.tgl_penerimaan_membership', 'members.nama_depan', 'members.nama_belakang', 'members.jenis_kelamin', 'members.no_hp', 'memberships.nama_membership', 'memberships.jumlah_voucher', 'memberships.periode', 'memberships.satuan_periode', 'users.email', 'users.username')
                        ->latest('registrations.created_at')
                        ->paginate(10);  

        return view('admin.membership.daftar_member.index', compact('members'));
    }

    public function dms_search(Request $request)
    {
        $keyword = $request->cari;
        $members = DB::table('registrations')
                        ->leftjoin('memberships', 'registrations.id_membership', '=', 'memberships.id')
                        ->leftjoin('members', 'registrations.id_member', '=', 'members.id')
                        ->leftjoin('users', 'members.id_user', '=', 'users.id')
                        ->where([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 1],
                            ['users.is_verified', '=', 1],
                            ['members.nama_depan','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 1],
                            ['users.is_verified', '=', 1],
                            ['members.nama_belakang','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 1],
                            ['users.is_verified', '=', 1],
                            ['memberships.nama_membership','like',"%".$keyword."%"]
                        ])
                        ->orWhere([
                            ['users.role', '=', 'member'],
                            ['registrations.status_penerimaan_membership', '=', 1],
                            ['users.is_verified', '=', 1],
                            ['registrations.no_registrasi','like',"%".$keyword."%"]
                        ])
                        ->latest('registrations.created_at')
                        ->paginate(10);
        return view('admin.membership.daftar_member.index', compact('members'));
    }

    public function jm_create()
    {
        return view('admin.membership.jenis_membership.create');
    }

    public function jm_store(Request $request)
    {
        $request->validate([
            'nama_membership' => 'required',
            'harga_membership' => 'required',
            'jumlah_voucher' => 'required',
            'discount_product' => 'required',
            'periode' => 'required',
            'satuan_periode' => 'required'
        ],
        [
            'nama_membership.required' => 'Masukkan Nama Membership',
            'harga_membership.required' => 'Masukkan Harga Membership',
            'jumlah_voucher.required' => 'Masukkan Jumlah Voucher',
            'discount_product.required' => 'Masukkan Diskon Produk',
            'periode.required' => 'Masukkan Periode Membership',
            'satuan_periode.required' => 'Pilih Satuan Periode Membership'
        ]);

        Membership::create([
            'uid' => Str::orderedUuid(),
            'nama_membership' => $request->nama_membership,
            'harga_membership' => $request->harga_membership,
            'sharing_profit' => ($request->sharing_profit) ? '1' : '0',
            'jumlah_voucher' => $request->jumlah_voucher,
            'discount_product' => $request->discount_product,
            'periode' => $request->periode,
            'satuan_periode' => $request->satuan_periode
        ]); 
        return redirect('/jenis_membership')->with('status', 'Data Admin Berhasil Disimpan !');
    }

    public function jm_update(Request $request, Membership $membership)
    {
        $request->validate([
            'nama_membership' => 'required',
            'harga_membership' => 'required',
            'jumlah_voucher' => 'required',
            'discount_product' => 'required',
            'periode' => 'required',
            'satuan_periode' => 'required'
        ],
        [
            'nama_membership.required' => 'Masukkan Nama Membership',
            'harga_membership.required' => 'Masukkan Harga Membership',
            'jumlah_voucher.required' => 'Masukkan Jumlah Voucher',
            'discount_product.required' => 'Masukkan Diskon Produk',
            'periode.required' => 'Masukkan Periode Membership',
            'satuan_periode.required' => 'Pilih Satuan Periode Membership'
        ]);

        Membership::where('id', $membership->id)
            ->update([
                'nama_membership' => $request->nama_membership,
                'harga_membership' => $request->harga_membership,
                'sharing_profit' => ($request->sharing_profit) ? '1' : '0',
                'jumlah_voucher' => $request->jumlah_voucher,
                'discount_product' => $request->discount_product,
                'periode' => $request->periode,
                'satuan_periode' => $request->satuan_periode
            ]);

        return back()->with('status', 'Jenis Membership Telah Berhasil Terupdate');
    }

    public function pm_update(Request $request, Registration $reg)
    {
        $request->validate([
            'payment' => 'required',
            'penerimaan' => 'required',
            'tgl_penerimaan' => 'required'
        ],
        [
            'payment.required' => 'Pilih Jenis Pembayaran',
            'penerimaan.required' => 'Pilih Status Penerimaan',
            'tgl_penerimaan.required' => 'Masukkan Tanggal Penerimaan'
        ]);

        Registration::where('id', $reg->id)
            ->update([
                'payment' => $request->payment,
                'status_penerimaan_membership' => $request->penerimaan,
                'tgl_penerimaan_membership' => $request->tgl_penerimaan,
            ]);

        return back()->with('status', 'Penerimaan Membership Telah Berhasil Terupdate');
    }

    public function voucher_status_update(Voucher $v)
    {
        if($v->status == '1'){
            Voucher::where('id', $v->id)
            ->update([
                'status' => '0',
                'tgl_berubah_status' => Carbon::now()->toDateString()
            ]);
        } else {
            Voucher::where('id', $v->id)
            ->update([
                'status' => '1',
                'tgl_berubah_status' => Carbon::now()->toDateString()
            ]);
        }    
        return back()->with('status', 'Status Voucher Telah Berhasil Terupdate');
    }

    public function jm_destroy($id)
    {
        $membership = Membership::findorfail($id);
        $membership->delete();
        return back()->with('delete', 'Jenis Membership Telah Terhapus');
    }
}
