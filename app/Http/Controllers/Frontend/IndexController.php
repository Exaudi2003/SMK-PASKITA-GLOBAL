<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Berita;
use App\Models\Events;
use App\Models\Footer;
use App\Models\ImageSlider;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\KategoriBerita;
use App\Models\Kegiatan;
use App\Models\ProfileSekolah;
use App\Models\User;
use App\Models\Video;
use App\Models\Visimisi;
use App\Models\Ekstrakulikuler;
use App\Models\GaleriSekolah;

class IndexController extends Controller
{
    public function index()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $slider = ImageSlider::where('is_Active', '0')->get();
        $about = About::where('is_Active', '0')->first();
        $video = Video::where('is_active', '0')->first();
        $pengajar = User::with('userDetail')->where('status', 'Aktif')->where('role', 'Guru')->get();
        $berita = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $ekstrakulikulerM = Ekstrakulikuler::orderBy('created_at', 'desc')->get();
        $galeriSekolah = GaleriSekolah::get();
        $event = Events::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $footer = Footer::first();
        return view('frontend.welcome', compact('jurusanM', 'kegiatanM', 'slider', 'about', 'video', 'pengajar', 'berita', 'event', 'footer', 'ekstrakulikulerM', 'galeriSekolah'));
    }


    public function berita()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $ekstrakulikulerM = Ekstrakulikuler::orderBy('created_at', 'desc')->get();
        $galeriSekolah = GaleriSekolah::get();
        $footer = Footer::first();
        $kategori = KategoriBerita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $berita = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.content.beritaAll', compact('berita', 'kategori', 'ekstrakulikulerM', 'galeriSekolah', 'jurusanM', 'kegiatanM', 'footer'));
    }

    public function detailBerita($slug)
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $ekstrakulikulerM = Ekstrakulikuler::get();
        $footer = Footer::first();
        $kategori = KategoriBerita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $beritaOther = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->get();

        $berita = Berita::where('slug', $slug)->first();
        return view('frontend.content.showBerita', compact('berita', 'kategori', 'ekstrakulikulerM', 'beritaOther', 'jurusanM', 'kegiatanM', 'footer'));
    }



    public function events()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $footer = Footer::first();
        $berita = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->get();

        $event = Events::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        return view('frontend.content.event.eventAll', compact('event', 'berita', 'jurusanM', 'kegiatanM', 'footer'));
    }

    public function detailEvent($slug)
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $footer = Footer::first();
        $berita = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $event = Events::where('slug', $slug)->first();
        $eventOther = Events::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        return view('frontend.content.event.detailEvent', compact('event', 'eventOther', 'berita', 'jurusanM', 'kegiatanM', 'footer'));
    }

    public function detailEkstrakulikuler($id)
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $footer = Footer::first();
        $berita = Berita::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        $ekstrakulikuler = Ekstrakulikuler::findOrFail($id);
        $ekstrakulikulerM = Ekstrakulikuler::orderBy('created_at', 'desc')->get();
        $galeriSekolah = GaleriSekolah::get();
        $eventOther = Events::where('is_active', '0')->orderBy('created_at', 'desc')->get();
        return view('frontend.content.ekstrakulikuler.show', compact('ekstrakulikuler', 'ekstrakulikulerM', 'galeriSekolah', 'eventOther', 'berita', 'jurusanM', 'kegiatanM', 'footer'));
    }

    public function profileSekolah()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $pengajar = User::with('userDetail')->where('status', 'Aktif')->where('role', 'Guru')->get();
        $ekstrakulikulerM = Ekstrakulikuler::get();
        $footer = Footer::first();
        $galeriSekolah = GaleriSekolah::get();
        $profile = ProfileSekolah::first();
        return view('frontend.content.profileSekolah', compact('profile', 'ekstrakulikulerM', 'galeriSekolah', 'jurusanM', 'kegiatanM', 'pengajar', 'footer'));
    }

    public function visimisi()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $pengajar = User::with('userDetail')->where('status', 'Aktif')->where('role', 'Guru')->get();
        $ekstrakulikulerM = Ekstrakulikuler::get();
        $footer = Footer::first();
        $galeriSekolah = GaleriSekolah::get();
        $visimisi = Visimisi::first();
        return view('frontend.content.visimisi', compact('visimisi', 'ekstrakulikulerM', 'galeriSekolah', 'jurusanM', 'kegiatanM', 'pengajar', 'footer'));
    }

    public function galeriSekolah()
    {
        $jurusanM = Jurusan::where('is_active', '0')->get();
        $kegiatanM = Kegiatan::where('is_active', '0')->get();
        $pengajar = User::with('userDetail')->where('status', 'Aktif')->where('role', 'Guru')->get();
        $ekstrakulikulerM = Ekstrakulikuler::get();
        $galeriSekolah = GaleriSekolah::get();
        $footer = Footer::first();
        $visimisi = Visimisi::first();
        return view('frontend.content.galeriSekolah', compact('visimisi', 'ekstrakulikulerM', 'galeriSekolah', 'jurusanM', 'kegiatanM', 'pengajar', 'footer'));
    }
}
