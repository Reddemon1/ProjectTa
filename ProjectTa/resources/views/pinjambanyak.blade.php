@extends('layout.main')
@section('content')

<form action="{{ url('pinjambanyak') }}" method="POST" style="margin-top: 80px">
    @csrf
    <table style="margin-left: 50px; font-size: 20px">
        <tr>
            <td style="padding-left:15px">Nama Barang</td>
            <td style="padding: 5px 10px 5px 10px">:</td>
            <td style="padding: 15px 10px 15px 10px"><select class="search" name="barang" id="barang" class="form-banyak" required>
                <option>Pilih Barang</option>
                @foreach ($tbbarang as $tbbarangs)
                    @php
                        $kategori = DB::table('tbkategoris')->where('id','=',$tbbarangs->kategori)->first();
                        $lokasi = DB::table('tblokasis')->where('id','=',$tbbarangs->lokasi)->first();
                        $jenis = DB::table('tbjenis')->where('id','=',$tbbarangs->jenis)->first();
                    @endphp
                    <option value="{{ $tbbarangs->id }}" onclick="f_fill('{{ $tbbarangs->id }}','{{ $tbbarangs->namabarang }}','{{ $jenis->jenis }}','{{ $kategori->kelompok }}','{{ $tbbarangs->stock }}','{{ $lokasi->lokasi }}')">{{ $tbbarangs->namabarang }}</option>
                @endforeach
            </select></td>
        </tr>
        <tr>
            <td style="padding-left:15px">Kategori</td>
            <td style="padding: 5px 10px 5px 10px">:</td>
            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" name="kategori" placeholder="Kategori" id="kategori" disabled></td>
        </tr>
        <tr>
            <td style="padding-left:15px">Jenis</td>
            <td style="padding: 5px 10px 5px 10px">:</td>
            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" name="jenis" id="jenis" placeholder="Jenis" disabled></td>
        </tr>
        <tr>
            <td style="padding-left:15px">Lokasi</td>
            <td style="padding: 5px 10px 5px 10px">:</td>
            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" name="lokasi" id="lokasi" placeholder="Lokasi" disabled></td>
        </tr>
        <tr>
            <td style="padding-left:15px">Jumlah</td>
            <td style="padding: 5px 10px 5px 10px">:</td>
            <td style="padding: 15px 10px 15px 10px"><input type="number" class="search" name="jumlah" id="jumlah" placeholder="Jumlah Barang" required></td>
        </tr>
        <tr colspan="3"><td><button class='btn-addk' type="submit">Pinjam</button></td></tr>
    </table>
    <input type="hidden" name="id" id="id">
    
</form>
    
    </div>
    </div>
    <script>
        function f_fill(id,namabarang,jenis,kategori,stock,lokasi){
            document.getElementById('lokasi').value = lokasi;
            document.getElementById('id').value = id;
            document.getElementById('jenis').value = jenis;
            document.getElementById('kategori').value = kategori;
            $('#jumlah').attr('max',stock)
            $('#jumlah').attr('placeholder','Jumlah Barang (maks: '+stock+')')
            
        }    
    </script>   
</body>
@endsection