<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
}
