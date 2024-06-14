<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pemesanan as $index => $pemesanan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pemesanan->kode_pesanan }}</td>
                <td>{{ $pemesanan->user->name }}</td>
                <td>{{ $pemesanan->tanggal }}</td>
                <td>{{ $pemesanan->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
