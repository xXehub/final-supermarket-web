<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Kategori</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $index => $kategori)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kategori->kode_kategori }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>{{ $kategori->deskripsi }}</td>
                <td>{{ $kategori->created_at }}</td>
                <td>{{ $kategori->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
