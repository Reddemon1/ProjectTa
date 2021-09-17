@extends('layout.sidebar');
@section('content')
    

                <div class="d-flex">
                    <h1 style="font-weight: bold; color:#FFC600">Inventaris</h1>  
                    <button class="btn-tambah mx-lg-3 mb-lg-2" onclick="location.href='/TambahBarang'">Tambah</button>
                </div>
                <div class="d-flex">
                <div style="margin-top: 20px">    
                    <table id="table_id" class="table table-striped" style="width: 930px; margin-top:50px; ">
                        <thead>
                        <tr bgcolor="#1D87E4" style="color: white;font-size:15px">
                            <td>No</td>
                            <td>Kode barang</td>
                            <td>Nama Barang</td>
                            <td>Stock</td>
                            <td>Kategori</td>
                            <td>Jenis</td>
                            <td>Lokasi</td>
                            
                            <td>Action</td>
                        </tr>
                    </thead>
                        @php
                            $x = 1;
                        @endphp
                        <tbody>
                        @foreach ($tbbarang as $tbbarangs)
                        <tr>
                            @php
                                $kategori = DB::table('tbkategoris')->where('id',$tbbarangs->kategori)->first();
                                $jenis = DB::table('tbjenis')->where('id',$tbbarangs->jenis)->first();
                                $lokasi = DB::table('tblokasis')->where('id',$tbbarangs->lokasi)->first();

                            @endphp
                            <td>{{ $x++ }}</td>
                            <td>{{ $tbbarangs->id }}</td>
                            <td>{{ $tbbarangs->namabarang }}</td>
                            <td>{{ $tbbarangs->stock }}</td>
                            <td>{{ $kategori->kelompok }}</td>
                            <td>{{ $jenis->jenis }}</td>
                            <td>{{ $lokasi->lokasi }}</td>
                            
                            <td class="d-flex">
                                <form action="{{ url('tbbarang/'.$tbbarangs->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn-act-tabel" type="submit" style="background: #C31814">Delete</button>
                                </form>
                                <button onclick="location.href='{{ url('tbbarang/'.$tbbarangs->id.'/edit') }}'" style="margin-left: 10px;background-color:#FFC600" class="btn-act-tabel">Edit</button>
                            </td>
                    
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="filter" style="width:170px">
                    <h3 style="overflow: hidden">Filter</h3>
                    <hr>
                    <div class="btn-filter-con">
                        <form method="GET" action="{{ url('InventarisSearch') }}">
                            <h5>Kategori</h5>    
                        @foreach ($tbkategori as $model)
                        @php
                            $checked = [];
                            if(isset($_GET['filter'])){
                                $checked = $_GET['filter'];
                            }
                        @endphp
                            <input type="checkbox" name="filter[]" value="{{ $model->id }}"
                            @if (in_array($model->id,$checked)) checked @endif
                            
                            >
                            <span>{{ $model->kelompok }}</span><br>
                            
                        @endforeach
                        <input type="checkbox" name="filter[]" value="0" checked hidden>
                        <h5 style="margin-top: 10px">Jenis</h5>
                            @foreach ($tbjenis as $model)
                            @php
                                $checkedjenis = [];
                                if(isset($_GET['filterjenis'])){
                                    $checked = $_GET['filterjenis'];
                                }
                            @endphp
                                <input type="checkbox" name="filterjenis[]" value="{{ $model->id }}"
                                @if (in_array($model->id,$checked)) checked @endif
                                
                                >
                                <span>{{ $model->jenis }}</span><br>
                                
                            @endforeach
                                <input type="checkbox" name="filterjenis[]" value="0" checked hidden>
                            <h5 style="margin-top: 10px">Lokasi</h5>
                                @foreach ($tblokasi as $model)
                                @php
                                    $checkedlokasi = [];
                                    if(isset($_GET['filterlokasi'])){
                                        $checked = $_GET['filterlokasi'];
                                    }
                                @endphp
                                    <input type="checkbox" name="filterlokasi[]" value="{{ $model->id }}"
                                    @if (in_array($model->id,$checked)) checked @endif
                                    
                                    >
                                    <span>{{ $model->lokasi }}</span><br>
                                    
                                @endforeach
                                    <input type="checkbox" name="filterlokasi[]" value="0" checked hidden>
         
                        <button type="submit" class="btn-act-tabel" style="width:145px;margin-top:10px;background-color: #1D87E4">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script>
            $(document).ready( function () {
            $('#table_id').DataTable();
            } );
            </script>        
    </body>
            @endsection