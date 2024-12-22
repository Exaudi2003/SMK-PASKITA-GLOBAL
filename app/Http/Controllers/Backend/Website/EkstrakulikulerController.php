<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use App\Models\CategoryEkstrakulikuler;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EkstrakulikulerController extends Controller
{
    public function index()
    {
        $ekstrakulikulers = Ekstrakulikuler::with('category')->get();
        return view('backend.website.ekstrakulikuler.index', compact('ekstrakulikulers'));
    }

    public function create()
    {
        $categories = CategoryEkstrakulikuler::all();
        return view('backend.website.ekstrakulikuler.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_ekstrakulikuler_id' => 'required|exists:category_ekstrakulikulers,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('ekstrakulikuler', 'public');
        }

        Ekstrakulikuler::create($data);
        Alert::success('Berhasil', 'Ekstrakulikuler berhasil ditambahkan!');
        return redirect()->route('ekstrakulikuler.index')->with('success', 'Ekstrakulikuler berhasil ditambahkan!');
    }

    public function show($id)
{
    $ekstrakulikuler = Ekstrakulikuler::with('category')->findOrFail($id);
    $galeri = $ekstrakulikuler->galeriEkstrakulikuler;
    return view('backend.website.ekstrakulikuler.show', compact('ekstrakulikuler', 'galeri'));
}



    public function edit($id)
    {
        $ekstrakulikuler = Ekstrakulikuler::findOrFail($id);
        $categories = CategoryEkstrakulikuler::all();
        return view('backend.website.ekstrakulikuler.edit', compact('ekstrakulikuler', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_ekstrakulikuler_id' => 'required|exists:category_ekstrakulikulers,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $ekstrakulikuler = Ekstrakulikuler::findOrFail($id);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($ekstrakulikuler->image && file_exists(storage_path('app/public/' . $ekstrakulikuler->image))) {
                unlink(storage_path('app/public/' . $ekstrakulikuler->image));
            }

            $data['image'] = $request->file('image')->store('ekstrakulikuler', 'public');
        }

        $ekstrakulikuler->update($data);
        Alert::success('Berhasil', 'Ekstrakulikuler berhasil diedit!');
        return redirect()->route('ekstrakulikuler.index')->with('success', 'Ekstrakulikuler berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ekstrakulikuler = Ekstrakulikuler::findOrFail($id);

        if ($ekstrakulikuler->image && file_exists(storage_path('app/public/' . $ekstrakulikuler->image))) {
            unlink(storage_path('app/public/' . $ekstrakulikuler->image));
        }

        $ekstrakulikuler->delete();
        Alert::success('Success', 'Berhasil menghapus Data!');
        return redirect()->route('ekstrakulikuler.index')->with('success', 'Ekstrakulikuler berhasil dihapus!');
    }
}
