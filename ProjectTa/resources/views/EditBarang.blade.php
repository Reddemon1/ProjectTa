<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../css/main.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <a class="btn_side" href="/HomeAdmin" ><img src="../../image/btn-home.png" width="32px"><br>Home</a><br><br>
                <a class="btn_side" href="/History"><img src="../../image/btn-history.png" width="32px"><br>Riwayat</a><br><br>
                <a class="btn_side" href="/Inventaris"><img src="../../image/btn-storage.png" width="32px"><br>inventaris</a><br><br>
                <a class="btn_side" href="/Siswa"><img src="../../image/btn-user.png" width="32px"><br>User</a><br><br>
                <a class="btn_side" href="{{ route('postlogout') }}"><img src="../../image/btn-logout.png" width="32px"><br>Keluar</a>
            </div>
            <div class="content-admin">
                <h1 style="font-weight: bold; color:#FFC600">Edit Barang</h1>  
                <div class="d-flex" style="margin-top: 20px">
                    <div>
                    <img src="../../image/gambar.png" width="450px" alt="">
                </div>
                    <form action="{{ url('tbbarang/'.$model->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <table style="margin-left: 50px; font-size: 20px">
                        
                            <tr>
                                <td style="padding-left:15px">Id</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan Id Barang" name="id" id="id" value="{{ $model->id }}"></td>
                            </tr>
                            <tr>
                                <td style="padding-left:15px">Nama Barang</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan Nama Barang" name="namabarang" id="namabarang" value="{{ $model->namabarang }}"></td>
                            </tr>
                            <tr>
                                <td style="padding-left:15px">Stock</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px"><input type="number" class="search" placeholder="Inputkan Stock Barang" name="stock" id="stock" value="{{ $model->stock }}"></td>
                            </tr>
                            <input type="hidden"  id="hidden-k" value="{{ $model->kategori }}">
                            <input type="hidden"  id="hidden-j" value="{{ $model->jenis }}">
                            <input type="hidden"  id="hidden-l" value="{{ $model->lokasi }}">
                            <tr>
                                <td style="padding-left:15px">Kategori</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px">
                                    <select class="search" name="kategori" id="kategori" >
                                        @foreach ($tbkategori as $tbkategoris)
    
                                            <option value="{{ $tbkategoris->id }}"> {{ $tbkategoris->kelompok }}</option>
                                        @endforeach    
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:15px">Jenis</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px">
                                    <select class="search" name="jenis" id="jenis" >
                                        @foreach ($tbjenis as $tbjeniss)
                                            <option value="{{ $tbjeniss->id }}"> {{ $tbjeniss->jenis }}</option>
                                        @endforeach    
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left:15px">Lokasi</td>
                                <td style="padding: 5px 10px 5px 10px">:</td>
                                <td style="padding: 15px 10px 15px 10px">
                                    <select class="search" name="lokasi" id="lokasi" >
                                        @foreach ($tblokasi as $tblokasis)
                                            <option value="{{ $tblokasis->id }}"> {{ $tblokasis->lokasi }}</option>
                                        @endforeach    
                                    </select>    
                                </td>
                            </tr>
                            <tr>
                                <td><Button type="submit" class="btn-addk">Simpan</Button></td>
                            </tr>
                        </table>
                </form>
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script>
                var options = document.getElementById("kategori").options;
                var kategori = document.getElementById("hidden-k").value;

                var jenis = document.getElementById("hidden-j").value;
                var lokasi = document.getElementById("hidden-l").value;
                $("#kategori").val(kategori).change();
                $("#jenis").val(jenis).change();
                $("#lokasi").val(lokasi).change();
        </script>        
    </body>
        </html>
