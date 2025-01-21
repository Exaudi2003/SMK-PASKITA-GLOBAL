<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\GaleriSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = GaleriSekolah::all();
        return view('backend.website.galeri.index', [
            'title' => 'Galeri Ekstrakurikuler',
            'galeris' => $galeris,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_path' => 'required|file|mimes:jpeg,png,jpg,mp4|max:2048',
        ]);

        $path = $request->file('image_path')->store('galeri-sekolah', 'public');

        $galeri = GaleriSekolah::create([
            'image_path' => $path,
        ]);

        if ($galeri) {
            Alert::success('Berhasil', 'Galeri berhasil ditambahkan!');
            return back();
        }

        Alert::error('Gagal', 'Galeri gagal ditambahkan!');
        return back();
    }


    public function destroy($id)
    {
        $galeri = GaleriSekolah::findOrFail($id);
        if ($galeri->image_path && Storage::disk('public')->exists($galeri->image_path)) {
            Storage::disk('public')->delete($galeri->image_path);
        }
        $galeri->delete();
        return redirect()->back()->with('success', 'Galeri berhasil dihapus!');
    }
}
