<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\CategoryEkstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryEkstrakulikulerController extends Controller
{
    public function index()
    {
        $categories = CategoryEkstrakulikuler::all();
        return view('backend.website.ekstrakulikuler.kategori.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.website.ekstrakulikuler.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Simpan file gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('kategori_ekstrakulikuler', 'public');
        }

        // Simpan data ke model CategoryEkstrakulikuler
        CategoryEkstrakulikuler::create([
            'category_name' => $data['category_name'],
            'description' => $data['description'],
            'image' => $data['image'] ?? null, // Opsional jika tidak ada gambar
        ]);

        return redirect()->route('category-ekstrakulikuler.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }




    public function edit(CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        return view('backend.website.ekstrakulikuler.kategori.edit', compact('categoryEkstrakulikuler'));
    }

    public function update(Request $request, CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Menghapus gambar lama jika ada
            if ($request->hasFile('image')) {
                if ($categoryEkstrakulikuler->image && Storage::disk('public')->exists($categoryEkstrakulikuler->image)) {
                    Storage::disk('public')->delete($categoryEkstrakulikuler->image);
                }
                $imagePath = $request->file('image')->store('kategori_ekstrakulikuler_images', 'public');
                $categoryEkstrakulikuler->image = $imagePath;
            }

            // Mengupdate data kategori ekstrakulikuler
            $categoryEkstrakulikuler->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
            ]);

            return redirect()->route('category-ekstrakulikuler.index')->with('success', 'Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




    public function destroy(CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        Storage::disk('public')->delete($categoryEkstrakulikuler->image);
        Alert::success('Success Title', 'Success Message');
        $categoryEkstrakulikuler->delete();
        return redirect()->route('category-ekstrakulikuler.index')->with('success', 'Kategori Ekstrakulikuler berhasil dihapus!');
    }
}
