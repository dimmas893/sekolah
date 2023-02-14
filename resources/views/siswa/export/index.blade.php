     <table>
         <thead>
         </thead>
         <tbody>
             @foreach ($siswa as $p)
                 <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $p->nomor_induk_siswa }}</td>
                     <td>{{ $p->nama_siswa }}</td>
                     <td>{{ $p->jenis_kelamin }}</td>
                     <td>{{ $p->email }}</td>
                     <td>{{ $p->telp }}</td>
                     <td>{{ $p->alamat }}</td>
                     <td>{{ $p->tingkat }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
