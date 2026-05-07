<tbody>
@forelse($warga as $k)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $k->nama }}</td>
    <td>{{ $k->alamat }}</td>
    <td>
        <a href="/warga/edit/{{ $k->id }}" class="btn btn-warning btn-sm">Edit</a>
        <a href="/warga/delete/{{ $k->id }}" class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">Data tidak ditemukan</td>
</tr>
@endforelse
</tbody>