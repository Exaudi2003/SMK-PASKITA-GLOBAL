<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use RealRashid\SweetAlert\Facades\Alert;

class AlumniController extends Controller
{

    public function index(Request $request)
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        if ($request->has('jurusan_id') && $request->jurusan_id != '') {
            $alumnis = Alumni::where('jurusan_id', $request->jurusan_id)->get();
        } else {
            $alumnis = Alumni::all();
        }
        return view('frontend.content.alumni.list-alumni', [
            'alumnis' => $alumnis,
            'jurusanM' => $jurusanM,
            'kegiatanM' => $kegiatanM,
        ]);
    }

    public function create()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        return view('frontend.content.alumni.register-alumni',[
            'jurusanM' => $jurusanM,
            'kegiatanM' => $kegiatanM
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'jurusan_id' => 'required|exists:jurusans,id',
            'nomor_hp' => 'required|string|max:20',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:bekerja,kuliah,tidak bekerja',
        ]);

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        } else {
            $path = null;
        }

        // Simpan data alumni
        Alumni::create([
            'nama_lengkap' => $request->nama_lengkap,
            'angkatan' => $request->angkatan,
            'jurusan_id' => $request->jurusan_id,
            'nomor_hp' => $request->nomor_hp,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'photo' => $path,
            'status' => $request->status,
        ]);
        Alert::success('Success', 'Terima Kasih Sudah Mendaftar Sebagai Alumni');
        return redirect()->route('alumni.index')->with('success', 'Alumni berhasil terdaftar');
    }
}
