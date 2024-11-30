<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\GaleriEkstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GaleriEkstrakulikulerController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'ekstrakulikuler_id' => 'required|exists:ekstrakulikuler,id',
            'path' => 'required|file|mimes:jpeg,png,jpg,mp4|max:2048',
        ]);
        $path = $request->file('path')->store('galeri', 'public');
        $galeri = GaleriEkstrakulikuler::create([
            'ekstrakulikuler_id' => $request->ekstrakulikuler_id,
            'path' => $path,
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
        $galeri = GaleriEkstrakulikuler::findOrFail($id);
        if (Storage::exists('public/' . $galeri->path)) {
            Storage::delete('public/' . $galeri->path);
        }

        $galeri->delete();

        Alert::success('Berhasil', 'Galeri berhasil dihapus!');
        return back();
    }
}
