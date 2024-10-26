<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class KelolaProdukController extends Controller
{
    public function index()
    {
        $category = CategoryProduct::all();
        $product = Product::all();

        return view('kelolaProduk', [
            'category' => $category,
            'product' => $product,
        ]);
    }

    public function storeCategory(Request $request)
    {
        try {
            // Validasi data input
            $request->validate([
                'name' => 'required',
            ]);

            // Membuat entri project baru
            $category = CategoryProduct::create([
                'name' => $request->name,
            ]);


            Alert::toast('Data Kategori Berhasil Ditambahkan.', 'success')->autoClose(10000);
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Terjadi Kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);
            return redirect()->back();
        }
    }

    public function updateCategory(Request $request)
    {
        try {
            // Validasi data input jika diperlukan
            $request->validate([
                'name' => 'required',
            ]);

            // Temukan user berdasarkan ID
            $category = CategoryProduct::where('id', $request->id)->firstOrFail();

            $category->update([
                'name' => $request->name,
            ]);

            // Redirect dan alert toast sukses
            Alert::toast('Data Project Berhasil Diubah.', 'success')->autoClose(10000);
            return redirect()->back();
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan jika terjadi pengecualian
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);

            return redirect()->back();
        }
    }

    public function destroyCategory(Request $request)
    {
        try {
            $category = CategoryProduct::where('id', $request->id)->firstOrFail();

            $category->delete($category);

            Alert::toast('Data Kategori Berhasil Dihapus.', 'success')->autoClose(10000);

            return redirect()->back();
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan jika terjadi pengecualian
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);

            return redirect()->back();
        }
    }

    public function storeProduct(Request $request)
    {
        try {
            // Validasi data input
            $request->validate([
                'name' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|integer|min:0', // Validasi stok harus integer dan tidak negatif
                'categories_id' => 'required|exists:categories_product,id', // Validasi kategori
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public'); // Ganti 'img' dengan 'images'
            }


            // Membuat entri produk baru
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'categories_id' => $request->categories_id, // Menggunakan foreign key dari categories_product
                'image' => $imagePath, // Simpan path gambar
            ]);

            Alert::toast('Data Produk Berhasil Ditambahkan.', 'success')->autoClose(10000);
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Terjadi Kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);
            return redirect()->back();
        }
    }


    public function updateProduct(Request $request)
    {
        try {
            // Validasi data input jika diperlukan
            $request->validate([
                'id' => 'required|exists:products,id', // Validasi ID produk
                'name' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|integer|min:0',
                'categories_id' => 'required|exists:categories_product,id', // Validasi kategori
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            ]);

            // Temukan produk berdasarkan ID
            $product = Product::where('id', $request->id)->firstOrFail();

            // Cek apakah ada gambar baru yang diunggah
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                // Simpan gambar baru
                $imagePath = $request->file('image')->store('images', 'public');
                $product->image = $imagePath;
            }

            // Update data produk
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'categories_id' => $request->categories_id,
                'image' => $product->image ?? null, // Menyimpan path gambar jika ada
            ]);

            // Redirect dan alert toast sukses
            Alert::toast('Data Produk Berhasil Diubah.', 'success')->autoClose(10000);
            return redirect()->back();
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan jika terjadi pengecualian
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);

            return redirect()->back();
        }
    }


    public function destroyProduct(Request $request)
    {
        try {
            $product = Product::where('id', $request->id)->firstOrFail();

            $product->delete($product);

            Alert::toast('Data Produk Berhasil Dihapus.', 'success')->autoClose(10000);

            return redirect()->back();
        } catch (\Exception $e) {
            // Menampilkan pesan kesalahan jika terjadi pengecualian
            Alert::toast('Terjadi kesalahan: ' . $e->getMessage(), 'error')->autoClose(10000);

            return redirect()->back();
        }
    }
}
