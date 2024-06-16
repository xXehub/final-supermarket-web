<?php

namespace App\Http\Controllers;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPemesananController extends Controller
{
    public function index()
    {
        $detailPemesanans = DetailPemesanan::all();
        return view('detail_pemesanan.index', compact('detailPemesanans'));
    }

    public function create()
    {
        return view('detail_pemesanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
            'produk_id' => 'required', // Tambahkan validasi untuk produk_id
            'jumlah' => 'required|numeric|min:1', // Validasi jumlah pesanan
        ]);

        // Simpan data pemesanan baru
        $pemesanan_baru = new Pemesanan();
        $pemesanan_baru->user_id = $request->user_id;
        $pemesanan_baru->tanggal = $request->tanggal;
        $pemesanan_baru->status = $request->status;
        $pemesanan_baru->save();

        // Simpan detail pemesanan
        $detail_pemesanan = new DetailPemesanan();
        $detail_pemesanan->pemesanan_id = $pemesanan_baru->id;
        $detail_pemesanan->produk_id = $request->produk_id;
        $detail_pemesanan->jumlah = $request->jumlah;
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

        DetailPemesanan::create($request->all());
        return redirect()->route('detail_pemesanan.index')->with('success', 'Detail Pemesanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        return view('detail_pemesanan.show', compact('detailPemesanan'));
    }

    public function edit($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        return view('detail_pemesanan.edit', compact('detailPemesanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required',
            'subtotal' => 'required',
        ]);

        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->update($request->all());
        return redirect()->route('detail_pemesanan.index')->with('success', 'Detail Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $detailPemesanan = DetailPemesanan::findOrFail($id);
        $detailPemesanan->delete();
        return redirect()->route('detail_pemesanan.index')->with('success', 'Detail Pemesanan berhasil dihapus.');
    }

    // gawe get Data
    public function getData(Request $request)
    {
        // Mengambil ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil detail pemesanans yang terkait dengan pengguna saat ini
        $detailPemesanans = DetailPemesanan::with('pemesanan', 'produk')
            ->whereHas('pemesanan', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        if ($request->ajax()) {
            return datatables()->of($detailPemesanans)
                ->addIndexColumn()
                ->addColumn('nama_pemesanan', function ($detailPemesanan) {
                    return $detailPemesanan->pemesanan->id;
                })
                ->addColumn('nama_produk', function ($detailPemesanan) {
                    return $detailPemesanan->produk->nama_produk;
                })
                ->addColumn('jumlah', function ($detailPemesanan) {
                    return $detailPemesanan->jumlah;
                })
                ->addColumn('subtotal', function ($detailPemesanan) {
                    return $detailPemesanan->subtotal;
                })
                ->addColumn('total_harga', function ($detailPemesanan) {
                    return $detailPemesanan->jumlah * $detailPemesanan->produk->harga;
                })
                ->addColumn('actions', function ($detailPemesanan) {
                    return view('panel.detail_pemesanan.actions', compact('detailPemesanan'));
                })
                ->toJson();
        }
    }
}
