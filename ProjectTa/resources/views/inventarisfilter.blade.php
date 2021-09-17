<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
                <!-- Font Awesome -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
        />
        <!-- MDB -->
        <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
        rel="stylesheet"
        />

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <title>Sarpras</title>
    </head>
        <body>
            <div id="sidebar " class="sidebar">
                <a class="btn_side" href="/HomeAdmin" ><img src="../image/btn-home.png" width="32px"><br>Home</a><br><br>
                <a class="btn_side" href="/History"><img src="../image/btn-history.png" width="32px"><br>Riwayat</a><br><br>
                <a class="btn_side" href="/Inventaris"><img src="../image/btn-storage.png" width="32px"><br>inventaris</a><br><br>
                <a class="btn_side" href="/Siswa"><img src="../image/btn-user.png" width="32px"><br>Siswa</a><br><br>
                <a class="btn_side" href="{{ route('postlogout') }}"><img src="../image/btn-logout.png" width="32px"><br>Keluar</a>
            </div>
            <div class="content-admin">
                <h1 style="font-weight: bold; color:#FFC600">Inventaris</h1>  
                <form action="/InventarisSearch" method="GET" role="search" class="form">
                    @csrf
                    <input type="text" class="search" name="search"  placeholder="Cari barang">
                    <button type="submit" class="btn-search">Search</button>
                </form>
                <button class="btn-tambah" onclick="location.href='/TambahBarang'">Tambah</button>
                <div class="d-flex">
                    <div>
                <table class="table table-striped" style="width: 900px; margin-top:20px; ">
                    <tr bgcolor="#1D87E4" style="color: white;font-size:15px">
                        <td>No</td>
                        <td>Kode barang</td>
                        <td>Nama Barang</td>
                        <td>Kategori</td>
                        <td>Status</td>
                        <td colspan="2">Action</td>
                    </tr>
                    @php
                        $x = 1;
                    @endphp
                    @foreach ($tbbarang as $tbbarangs)
                    <tr>
                        <td>{{ $x++ }}</td>
                        <td>{{ $tbbarangs->id }}</td>
                        <td>{{ $tbbarangs->namabarang }}</td>
                        <td>{{ $tbbarangs->jenis }}</td>
                        <td>{{ $tbbarangs->status }}</td>
                        <td>
                            <form action="{{ url('tbbarang/'.$tbbarangs->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn-act-tabel" type="submit" style="background: #C31814">Delete</button>
                            </form>
                            
                        </td>
                        <td><button onclick="location.href='{{ url('tbbarang/'.$tbbarangs->id.'/edit') }}'" style="margin-left: 10px;background-color:#FFC600" class="btn-act-tabel">Edit</button></td>
                
                    </tr>
                    @endforeach
                </table>
            </div>
                <div class="filter" style="">
                    <h3 style="overflow: hidden">Filter</h3>
                    <hr>
                    <div class="btn-filter-con">
                        <form method="GET" action="{{ url('InventarisSearch') }}">
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
                            <button type="submit">P</button>
                            </form></div>
                </div>
            </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
            </body>
        </html>
