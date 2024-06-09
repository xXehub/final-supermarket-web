<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPemesanan;

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
            'pemesanan_id' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required',
            'subtotal' => 'required',
        ]);

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
        $detailPemesanans = DetailPemesanan::with('pemesanan', 'produk');

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
                ->addColumn('actions', function ($detailPemesanan) {
                    return view('panel.detail_pemesanan.actions', compact('detailPemesanan'));
                })
                ->toJson();
        }
    }

}
