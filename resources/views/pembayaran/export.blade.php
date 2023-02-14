     <table>
         <thead>
             <tr>
                 <td>Nama Siswa</td>
                 <td>Nomor Pembayaran</td>
                 <td>Tanggal Pembayaran</td>
                 <td>Total Pembayaran</td>
                 <td>Status Pembayaran</td>
             </tr>
         </thead>
         <tbody>
             @foreach ($pembayaran as $p)
                 <tr>
                     <td>{{ $p->siswa->nama_siswa }}</td>
                     <td>{{ $p->id_pembayaran }}</td>
                     <td>{{ $p->tanggal_pembayaran }}</td>
                     <td>{{ $p->total_pembayaran }}</td>
                     <td>{{ $p->status }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
