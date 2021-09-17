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
                <a class="btn_side" href="/User"><img src="../../image/btn-user.png" width="32px"><br>User</a><br><br>
                <a class="btn_side" href="{{ route('postlogout') }}"><img src="../../image/btn-logout.png" width="32px"><br>Keluar</a>
            </div>
            <div class="content-admin">
                <h1 style="font-weight: bold; color:#FFC600">Edit</h1>  
                <div class="d-flex" style="margin-top: 20px">
                    <div> <img src="../../image/gambar.png" width="450px" alt=""></div>
                    <form action="{{ url('tbuser/'.$model->id) }}" method="POST">
                        @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <table style="margin-left: 50px; font-size: 20px">
                        
                        <tr>
                            <td style="padding-left:15px">Kode User</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan NIS User" name="id" id="id" value="{{ $model->id }}"></td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px">Nama</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan Nama User" name="nama" id="nama" value="{{ $model->nama }}"></td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px">Email</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan Email User" name="email" id="email" value="{{ $model->email }}"></td>
                        </tr>
                        <tr>
                            <td style="padding-left:15px">Password</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px"><input type="text" class="search" placeholder="Inputkan Password User" name="password" id="password" value="{{ $model->password }}"></td>
                        </tr>
                        <input type="hidden" id="hidden-s" value="{{ $model->status }}">
                        <input type="hidden" id="hidden-k" value="{{ $model->kelas }}">
                        <tr>
                            <td style="padding-left:15px">Status</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px">
                                <select class="search" name="status" id="status" oninput="f_act(this.value)">
                                    @foreach ($tbstatus as $tbstatuses)
                                        <option value="{{ $tbstatuses->id }}">{{ $tbstatuses->status }}</option>
                                    @endforeach
                                    
                                </select>
                            </td>
                        </tr>
                        <tr id="con-kelas" hidden>
                            <td style="padding-left:15px">Kelas</td>
                            <td style="padding: 5px 10px 5px 10px">:</td>
                            <td style="padding: 15px 10px 15px 10px">
                                <select class="search" name="kelas" id="kelas" >
                                    @foreach ($tbkelas as $tbkelass)
                                        <option value="{{ $tbkelass->id }}">{{ $tbkelass->kelas }}</option>
                                    @endforeach
                                    <option value="0" hidden>Guru</option>
                                </select>    
                            </td>
                        </tr>
                        <tr>
                            <td><Button type="submit" class="btn-addk">Update</Button></td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script>
            var hkelas = document.getElementById('hidden-k').value;
            var hstatus = document.getElementById('hidden-s').value;
            var kelas = document.getElementById('kelas');
            var con = document.getElementById('con-kelas');
            if(hstatus != '1' && hstatus != '2'){
                con.hidden = false;
            }else{
                $("#kelas").val('0').change();
            }
            $("#kelas").val(hkelas).change();
            $("#status").val(hstatus).change();

            function f_act(stat){

                if(stat == '1' || stat=='2'){
                    con.hidden = true;
                    $("#kelas").val('0').change();
                }else if(stat =='3'){
                    con.hidden = false;
                    $("#kelas").val('1').change();
                }
            }
        </script>        
    </body>


        </html>
