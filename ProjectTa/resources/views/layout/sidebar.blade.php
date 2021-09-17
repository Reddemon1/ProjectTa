<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/main.css">
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
                <a class="btn_side" href="/HomeAdmin" ><img src="image/btn-home.png" width="32px"><br>Home</a><br><br>
                <a class="btn_side" href="/History"><img src="image/btn-history.png" width="32px"><br>Riwayat</a><br><br>
                <a class="btn_side" href="/Inventaris"><img src="image/btn-storage.png" width="32px"><br>inventaris</a><br><br>
                <a class="btn_side" href="/User"><img src="image/btn-user.png" width="32px"><br>User</a><br><br>
                <a class="btn_side" href="{{ route('postlogout') }}"><img src="image/btn-logout.png" width="32px"><br>Keluar</a>
            </div>
            <div class="content-admin">
                @yield('content')

</html>
