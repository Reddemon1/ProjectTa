@extends('layout.main')
@section('content')
<link rel="stylesheet" href="../../css/main.css">
<div class="index-confirm">
<div class="row">
    <div class="col-md-8 col_confirm">

        <h2 style="margin-top: 50px;margin-bottom: 20px">Barang Anda</h2>
        @foreach ($tempkembali as $tempkembalis)
        @php
            $lok = DB::table('tbbarangs')->where('id','=',$tempkembalis->barang_id)->first();
            $lokasis = DB::table('tblokasis')->where('id','=',$lok->lokasi)->first();
        @endphp
            <div class="item_confirm d-flex">
                <div>
                    <div class="d-flex">
                    <p id="item-name" class="item-name-confirm">{{ $tempkembalis -> namabarang }} ({{ $tempkembalis->jumlah }})</p>
                    <form action="{{ url('tempkembali/'.$tempkembalis->id) }}" style="width:fit-content;" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    
                    <button type="submit" class="item-delete" style="margin-left:5px;" name="item_delete"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#C31814" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg></button>
                    </form>
                </div> 
                    <div class="d-flex">
                    <p id="item-code" class="item-code-confirm">Code : <span style="color: #1D87E4">{{ $tempkembalis -> barang_id }}</span></p> 
                    <p id="item-code" class="item-code-confirm" style="margin-left: 20px">Lokasi : <span style="color: #1D87E4">{{ $lokasis->lokasi }}</span></p>    
                </div>    
                </div>
            </div>
 
        @endforeach
        
    </div>    
    <div class="col-md-4">
        <div class="act">
            <h5 style="text-align: center;font-size:18px;font-weight:bold">Konfirmasi<br>Pengembalian<br>Anda</h5>
            <div class="btn-act-con ">
                <form action="{{ url('tbpinjams/1') }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="" value="PATCH">
                    <button class="btn-act-c" style="background-color:#1D87E4">Konfirmasi</button>
                </form>
                <button class="btn-act-c mt-1" onclick="location.href = '/batalkembali'"style="background-color: #C31814;    margin-right: 10px;">Batal</button>
                <!-- Modal -->
            {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        @php
                            $ids = '1';
                        @endphp
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h3 class="modal-title" style="text-align: center; color:#C31814;font-weight:bold;margin-bottom:30px;margin-top: 10px" id="exampleModalLabel">Verification Data</h3>
                        @foreach ($tempkembali as $tempkembalis)
                        <form action="{{ url('tbpinjam/'.$tempkembalis->barang_id) }}" method="POST" >       
                            @csrf 
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="text"  class="input_verify" name="email" placeholder="Email">
                            <input type="password" class="input_verify" name="password" placeholder="Password" style="margin-top: 20px;margin-bottom:30px;">
                            <input type="submit" class="btn" style="background: #1D87E4;color:white;width:400px;margin-left:32px;font-size:20px;margin-bottom:20px" value="Verify">
                        </form>
                        @endforeach
                        
                    </div>
                </div>
                </div>
            </div> --}}
            </div>
        </div>
    </div>
</div>    
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
@endsection