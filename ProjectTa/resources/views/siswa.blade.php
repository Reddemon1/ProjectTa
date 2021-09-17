@extends('layout.sidebar');
@section('content')
    

                <div class="d-flex">
                    <h1 style="font-weight: bold; color:#FFC600">User</h1>  
                    <button class="btn-tambah mx-lg-3 mb-lg-2" onclick="location.href='/TambahSiswa'">Tambah</button>
                </div>
                <div class="d-flex">
                    <div class="tabel-show" style="margin-top: 20px;height: fit-content">
                
                <table id="table_id" class=" display table table-striped" style="width:930px;margin-top:50px;font-size:13px ">
                    <thead>
                    <tr bgcolor="#1D87E4" style="color: white;font-size:15px">
                        <td>No</td>
                        <td>Kode User</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Password</td>
                        <td>Status</td>
                        <td>Kelas</td>
                        <td>Action</td>
                    </tr>
                </thead>
                    @php
                        $x = 1;
                    @endphp
                    <tbody>
                    @foreach ($tbuser as $tbusers)
                    <tr>
                        @php
                            $kelas = DB::table('tbkelas')->where('id','=',$tbusers->kelas)->first();
                            $status = DB::table('tbstatuses')->where('id','=',$tbusers->status)->first();
                        @endphp
                        <td>{{ $x++ }}</td>
                        <td>{{ $tbusers->id }}</td>
                        <td>{{ $tbusers->nama }}</td>
                        <td>{{ $tbusers->email }}</td>
                        <td>{{ $tbusers->password }}</td>
                        <td>{{ $status->status }}</td>
                        <td>{{ $kelas->kelas }}</td>
                        <td class="d-flex">
                            <form action="{{ url('tbuser/'.$tbusers->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn-act-tabel" type="submit" style="background: #C31814">Delete</button>
                            </form>
                            <button onclick="location.href='{{ url('tbuser/'.$tbusers->id.'/edit') }}'" style="margin-left: 10px;background-color:#FFC600" class="btn-act-tabel">Edit</button>
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
                            <form method="GET" action="{{ url('UserSearch') }}">
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
                            <input type="checkbox" name="filter[]" value="-" checked hidden>
                            <h5 style="margin-top: 10px">Status</h5>    
                            @foreach ($tbstatus as $model)
                            @php
                                $checked = [];
                                if(isset($_GET['filterstat'])){
                                    $checked = $_GET['filterstat'];
                                }
                            @endphp
                                <input type="checkbox" name="filterstat[]" value="{{ $model->id }}"
                                @if (in_array($model->id,$checked)) checked @endif
                                
                                >
                                <span>{{ $model->status }}</span><br>
                                
                            @endforeach
                            <input type="checkbox" name="filterstat[]" value="0" checked hidden>
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