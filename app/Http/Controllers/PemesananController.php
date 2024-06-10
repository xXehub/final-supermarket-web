<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pemesanan;

class PemesananController extends Controller
{
    public function index()
    {
        $ingfo_sakkarepmu = 'List Pemesanan';
        $pemesanans = Pemesanan::all();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        return view('panel.pemesanan.index', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pemesanan' => $pemesanans,
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
            'user_id' => 'required',
            'tanggal' => 'required',
            'status' => 'required',
        ]);

        Pemesanan::create($request->all());
        return redirect()->route('panel.pemesanan.index')->with('success', 'Pemesanan berhasil ditambahkan.');
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
        return redirect()->route('panel.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
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
