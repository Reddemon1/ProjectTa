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
                <h1 style="font-weight: bold; color:#FFC600">Siswa</h1>  
                <form action="/SiswaSearch" method="GET" role="search" class="form">
                    @csrf
                    <input type="text" class="search" name="search"  placeholder="Cari Siswa">
                    <button type="submit" class="btn-search">Search</button>
                </form>
                <button class="btn-tambah" style="margin-top:20px" onclick="location.href='/TambahSiswa'">Tambah</button>
                <div class="d-flex">
                <div class="tabel-show" style="height: fit-content">
                <table class="table table-striped" style="width: 900px; margin-top:20px;font-size:13px ">
                    <tr bgcolor="#1D87E4" style="color: white;font-size:15px;">
                        <td>No</td>
                        <td>NIS</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Password</td>
                        <td>Kelas</td>
                        <td colspan="2">Action</td>
                    </tr>
                    @php
                        $x = 1;
                    @endphp
                    @foreach ($tbuser as $tbusers)
                    <tr>
                        <td>{{ $x++ }}</td>
                        <td>{{ $tbusers->id }}</td>
                        <td>{{ $tbusers->nama }}</td>
                        <td>{{ $tbusers->email }}</td>
                        <td>{{ $tbusers->password }}</td>
                        <td>{{ $tbusers->kelas }}</td>
                        <td>
                            <form action="{{ url('tbuser/'.$tbusers->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn-act-tabel" type="submit" style="background: #C31814">Delete</button>
                            </form>
                            
                        </td>
                        <td><button onclick="location.href='{{ url('tbuser/'.$tbusers->id.'/edit') }}'" style="margin-left: 10px;background-color:#FFC600" class="btn-act-tabel">Edit</button></td>
                
                    </tr>
                    @endforeach
                </table>
            </div>
                <div class="filter" style="">
                    <h3 style="overflow: hidden " >Filter</h3>
                    <hr>
                    <div class="btn-filter-con">
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 TKJ 1'">10 TKJ 1</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 TKJ 2'">10 TKJ 2</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 TKJ 3'">10 TKJ 3</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 AK 1'">10 AK 1</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 AK 2'">10 AK 2</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 AK 3'">10 AK 3</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 PM 1'">10 PM 1</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 PM 2'">10 PM 2</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/10 PM 3'">10 PM 3</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 TKJ 1'">11 TKJ 1</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 TKJ 2'">11 TKJ 2</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 TKJ 3'">11 TKJ 3</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 AK 1'">11 AK 1</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 AK 2'">11 AK 2</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 AK 3'">11 AK 3</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 PM 1'">11 PM 1</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 PM 2'">11 PM 2</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/11 PM 3'">11 PM 3</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 TKJ 1'">12 TKJ 1</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 TKJ 2'">12 TKJ 2</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 TKJ 3'">12 TKJ 3</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 AK 1'">12 AK 1</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 AK 2'">12 AK 2</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 AK 3'">12 AK 3</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 PM 1'">12 PM 1</button>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 PM 2'">12 PM 2</button><br>
                        <button class="btn-filter" onclick="location.href='/FilterKelas/12 PM 3'">12 PM 3</button>
                    </div>
                </div>
            </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
            </body>
</html>           