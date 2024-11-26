<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\CategoryEkstrakulikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'category_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required',
        ]);

        try {
            $imagePath = $request->file('image')->store('category_images', 'public');

            CategoryEkstrakulikuler::create([
                'category_name' => $request->category_name,
                'image' => $imagePath,
                'description' => $request->description,
            ]);

            return redirect()->route('category-ekstrakulikuler.index')->with('success', 'Kategori Ekstrakulikuler berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function edit(CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        return view('backend.website.ekstrakulikuler.kategori.edit', compact('categoryEkstrakulikuler'));
    }

    public function update(Request $request, CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        $request->validate([
            'category_name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            // Update image if a new one is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($categoryEkstrakulikuler->image && Storage::disk('public')->exists($categoryEkstrakulikuler->image)) {
                    Storage::disk('public')->delete($categoryEkstrakulikuler->image);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('category_images', 'public');
                $categoryEkstrakulikuler->image = $imagePath;
            }

            // Update other fields
            $categoryEkstrakulikuler->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
            ]);

            return redirect()->route('category-ekstrakulikuler.index')->with('success', 'Kategori Ekstrakulikuler berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function destroy(CategoryEkstrakulikuler $categoryEkstrakulikuler)
    {
        // Delete image from storage
        Storage::disk('public')->delete($categoryEkstrakulikuler->image);

        $categoryEkstrakulikuler->delete();
        return redirect()->route('category-ekstrakulikuler.index')->with('success', 'Kategori Ekstrakulikuler berhasil dihapus!');
    }
}
