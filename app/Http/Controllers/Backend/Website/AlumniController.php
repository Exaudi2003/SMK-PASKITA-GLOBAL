<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(){
        $jurusans = Jurusan::all();
        $alumni = Alumni::all();
        return view('backend.website.alumni.index',[
            'alumnis' => $alumni,
            'jurusans' => $jurusans
        ]);
    }
}
