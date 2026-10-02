<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PpdbController extends Controller
{
    public function home() { return view('ppdb.home'); }
    public function register() { return view('ppdb.register'); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|string|max:100','gender'=>'required','nisn'=>'nullable|string|max:30','nik'=>'nullable|string|max:30','birth_place'=>'nullable|string|max:80','birth_date'=>'nullable|date','religion'=>'nullable|string|max:30','phone'=>'required|string|max:30','email'=>'nullable|email|max:120','address'=>'required|string','previous_school'=>'required|string|max:150','parent_name'=>'required|string|max:100','parent_phone'=>'required|string|max:30']);
        do { $code = 'PPDB-'.now()->format('ym').'-'.strtoupper(Str::random(5)); } while (Applicant::where('registration_code',$code)->exists());
        $applicant = Applicant::create($data + ['registration_code'=>$code]);
        return redirect()->route('status')->with('success', "Pendaftaran berhasil. Simpan nomor pendaftaran {$applicant->registration_code}.");
    }
    public function login() { return view('ppdb.login'); }
    public function authenticate(Request $request) {
        $request->validate(['email'=>'required|email','password'=>'required']);
        if ($request->email === 'admin@mujahidin.sch.id' && $request->password === 'admin123') { $request->session()->put('admin_auth', true); return redirect()->route('admin'); }
        return back()->withErrors(['email'=>'Email atau password salah. Demo admin: admin@mujahidin.sch.id / admin123']);
    }
    public function logout(Request $request) { $request->session()->forget('admin_auth'); return redirect()->route('home'); }
    public function status() { return view('ppdb.status'); }
    public function checkStatus(Request $request) { $request->validate(['registration_code'=>'required']); $applicant = Applicant::where('registration_code',$request->registration_code)->first(); return view('ppdb.status', compact('applicant')); }
    public function admin(Request $request) { abort_unless($request->session()->get('admin_auth'), 403); return view('admin.dashboard', ['applicants'=>Applicant::latest()->get()]); }
    public function confirm(Request $request, Applicant $applicant) { abort_unless($request->session()->get('admin_auth'), 403); $applicant->update(['status'=>'Terverifikasi']); return back()->with('success','Data pendaftar berhasil dikonfirmasi.'); }
    public function export(Request $request) { abort_unless($request->session()->get('admin_auth'), 403); $rows = Applicant::latest()->get(); return response()->streamDownload(function() use ($rows) { $out=fopen('php://output','w'); fputcsv($out,['Nomor Pendaftaran','Nama','NISN','Telepon','Sekolah Asal','Status']); foreach($rows as $r) fputcsv($out,[$r->registration_code,$r->name,$r->nisn,$r->phone,$r->previous_school,$r->status]); fclose($out); }, 'data-pendaftar-ppdb.csv'); }
}
