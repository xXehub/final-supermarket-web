<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {

        $ingfo_sakkarepmu = 'List Pemesanan';
        $pemesanans = Pemesanan::all();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        $users = User::select('id', 'name')->get(); // Ambil daftar pengguna
        return view('panel.pemesanan.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pemesanan' => $pemesanans,
            'users' => $users,
            'produks' => $produks,
        ]);
    }

    public function create()
    {
        return view('pemesanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pesanan' => 'required',
            'user_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'produk_id' => 'required', // Tambahkan validasi untuk produk_id
            'jumlah' => 'required|numeric|min:1', // Validasi jumlah pesanan
        ]);

        // Ambil harga produk berdasarkan produk_id dari permintaan
        $produk = Produk::findOrFail($request->produk_id);
        $hargaProduk = $produk->harga; // Misalnya harga produk diambil dari field 'harga' pada model Produk


        // Simpan data pemesanan baru
        $pemesanan = new Pemesanan();
        $pemesanan->kode_pesanan = $request->kode_pesanan;
        $pemesanan->user_id = $request->user_id;
        $pemesanan->tanggal = $request->tanggal;
        $pemesanan->status = $request->status;
        $pemesanan->save();

        // Simpan detail pemesanan
        $detail_pemesanan = new DetailPemesanan();
        $detail_pemesanan->pemesanan_id = $pemesanan->id;
        $detail_pemesanan->produk_id = $request->produk_id;
        $detail_pemesanan->jumlah = $request->jumlah;
        // Hitung subtotal
        $subtotal = $hargaProduk * $request->jumlah;
        $detail_pemesanan->subtotal = $subtotal;
        $detail_pemesanan->save();

        // Mengurangi stok produk
        $produk_id = $request->produk_id;
        $jumlah_pesanan = $request->jumlah;

        // Cek apakah stok mencukupi sebelum mengurangi
        $produk = Produk::findOrFail($produk_id);
        if ($produk->stock >= $jumlah_pesanan) {
            $produk->stock -= $jumlah_pesanan;
            $produk->save();
        } else {
            // Handle kasus ketika stok tidak mencukupi
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
        }
        return redirect()->route('pemesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pemesanan.edit', compact('pemesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($request->all());
        return redirect()->route('panel.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }

    public function getData(Request $request)
    {
        $pemesanans = Pemesanan::with('user');

        if ($request->ajax()) {
            return datatables()->of($pemesanans)
                ->addIndexColumn()
                ->addColumn('nama_user', function ($pemesanan) {
                    return $pemesanan->user->name;
                })
                ->addColumn('actions', function ($pemesanan) {
                    return view('panel.pemesanan.actions', compact('pemesanan'));
                })
                ->toJson();
        }
    }

}
