<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Pesanan</th>
            <th>Metode Pembayaran</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pembayaran as $index => $pembayaran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pembayaran->pemesanan->kode_pesanan }}</td>
                <td>{{ $pembayaran->total }}</td>
                <td>{{ $pembayaran->metode_pembayaran->nama }}</td>
                <td>{{ $pembayaran->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
