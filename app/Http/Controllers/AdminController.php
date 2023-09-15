<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        $regs = DB::table('registrations')->count();
        $nonmembers = DB::table('registrations')
                            ->where('status_penerimaan_membership', '=', 0)
                            ->count();
        $members = DB::table('registrations')
                            ->where('status_penerimaan_membership', '=', 1)
                            ->count();
        $memberships = DB::table('memberships')
                            ->select('memberships.nama_membership', 'memberships.harga_membership')
                            ->addSelect(DB::raw('count(registrations.id) as total_reg'))
                            ->addSelect(DB::raw('SUM(case when registrations.status_penerimaan_membership = 0 then 1 else 0 end) as total_pasif'))
                            ->addSelect(DB::raw('SUM(case when registrations.status_penerimaan_membership = 1 then 1 else 0 end) as total_aktif'))
                            ->leftjoin('registrations', 'memberships.id', '=', 'registrations.id_membership')
                            ->groupBy('memberships.nama_membership', 'memberships.harga_membership')
                            ->get();

        return view('admin.dashboard.dashboard', compact('regs', 'nonmembers', 'members', 'memberships'));
    } 

    public function admin_index()
    {
        $users = User::where([
                                ['role', '<>', 'superadmin'],
                                ['role', '<>', 'member']
                            ])
                            ->latest()
                            ->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function admin_search(Request $request)
    {
        $keyword = $request->cari;
        $users = User::where([
                                ['role', '<>', 'superadmin'],
                                ['role', '<>', 'member'],
                                ['username', 'like', "%".$keyword."%"]
                            ])
                            ->orWhere([
                                ['role', '<>', 'superadmin'],
                                ['role', '<>', 'member'],
                                ['email', 'like', "%".$keyword."%"]
                            ])
                            ->latest()
                            ->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function admin_create()
    {
        return view('admin.user.createuser');
    }

    public function admin_edit(User $user)
    {
        return view('admin.user.edituser', compact('user'));
    }

    public function admin_store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|unique:users'
        ],
        [
            'username.required' => 'Masukkan Username',
            'email.unique' => 'Username Sudah Terdaftar',
            'password.required' => 'Masukkan Password',
            'email.required' => 'Masukkan Email',
            'email.unique' => 'Email Sudah Terdaftar',
        ]);

        $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'is_verified' => '1',
                'status' => '1',
                'role' => 'admin',
                'pp_path' => 'default_pp.png',
                'remember_token' => Str::random(60)
                ]);

        return redirect('/admin_management')->with('status', 'Tambah Admin Berhasil');
    }

    public function admin_status($id){
        $data = User::where('id', $id)->first();
        $status_now = $data->status;
        if($status_now == 1 ) {
            User::where('id', $id)->update(['status'=>0]);
        } else {
            User::where('id', $id)->update(['status'=>1]);
        }
        return back()->with('status', 'Status Admin Telah Berhasil Terupdate');
    }

    public function admin_akun_update(Request $request, User $user)
    {   
        $request->validate([
            'username' => 'required|unique:users,email,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id
        ],
        [
            'username.required' => 'Masukkan username',
            'email.required' => 'Masukkan Email'
        ]);

        User::where('id', $user->id)
            ->update([
                'username' => $request->username,
                'email' => $request->email
            ]);   
        return back()->with('status', 'Admin Berhasil Terupdate');
    }

    public function admin_password_update(Request $request, User $user)
    {   
        $request->validate([
            'password' => 'required'
        ],
        [
            'password.required' => 'Masukkan Password'
        ]);

        User::where('id', $user->id)
            ->update([
                'password' => $request->password
            ]);   
        return back()->with('status', 'Password Admin Berhasil Terupdate');
    }

    public function admin_destroy($id)
    {
        $admin = User::findorfail($id);
        $admin->delete();
        return back()->with('delete', 'Admin Telah Terhapus');
    }
    
}
