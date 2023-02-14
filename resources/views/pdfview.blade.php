<a href="{{ route('buatPdf') }}">Download PDF</a>
<table>
<tr>
<th>No</th>
<th>Title</th>
<th>Description</th>
</tr>
@foreach ($items as $key => $item)
<tr>
<td>{{ ++$key }}</td>
<td>{{ $item->nama_siswa }}</td>
<td>{{ $item->email }}</td>
</tr>
@endforeach
</table>