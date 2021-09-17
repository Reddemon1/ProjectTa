@extends('layout.main')
@section('content')
<div class="index-confirm">
<div class="row">
    <div class="col-md-8 col_confirm">

        <h2 style="margin-top: 50px;margin-bottom: 20px">Barang Anda</h2>
        @foreach ($temppinjam as $temppinjams)
        @php
            $lok = DB::table('tbbarangs')->where('id','=',$temppinjams->barang_id)->first();
            $lokasis = DB::table('tblokasis')->where('id','=',$lok->lokasi)->first();
        @endphp
            <div class="item_confirm">
                <p id="item-name" class="item-name-confirm">{{ $temppinjams -> namabarang }} ({{ $temppinjams->jumlah }})</p>
                <div class="d-flex">
                    <p id="item-code" class="item-code-confirm">Code : <span style="color: #1D87E4">{{ $temppinjams -> barang_id }}</span></p> 
                    <p id="item-code" class="item-code-confirm" style="margin-left: 20px">Lokasi : <span style="color: #1D87E4">{{ $lokasis->lokasi }}</span></p>    
                </div>  
            </div>
        @endforeach
        
    </div>    
    <div class="col-md-4">
        <div class="act">
            <h5 style="text-align: center;font-size:18px;font-weight:bold">Konfirmasi Peminjaman<br>Anda</h5>
            <div class="btn-act-con">
                <button class="btn-act-c" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="bukamodal()" style="background-color:#1D87E4">Konfirmasi</button>
                <button class="btn-act-c mt-1" onclick="location.href = '/'"style="background-color: #C31814;    margin-right: 10px;">Batal</button>
                <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                        <h3 class="modal-title" style="text-align: center;margin-left:20px; color:#C31814;font-weight:bold;margin-rabottom:30px;margin-top: 10px" id="exampleModalLabel">Verifikasi Data</h3>
                        <input style="margin-left: 35px;margin-top:20px;" onclick="f_hidden(this.value)" type="radio" name="select" id="" value="manual"><span style="margin-left: 5px">Manual Login</span>
                        <input style="margin-left: 35px" type="radio" name="select" onclick="f_hidden(this.value)" id="" value="auto" checked><span style="margin-left: 5px">Auto Login</span>
                        <form id="auto" method="POST" action="{{ route('autologin') }}">
                            @csrf
                            <h3 style="margin-left:30px;font-weight:bold;margin-top:30px;margin-bottom:30px;overflow:hidden">Pindai QR code Anda</h3>
                            <input type="password" hidden class="input_verify" id="kodeuser" name="kodeuser" placeholder="Kode User"  style="margin-bottom:30px;">
                            <input type="submit" id="verify-auto" class="btn" hidden style="background: #1D87E4;color:white;width:400px;margin-left:32px;font-size:20px;margin-bottom:" value="Verify">
                            
                        <video style="margin-left: 30px"  id="preview" width="400" height="300" ></video>
                        </form>
                        <form id="manual" method="POST" action="{{ url('tbpinjams') }}" hidden>       
                            @csrf 
                            <input style="margin-top:10px" type="text"  class="input_verify" name="email" placeholder="Email">
                            <input type="password" class="input_verify" name="password" placeholder="Password" style="margin-top: 20px;margin-bottom:30px;">
                            <input type="submit" class="btn" style="background: #1D87E4;color:white;width:400px;margin-left:32px;font-size:20px;margin-bottom:20px" value="Verify">
                        </form>

                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>    
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function bukamodal(){
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        scanner.addListener('scan',function(content){
            document.getElementById('kodeuser').value = content;
            document.getElementById('verify-auto').click();
        });
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length>0){
                scanner.start(cameras[0]);

            }else{
                console.error('camera not found');
            }
        }).catch(function(e){
            console.error(e);
        })
    }

    function f_hidden(radio){
        if(radio=="manual"){
            document.getElementById('manual').hidden = false;
            document.getElementById('auto').hidden = true;
            
        }else{
            document.getElementById('auto').hidden = false;
            document.getElementById('manual').hidden = true;
        }
    }
</script>
</body>
@endsection