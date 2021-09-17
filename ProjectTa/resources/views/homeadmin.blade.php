@extends('layout.sidebar')
@section('content')
                <h2 style="font-weight: bold">Welcome, Admin</h2>    
                <div class="d-flex" style="margin-top: 30px">
                    @php
                        $produk = DB::table('tbbarangs')->count();
                        $user = DB::table('tbusers')->count();
                        $peminjaman = DB::table('tbpinjams')->count();
                        $orang12 = DB::table('tbpinjams')->where("kelompok","=","12")->count();
                        $orang11 = DB::table('tbpinjams')->where("kelompok","=","11")->count();
                        $orang10 = DB::table('tbpinjams')->where("kelompok","=","10")->count();
                        $orang13 = DB::table('tbpinjams')->where("kelompok","=","-")->count();
                    @endphp
                    <input type="hidden" id="orang12" value="{{ $orang12 }}">
                    <input type="hidden" id="orang11" value="{{ $orang11 }}">
                    <input type="hidden" id="orang10" value="{{ $orang10 }}">
                    <input type="hidden" id="orang13" value="{{ $orang13 }}">
                    <div class="produk">
                        <h4 class="count">{{ $produk }}</h4>
                    </div>
                    <div class="user">
                        <h4 class="count">{{ $user }}</h4>
                    </div>
                    <div class="peminjaman">
                        <h4 class="count">{{ $peminjaman }}</h4>
                    </div>
                </div>
                <div class="d-flex">
                    <div style="margin-top: 30px ;width: 900px">
                        <table border="0" style="" id="table_id" class="display tabel table table-striped">
                            <thead>
                            <tr bgcolor="#1D87E4">
                                <td class="th">No</td>
                                <td class="th">Kode User</td>
                                <td class="th">Nama</td>

                                <td class="th">Nama Barang</td>
                                <td class="th">Kode Barang</td>
                                <td class="th">Status</td>
                            </tr> 
                        </thead>
                            @php
                                $x = 1;
                            @endphp 
                            <tbody>
                            @foreach ($tbpinjam as $tbpinjams)
                            @php
                                $namabarang = DB::table('tbbarangs')->where('id','=',$tbpinjams->kodebarang)->first();
                            @endphp
                            
                            <tr >
                                <td>{{ $x++ }}</td>
                                <td>{{ $tbpinjams->nis_id }}</td>
                                <td>{{ $tbpinjams->nama }}</td>
                                <td>{{ $namabarang->namabarang }}</td>
                                <td>{{ $tbpinjams->kodebarang }}</td>
                                <td>{{ $tbpinjams->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>  
                        </table>
                    </div>
                    <div id="donutchart" style="width: 420px; height: 320px;"></div>
                    
                </div>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
            </body>
            <script type="text/javascript">
                
                var orang10 = document.getElementById('orang10').value;
                var orang11 = document.getElementById('orang11').value;
                var orang12 = document.getElementById('orang12').value;
                var orang13 = document.getElementById('orang13').value;
                var o10 = parseInt(orang10);
                var o11 = parseInt(orang11);
                var o12 = parseInt(orang12);
                var o13 = parseInt(orang13);
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Peminjaman', 'Kelas'],
                    ['12',o12],
                    ['11',o11],
                    ['10',o10],
                    ['Guru/Staff',o13],
                    ]);
            
                    var options = {
                    // title: 'Peminjaman',
                    pieHole: 0.4,
                    };
            
                    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                    chart.draw(data, options);
                }
                $(document).ready(function() {
                $('#table_id').DataTable( {
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    } );
                } );
            </script>  
@endsection
