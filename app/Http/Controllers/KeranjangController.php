<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{

    // Menampilkan semua entri dalam tabel keranjang
    public function index()
    {
        $userId = Auth::id(); // Dapatkan ID pengguna yang sedang masuk
        $keranjangs = Keranjang::where('user_id', $userId)->get();
        // Hitung total bayar
        $totalBayar = $keranjangs->sum(function ($keranjang) {
            return $keranjang->jumlah * $keranjang->produk->harga;
        });
        return view('supermarket.keranjang.index', compact('keranjangs', 'totalBayar'));
    }

    // Menampilkan formulir untuk membuat entri baru dalam tabel keranjang
    public function create()
    {
        return view('keranjang.create');
    }

    // Menyimpan entri baru dalam tabel keranjang ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            // Validasi data yang diterima dari formulir
        ]);

        Keranjang::create([
            // Simpan data dari formulir ke dalam tabel keranjang
        ]);

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Keranjang berhasil ditambahkan!');
    }

    // Menampilkan entri tertentu dalam tabel keranjang
    public function show($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('keranjang.show', ['keranjang' => $keranjang]);
    }

    // Menampilkan formulir untuk mengedit entri tertentu dalam tabel keranjang
    public function edit($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        return view('keranjang.edit', ['keranjang' => $keranjang]);
    }

    // Memperbarui entri tertentu dalam tabel keranjang di dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi data yang diterima dari formulir
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->update([
            // Perbarui data dari formulir di dalam entri keranjang yang ditemukan
        ]);

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    // Menghapus entri tertentu dari tabel keranjang di dalam database
    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        return redirect()->route('supermarket.keranjang.index')->with('success', 'Keranjang berhasil dihapus!');
    }

    public function tambahProduk(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Ambil data produk dari database berdasarkan ID yang diterima
        $produk = Produk::findOrFail($request->produk_id);

        // Simpan data produk ke dalam keranjang
        $keranjang = new Keranjang();
        $keranjang->produk_id = $produk->id;
        $keranjang->jumlah = $request->jumlah;
        // Tambahan informasi lain yang perlu disimpan di dalam keranjang
        $keranjang->save();

        // Berikan respons kepada pengguna (misalnya, redirect atau JSON response)
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // get data
    // get data
    public function getData(Request $request)
    {
        $userId = Auth::id(); // Dapatkan ID pengguna yang sedang masuk
        $keranjangs = Keranjang::with(['user', 'produk'])->where('user_id', $userId);
    
        if ($request->ajax()) {
            return datatables()->of($keranjangs)
                ->addIndexColumn()
                ->addColumn('nama_user', function ($keranjang) {
                    return $keranjang->user->name ?? 'N/A';
                })
                ->addColumn('nama_produk', function ($keranjang) {
                    return $keranjang->produk->nama_produk ?? 'N/A';
                })
                ->addColumn('harga', function ($keranjang) {
                    return $keranjang->produk->harga ?? 0;
                })
                ->addColumn('gambar_produk', function ($keranjang) {
                    return $keranjang->produk->gambar_produk ?? 'N/A';
                })
                ->addColumn('nama_kategori', function ($keranjang) {
                    return $keranjang->produk->kategori->nama_kategori ?? 'N/A';
                })
                ->addColumn('jumlah', function ($keranjang) {
                    return $keranjang->jumlah ?? 0;
                })
                ->addColumn('created_at', function ($keranjang) {
                    return $keranjang->created_at ? $keranjang->created_at->format('Y-m-d H:i:s') : 'N/A';
                })
                ->addColumn('subtotal', function ($keranjang) {
                    return ($keranjang->jumlah ?? 0) * ($keranjang->produk->harga ?? 0);
                })
                ->addColumn('actions', function ($keranjang) {
                    return view('supermarket.keranjang.actions', compact('keranjang'));
                })
                ->toJson();
        }
    }
    


}
