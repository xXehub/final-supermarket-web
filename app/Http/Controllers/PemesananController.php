<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Models\DetailPemesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Maatwebsite\Excel\Facades\Excel;

class PemesananController extends Controller
{
    public function index()
    {

        $ingfo_sakkarepmu = 'List Pemesanan';
        $pemesanans = Pemesanan::first();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        $users = User::all();
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
            'produk_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // ambil harga produk berdasarkan produk id
        $produk = Produk::findOrFail($request->produk_id);
        $hargaProduk = $produk->harga;

        // fungsi cek stock
        if ($produk->stock < $request->jumlah) {
            // handle error stock bos
            return redirect()->back()->with('gagal', 'Stok produk tidak mencukupi.');
        }

        // gawe simpan data pemesanan baru
        $pemesanan = new Pemesanan();
        $pemesanan->kode_pesanan = $request->kode_pesanan;
        $pemesanan->user_id = $request->user_id;
        $pemesanan->tanggal = $request->tanggal;
        $pemesanan->status = $request->status;
        $pemesanan->save();

        // gawe simpan detail pemesanan
        $detail_pemesanan = new DetailPemesanan();
        $detail_pemesanan->pemesanan_id = $pemesanan->id;
        $detail_pemesanan->produk_id = $request->produk_id;
        $detail_pemesanan->jumlah = $request->jumlah;
        $subtotal = $hargaProduk * $request->jumlah;
        $detail_pemesanan->subtotal = $subtotal;
        $detail_pemesanan->save();

        // gawe ngurangi stock produk
        $produk->stock -= $request->jumlah;
        $produk->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }


    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);
        $totalBarangDipesan = DetailPemesanan::where('pemesanan_id', $pemesanan->id)->sum('jumlah');
        if (!$pemesanan) {
            return abort(404);
        }

        $detail_pemesanan = DetailPemesanan::where('pemesanan_id', $id)->first();
        // Lakukan pemrosesan hanya jika pemesanan ditemukan
        $ingfo_sakkarepmu = 'Detail Pesanan';
        $user = User::all();
        $produk = Produk::all();

        return view('panel.pemesanan.show', [
            'ingfo_sakkarepmu' => $ingfo_sakkarepmu,
            'pemesanan' => $pemesanan,
            'users' => $user,
            'detail_pemesanan' => $detail_pemesanan,
            'totalBarangDipesan' => $totalBarangDipesan,
            'produks' => $produk
        ]);
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
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
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
                ->addColumn('gambar_profile', function ($pemesanan) {
                    return $pemesanan->user->gambar_profile;
                })
                ->addColumn('actions', function ($pemesanan) {
                    return view('panel.pemesanan.actions', compact('pemesanan'));
                })
                ->toJson();
        }
    }

    public function exportExcel()
    {
        return Excel::download(new PemesananExport, 'pemesanan.xlsx');
    }


}
