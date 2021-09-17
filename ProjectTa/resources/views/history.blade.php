@extends('layout.sidebar')
@section('content')
<h1 style="font-weight: bold; color:#FFC600; margin-top: 20px;">Riwayat</h1>  
<div style="width: 1100px;margin-top:40px" class="d-flex">
    <div>
    <table id="mytable" class="display table table-striped" style="width:900px;margin-left:0;margin-top:10px; ">
        <thead>
        <tr bgcolor="#1D87E4" style="color: white;font-size:15px">
            <td>Nama Peminjam</td>
            <td>Kode User</td>
            <td>Kelas</td>
            <td>Kode Barang</td>
            <td>Jumlah</td>
            <td>Waktu Peminjaman</td>
            <td>Waktu Pengembalian</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($tbpinjam as $tbpinjams)
        <tr>
            @php
                if($tbpinjams->status =="Belum"){
                    $tgl_kembali = '----';
                }else{
                    $tgl_kembali = $tbpinjams->tgl_kembali;
                }
                $kelas = DB::table('tbkelas')->where('id','=',$tbpinjams->kelas)->first();
            @endphp
            <td>{{ $tbpinjams->nama }}</td>
            <td>{{ $tbpinjams->nis_id }}</td>
            <td>{{ $kelas->kelas }}</td>
            <td>{{ $tbpinjams->kodebarang }}</td>
            <td>{{ $tbpinjams->jumlah }}</td>
            <td>{{ $tbpinjams->tgl_pinjam }}</td>
            <td>{{ $tgl_kembali }}</td>
            <td>{{ $tbpinjams->status }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    </div>
    <div class="filter" style="width:170px">
        <h3 style="overflow: hidden">Filter</h3>
        <hr>
        <div class="btn-filter-con">
            <form method="GET" action="{{ url('HistorySearch') }}">
                <h5>Kelas</h5>    
            @foreach ($tbkelas as $model)
            @php
                $checked = [];
                if(isset($_GET['filter'])){
                    $checked = $_GET['filter'];
                }
            @endphp
                <input type="checkbox" name="filter[]" value="{{ $model->id }}"
                @if (in_array($model->id,$checked)) checked @endif
                
                >
                <span>{{ $model->kelas }}</span><br>
                
            @endforeach
            <input type="checkbox" name="filter[]" value="-1" checked hidden>
            <h5 style="margin-top: 10px">Status</h5>    
            @php
                $checked = [];
                if(isset($_GET['filterstat'])){
                    $checked = $_GET['filterstat'];
                }
                if(isset($_GET['dtkembali'])){
                    $dtkembali = $_GET['dtkembali'];
                    $dtkembaliend = $_GET['dtkembaliend'];
                }else{
                    $dtkembali = "";
                    $dtkembaliend = "";
                }
                if(isset($_GET['dtpinjam'])){
                    $dtpinjam = $_GET['dtpinjam'];
                    $dtpinjamend = $_GET['dtpinjamend'];
                }else{
                    $dtpinjam = "";
                    $dtpinjamend = "";
                }
            @endphp
                <input type="checkbox" name="filterstat[]" value="Sudah"
                @if (in_array('Sudah',$checked)) checked @endif
                
                >
                <span>Sudah</span><br>
                <input type="checkbox" name="filterstat[]" value="Belum"
                @if (in_array('Belum',$checked)) checked @endif
                
                >
                <span>Belum</span><br>
            
            <input type="checkbox" name="filterstat[]" value="0" checked hidden>
            <h5 style="margin-top: 10px;font-size:15px">Tanggal Peminjaman</h5>   
            <input type="date" id="dtpinjam" class="dtpinjam" oninput="f_req(this.value)" name="dtpinjam" value="{{ $dtpinjam }}" style="width:145px;">
            <p style="text-align: center;margin-bottom:0">-</p>
            <input type="date" id="dtpinjamend" class="dtpinjamend" name="dtpinjamend" style="width:145px;margin-top :0px" value="{{ $dtpinjamend }}">
            
            <h5 style="margin-top: 10px;font-size:15px">Tanggal Pengembalian</h5>   
            <input type="date" id="dtkembali" class="dtkembali" oninput="f_reqk(this.value)" name="dtkembali" style="width:145px;" value="{{ $dtkembali }}">
            <p style="text-align: center;margin-bottom:0">-</p>
            <input type="date" id="dtkembaliend" class="dtkembaliend" name="dtkembaliend" style="width:145px;margin-top :0px" value="{{ $dtkembaliend }}">
            <button type="submit" class="btn-act-tabel" style="width:145px;margin-top:10px;background-color: #1D87E4">Filter</button>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready( function () {
    $('#mytable').DataTable();
    } );
    function f_req(isi){
        // alert('p');
        if(isi != ""){
            $('#dtpinjamend').attr('required',true);
        }else if(isi == ""){
            $('#dtpinjamend').removeAttr('required');
        }
    }
    function f_reqk(isi){
        // alert('p');
        if(isi != ""){
            $('#dtkembaliend').attr('required',true);
        }else if(isi == ""){
            $('#dtkembaliend').removeAttr('required');
        }
    }
</script>
</body>
@endsection