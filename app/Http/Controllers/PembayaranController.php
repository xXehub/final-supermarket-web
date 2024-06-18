<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('panel.pembayaran.index', compact('pembayarans'));
    }

    public function create()
    {
        return view('pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'total' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        Pembayaran::create($request->all());
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pemesanan_id' => 'required',
            'total' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($request->all());
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }

    public function getData(Request $request)
    {
        $pembayarans = Pembayaran::with(['pemesanan.user', 'metode_pembayaran']);

        if ($request->ajax()) {
            return datatables()->of($pembayarans)
                ->addIndexColumn()
                ->addColumn('total', function ($pembayaran) {
                    return number_format($pembayaran->total, 2);
                })
                ->addColumn('nama_user', function ($pembayaran) {
                    return $pembayaran->pemesanan && $pembayaran->pemesanan->user ? $pembayaran->pemesanan->user->name : '';
                })

                ->addColumn('metode_pembayaran', function ($pembayaran) {
                    // Mengambil nama berdasarkan ID pada metode_pembayaran
                    return $pembayaran->metode_pembayaran ? $pembayaran->metode_pembayaran->nama : 'Metode Pembayaran Tidak Diketahui';
                })

                ->addColumn('kode_pesanan', function ($pembayaran) {
                    // Gunakan optional helper untuk memeriksa apakah pemesanan tidak null
                    return optional($pembayaran->pemesanan)->kode_pesanan;
                })
                ->addColumn('tanggal_pesan', function ($pembayaran) {
                    return $pembayaran->created_at->format('Y-m-d');
                })
                ->addColumn('gambar_profile', function ($pembayaran) {
                    // Periksa apakah ada relasi user dan user memiliki gambar_profile
                    return $pembayaran->user ? $pembayaran->user->gambar_profile : '';
                })
                ->addColumn('actions', function ($pembayaran) {
                    return view('panel.pembayaran.actions', compact('pembayaran'));
                })
                ->toJson();
        }
    }

    public function bayar()
    {
        // Mendapatkan pembayaran yang sesuai untuk pengguna yang sedang login
        $pembayaran = Pembayaran::whereHas('pemesanan', function ($query) {
            $query->where('user_id', auth()->id());
        })->where('status', 'pending')->first();

        if ($pembayaran) {
            // Update status pembayaran menjadi "dibayar"
            $pembayaran->update([
                'status' => 'diproses',
            ]);

            return redirect()->route('pesanan.index')->with('success', 'Pembayaran berhasil dilakukan.');
        }

        return redirect()->route('home')->with('error', 'Pembayaran tidak dapat diproses.');
    }
    // public function bayar(Request $request, $id)
    // {
    //     // Temukan data pembayaran berdasarkan ID
    //     $pembayaran = Pembayaran::findOrFail($id);

    //     // Lakukan validasi atau pengecekan lainnya sesuai kebutuhan
    //     // Misalnya, pastikan pembayaran belum dibayar sebelumnya

    //     // Ubah status pembayaran menjadi "dibayar"
    //     $pembayaran->update(['status' => 'dibayar']);

    //     // Redirect atau kembalikan respon sesuai kebutuhan
    //     return redirect()->back()->with('success', 'Pembayaran berhasil dilakukan.');
    // }

}
