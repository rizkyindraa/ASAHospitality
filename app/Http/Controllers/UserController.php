<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Membership;
use App\Models\Registration;
use App\Models\Member;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Slider;
use App\Models\Greeting;
use App\Models\Overview;
use App\Models\Villa;
use App\Models\Gallery;
use App\Models\Amenity;
use App\Models\Contact;
use App\Models\Team;
use App\Models\About;
use App\Models\Work;
use App\Models\Facility;
use Mail;
use Auth;
use PDF;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    
    //home
    public function index()
    {
        $teams= Team::all();
        $villas = Villa::all();
        $contact = Contact::first();
        $sliders = Slider::latest()->get();
        $greeting = Greeting::first();
        $overview = Overview::first();
        return view('user.home.index', compact('sliders', 'greeting', 'overview', 'villas', 'contact', 'teams'));
    }

    //about
    public function about_index()
    {
        $villas = Villa::all();
        $contact = Contact::first();
        $about = About::first();
        return view('user.about.index', compact('villas', 'contact', 'about'));
    }

    //contact 
    public function contact_index()
    {
        $villas = Villa::all();
        $contact = Contact::first();
        return view('user.contact.index', compact('villas', 'contact'));
    }

    //how we work
    public function work_index()
    {
        $villas = Villa::all();
        $contact = Contact::first();
        $works = Work::all();
        return view('user.work.index', compact('villas', 'contact', 'works'));
    }

    //facility
    public function facility_index()
    {
        $villas = Villa::all();
        $contact = Contact::first();
        $facilities = Facility::all();
        return view('user.facilities.index', compact('villas', 'contact', 'facilities'));
    }

    //villa
    public function villa_single_index($villa)
    {
        $contact = Contact::first();
        $villas = Villa::all();
        $single_villa = Villa::where('id', $villa)->first();
        $galleries = Gallery::where('id_villa', $villa)->get();
        $features = Amenity::where('id_villa', $villa)->get();
        $other_villas = Villa::where('id', '<>', $villa)->get();
        return view('user.villa.single', compact('villas', 'single_villa', 'galleries', 'features', 'other_villas', 'contact'));
    }

    //membership
    public function membership_index()
    {
        $contact = Contact::first();
        $villas = Villa::all();
        $memberships = Membership::all();
        return view('user.membership.index', compact('memberships', 'villas', 'contact'));
    }

    public function member_store(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|unique:members',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'membership' => 'required',
            'captcha' => 'required|captcha'
        ],
        [
            'nama_depan.required' => 'Masukkan Nama Depan',
            'nama_belakang.required' => 'Masukkan Nama Belakang',
            'jenis_kelamin.required' => 'Pilih Jenis Kelamin',
            'no_hp.required' => 'Masukkan Nomor HP',
            'no_hp.unique' => 'Nomor Hp Sudah Terdaftar',
            'email.required' => 'Masukkan Email',
            'email.unique' => 'Email Sudah Terdaftar',
            'username.required' => 'Masukkan Username',
            'username.unique' => 'Username Sudah Terdaftar',
            'password.required' => 'Masukkan Password',
            'membership.required' => 'Pilih Membership',
            'captcha.required' => 'Masukkan Captcha',
            'captcha.captcha' => 'Invalid Captcha'
        ]);

        $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'is_verified' => '0',
                'email_token' => Str::random(60),
                'status' => '1',
                'role' => 'member',
                'pp_path' => 'default_pp.png',
                'remember_token' => Str::random(60)
                ]);
        
        $member = Member::create([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'id_user' => $user->id
                ]);
        
        Registration::create([
            'tgl_registrasi' => Carbon::now()->toDateString(),
            'no_registrasi' => 'REG-'.Carbon::now()->format('d').Carbon::now()->format('m').Carbon::now()->year.$user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'status_penerimaan_membership' => '0',
            'id_member' => $member->id,
            'id_membership' => $request->membership
        ]);

        Mail::send('email.emailverification', ['token' => $user->email_token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Verifikasi Email ASA Hospitality');
          });

        return redirect('/membership/post-registration');
    }

    public function post_reg_membership_index()
    {
        $contact = Contact::first();
        $villas = Villa::all();
        return view('user.membership.postregistration', compact('villas', 'contact'));
    }

    public function post_ver_membership_index()
    {
        $contact = Contact::first();
        $villas = Villa::all();
        return view('user.membership.postverification', compact('villas', 'contact'));
    }

    public function verification($token)
    {
        $user = User::where('email_token', $token)->first();       
        if($user->is_verified == 0) {
            User::where('id', $user->id)
            ->update([
                'is_verified' => '1',
                'email_verified_at' => Carbon::now()->toDateString()
            ]);
            $message = "Email berhasil di verifikasi, silahkan melakukan login";
        } else if ($user->is_verified == 1) {
            $message = "Email sudah terverifikasi. Silahkan melakukan login.";
        }
  
      return redirect('/membership/post-verification')->with('message', $message);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    //forget password
    public function fp_index()
    {
        $contact = Contact::first();
        $villas = Villa::all();
        return view('user.membership.forgetpassword', compact('villas', 'contact'));
    }

    public function post_forget_password(Request $request)
    {   
        $contact = Contact::first();
        $villas = Villa::all();
        $user = User::where('email', '=', $request->email)->first();
        if($user == null) {
            return redirect('/membership/forget-password')->with('error', 'Tidak ada akun yang menggunakan email ini');
        } else {
            Mail::send('email.forgetpassword', ['token' => $user->email_token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Lupa Password Akun ASA Hospitality');
            });
            return view('user.membership.postforgetpassword', compact('villas', 'contact')); 
        }
    }

    public function forget_password_verification($token)
    {   
        $villas = Villa::all();
        $contact = Contact::first();
        $user = User::where('email_token', $token)->first();  
        $member = Member::where('id_user', $user->id)->first();       
        $reg = Registration::where('id_member', $member->id)->first();       
        return view('user.membership.formforgetpassword', compact('user', 'member', 'reg', 'token', 'villas', 'contact'));
    }

    public function update_password(Request $request, User $user)
    {   
        $request->validate([
            'password' => 'required|confirmed'
        ],
        [
            'password.required' => 'Masukkan Password',
            'password.confirmed' => 'Konfirmasi Password Belum Sesuai',
        ]); 

        User::where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);   
        return view('user.membership.finalforgetpassword');
    }

    //backoffice
    public function member_dashboard()
    {
        $member = Member::where('id_user', auth()->user()->id)->first();
        $reg = Registration::where('id_member', $member->id)->first();
        return view('user.backoffice.dashboard', compact('member', 'reg'));
    }

    public function member_membership()
    {
        $member = Member::where('id_user', auth()->user()->id)->first();
        $reg = Registration::where('id_member', $member->id)->first();
        $membership = Membership::where('id', $reg->id_membership)->first();
        $vouchers = Voucher::where('id_user', auth()->user()->id);
        return view('user.backoffice.membership', compact('member', 'reg', 'membership', 'vouchers'));
    }

    public function member_voucher()
    {
        $member = Member::where('id_user', auth()->user()->id)->first();
        $reg = Registration::where('id_member', $member->id)->first();
        $membership = Membership::where('id', $reg->id_membership)->first();
        $vouchers = Voucher::where('id_user', auth()->user()->id)->latest()->paginate(10);
        return view('user.backoffice.voucher', compact('member', 'reg', 'membership', 'vouchers'));
    }

    public function voucher_search(Request $request)
    {
        $keyword = $request->cari;
        $member = Member::where('id_user', auth()->user()->id)->first();
        $reg = Registration::where('id_member', $member->id)->first();
        $membership = Membership::where('id', $reg->id_membership)->first();
        $vouchers = Voucher::where([['id_user', auth()->user()->id], ['penerima','like',"%".$keyword."%"]])
                            ->orWhere([['id_user', auth()->user()->id], ['keterangan','like',"%".$keyword."%"]])
                            ->orWhere([['id_user', auth()->user()->id], ['no_voucher','like',"%".$keyword."%"]])
                            ->latest()->paginate(10);
        return view('user.backoffice.voucher', compact('member', 'reg', 'membership', 'vouchers'));
    }

    public function voucher_print(Voucher $voucher)
    {
        $data = ['title' => 'ASA Hospitality E-Voucher', 'tgl_voucher' => Carbon::parse($voucher->tgl_voucher)->isoFormat('dddd, D MMMM Y'), 'no_voucher' => $voucher->no_voucher, 'penerima' => $voucher->penerima];
        $customPaper = array(0,0,567.00,481.89);
        $pdf = PDF::loadView('user.e-voucher', $data)->setPaper($customPaper, 'portrait');
        return $pdf->download($voucher->no_voucher.'_E-Voucher.pdf');
    }

    public function update_member(Request $request, Member $member)
    {   
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'no_hp' => 'required'
        ],
        [
            'nama_depan.required' => 'Masukkan Nama Depan',
            'nama_belakang.required' => 'Masukkan Nama Belakang',
            'no_hp.required' => 'Masukkan Nomor Hp'
        ]); 

        Member::where('id', $member->id)
            ->update([
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'no_hp' => $request->no_hp,
            ]);  

        return redirect('/member/dashboard')->with('status', 'Edit Profile Berhasil');
    }

    public function update_password_member(Request $request, User $member)
    {   
        $request->validate([
            'password' => 'required|confirmed'
        ],
        [
            'password.required' => 'Masukkan Password',
            'password.confirmed' => 'Konfirmasi Password Belum Sesuai',
        ]); 

        User::where('id', $member->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);   

        return redirect('/member/dashboard')->with('status', 'Edit Password Berhasil');
    }

    public function update_pp_member(Request $request, User $member)
    {   
        $request->validate([
            'pp' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048|dimensions:min_width=600,min_height=600,max_width=2000,max_height=2000'
        ],
        [
            'pp.image' => 'Harus Berupa Gambar',
            'pp.mimes' => 'Format yang didukung hanya .jpg, .png, .jpeg, dan .svg',
            'pp.max' => 'Maksimal size 2mb',
            'pp.dimensions' => 'Minimal 600x600, dan Maksimal 2000x2000'
        ]); 

        $pic = $request->file('pp');
        $pic_name = $member->pp_path;
        $file = public_path('/assets');
        $img = Image::make($pic);
        $img->resize(600, 600, function ($constraint) {$constraint->aspectRatio();});
        if($pic_name == 'default_pp.png'){
            $new_pic_name = time().rand(100,99).".".$pic->getClientOriginalExtension();
            $img->save($file.'/'.$new_pic_name);
        } else {
            $img->save($file.'/'.$pic_name);
        }

        if($pic_name == 'default_pp.png'){
            User::where('id', $member->id)
            ->update([
                'pp_path' => $new_pic_name
            ]);
        } else {
            User::where('id', $member->id)
            ->update([
                'pp_path' => $pic_name
            ]);
        } 

        return redirect('/member/dashboard')->with('status', 'Edit Profile Picture Berhasil');
    }

    public function voucher_store(Request $request)
    {
        $request->validate([
            'tgl_voucher' => 'required',
            'penerima' => 'required',
            'keterangan' => 'required'
        ],
        [
            'tgl_voucher.required' => 'Pilih Tgl. Voucher',
            'penerima.required' => 'Masukkan Penerima',
            'keterangan.required' => 'Masukkan Keterangan'
        ]);

        Voucher::create([
            'tgl_voucher' => $request->tgl_voucher,
            'no_voucher' => 'VOC'.'-'.Carbon::now()->format('d').Carbon::now()->format('m').Carbon::now()->year.Str::random(6),
            'penerima' => $request->penerima,
            'keterangan' => $request->keterangan,
            'id_user' => auth()->user()->id,
            'status' => '1',
            'tgl_berubah_status' => Carbon::now()->toDateString()
            ]);

        return redirect('/member/voucher')->with('status', 'Tambah Voucher Berhasil');
    }

    
}
