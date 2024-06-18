<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\metodePembayaran;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $users = User::all();

        $ingfo_sakkarepmu = 'List Transaksi';
        $pemesanan = Pemesanan::all();
        $metodePembayaran = MetodePembayaran::all();
        $pembayarans = Pembayaran::all();
        $produks = Produk::select('id', 'kode_produk', 'nama_produk')->get();
        return view('panel.pembayaran.index', compact('pembayarans', 'ingfo_sakkarepmu', 'users', 'produks', 'pemesanan', 'metodePembayaran'));
    }

    public function create()
    {
        return view('pembayaran.create');
    }

    public function store(Request $request)
    {dd($request->all());
        // Validasi data yang diterima dari request
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanan,id',
            'metode_pembayaran_id' => 'required|exists:metode_pembayaran,id',
            'status' => 'required|in:pending,dibatalkan,diproses,dibayar',
        ]);

        // Ambil pemesanan berdasarkan pemesanan_id yang dipilih
        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);

        // Buat instance Pembayaran baru
        $pembayaran = new Pembayaran();
        $pembayaran->pemesanan_id = $request->pemesanan_id;
        // Ambil total dari pemesanan yang dipilih
        $pembayaran->total = $pemesanan->total;
        $pembayaran->metode_pembayaran_id = $request->metode_pembayaran_id;
        $pembayaran->status = $request->status;

        // Simpan data pembayaran ke database
        $pembayaran->save();

        // Redirect ke halaman tertentu setelah pembayaran berhasil disimpan
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan.');}

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('panel.pembayaran.show', compact('pembayaran'));
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

        return redirect()->route('pesanan.index')->with('error', 'Pembayaran tidak dapat diproses.');
    }

    // fungsi gawe export excel
    public function exportExcel()
    {
        return Excel::download(new PembayaranExport, 'pembayaran.xlsx');
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
