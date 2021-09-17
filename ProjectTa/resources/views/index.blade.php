@extends('layout/main')
@section('content')
<div class="index">
  
  <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Barang Anda</h5>
            <div class="con-add float-end">
                <form  method="POST" action="{{ url('temppinjam') }}">
                    @csrf
                    <input type="text" class="barang_id" id="barang_id" name="barang_id" placeholder="Masukkan Kode Barang">
                    <button class="btn-add" type="submit" id="btn-add">Add</button>
                </form>
                </div>
            </div>
            <div class="modal-body modal-item">
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($temppinjam as $temppinjams)
                        <div class="item">
                            <div class="row">
                                @php
                                    $lok = DB::table('tbbarangs')->where('id','=',$temppinjams->barang_id)->first();
                                    $lokasis = DB::table('tblokasis')->where('id','=',$lok->lokasi)->first();
                                @endphp
                                <div class="col-md-11">
                                        <p id="item-name" class="item-name">{{ $temppinjams -> namabarang }} ({{ $temppinjams->jumlah }})</p>
                                        <div class="d-flex" style="margin-top: 10px">
                                            <p id="item-code" class="item-code">Code : <span style="color: #1D87E4">{{ $temppinjams -> barang_id }}</span></p>
                                            <p id="item-code" class="item-code" style="margin-left: 20px">Lokasi : <span style="color: #1D87E4">{{ $lokasis->lokasi }}</span></p>    
                                            
                                        </div>
                                </div>
                                <div class="col-md-1 ">
                                    <form action="{{ url('temppinjam/'.$temppinjams->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    
                                    <button type="submit" class="item-delete" name="item_delete"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#C31814" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                      </svg></button>
                                    </form>  
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-4 preview">
                        @php
                            $count = DB::table('temppinjams')->sum('jumlah');
                        @endphp
                        <h4 style="font-weight: 600;margin-left:8px">Total Item:</h4>
                        <h2 class="total-item" id="total_item">{{ $count }}</h2>
                        <div class="con-btn">
                            <input type="button" onclick="window.location.href='/desall'" class="btn-act" style="background-color: #C31814" value="Batalkan Peminjaman">

                            <button class="btn-act btn-con" id="btn-act"  onclick="f_confirm()">Konfirmasi Peminjaman</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer float-start">
                <video style="margin-right: 500px"  id="previewpinjam" width="100" height="50"></video>
                <a href="/PinjamBanyak">Pinjam Banyak</a>
                <button class="btn-close" data-bs-dismiss="modal" onclick="f_tutup()"></button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="modal-verif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="margin-left: -30px">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <h3 class="modal-title" style="text-align: center;margin-left:50px; color:#C31814;font-weight:bold;margin-rabottom:30px;margin-top: 10px" id="exampleModalLabel">Verifikasi Data</h3>
                <input style="margin-left: 20px;margin-top:20px;" onclick="f_hidden(this.value)" type="radio" name="select" id="" value="manual"><span style="margin-left: 5px">Manual Login</span>
                <input style="margin-left: 35px" type="radio" name="select" onclick="f_hidden(this.value)" id="" value="auto" checked><span style="margin-left: 5px">Auto Login</span>
                <form id="auto" method="POST" action="{{ route('autologinkembali') }}">
                    @csrf
                    <h3 style="margin-left:20px;font-weight:bold;margin-top:30px;margin-bottom:30px;overflow:hidden">Pindai QR code Anda</h3>
                    <input type="password" hidden class="input_verify" id="kodeuser" name="kodeuser" placeholder="Kode User"  style="margin-bottom:30px;">
                    <input type="submit" id="verify-auto" class="btn" hidden style="background: #1D87E4;color:white;width:400px;font-size:20px;" value="Verify">
                    
                <video style="margin-left: 30px"  id="preview" width="400" height="300"></video>
                </form>
                <form id="manual" method="POST" action="{{ route('loginkembali') }}" hidden>       
                    @csrf 
                    <input style="margin-top:10px" type="text"  class="input_verify" name="email" placeholder="Email">
                    <input type="password" class="input_verify" name="password" placeholder="Password" style="margin-top: 20px;margin-bottom:30px;">
                    <input type="submit" class="btn" style="background: #1D87E4;color:white;width:400px;margin-left:32px;font-size:20px;margin-bottom:20px" value="Verify">
                </form>

            </div>
        </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="modalkembali" data-bs-backdrop="static" role="dialog" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Kembalikan Barang</h5>
            <div class="con-add float-end">

                </div>
            </div>
            <div class="modal-body modal-item">
                <form  method="POST" action="{{ url('tempkembali') }}">
                    @csrf
                    <input type="text" class="barang_idk" id="barang_id" name="barang_id" placeholder="Masukkan Kode Barang">
                    <button class="btn-addk" type="submit" id="btn-add">Add</button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn-close" data-bs-dismiss="modal" onclick="f_tutup()"></button>
            </div>
        </div>
        </div>
    </div> --}}
    <a href="" class="title-index text text-center" data-bs-toggle="modal" onclick="bukamodalpinjam()" data-bs-target="#staticBackdrop">Pinjam</a>
    <p style="font-weight:bold; margin-top: 0px;margin-bottom:20px;">ATAU</p>
    <a type="button" class="add-manual link-light"  data-bs-toggle="modal" onclick="bukamodal()" data-bs-target="#modal-verif" >Kembalikan Barang</a>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div id="fade" ></div>
<script>

    var item = document.getElementById('total_item').innerHTML;
    if(item>0){
    var myModal = document.getElementById('staticBackdrop');
    var fade = document.getElementById('fade');
    bukamodalpinjam();
    var classbody = document.body;
    myModal.classList.add("show");
    fade.classList.add("modal-backdrop");
    fade.classList.add("fade");
    fade.classList.add("show");
    $('#staticBackdrop').css('display','block');
    $('#staticBackdrop').css('role','dialog');
    myModal.removeAttribute('aria-hidden');
    classbody.classList.add("modal-open");
    classbody.style.overflow = 'hidden';
    classbody.style.paddingRight = '0px';
    // classbody.css('overflow','hidden');
    // classbody.css('padding-right','0px');
  }
  function f_tutup(){
    var myModal = document.getElementById('staticBackdrop');
    var fade = document.getElementById('fade');
    var classbody = document.body;
    myModal.removeAttribute('role');
    $('#staticBackdrop').css('display','none');
    myModal.classList.remove("show");
    fade.classList.remove("modal-backdrop");
    fade.classList.remove("fade");
    classbody.classList.add("remove");
    fade.classList.remove("show");
  }
  function f_confirm(){
    var item = document.getElementById('total_item').innerHTML;
    if(item == 0){
        alert("Pilih Barang Sebelum Konfirmasi");
        return;
    }    
    location.href = "/confirm"
  }
  function f_confirmk(){
    var item = document.getElementById('total_itemk').innerHTML;
    if(item == 0){
        alert("Pilih Barang Sebelum Konfirmasi");
        return;
    }    
    location.href="{{ url('tbpinjam/1/edit') }}"
  }
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
            let s = scanner
        }
    
    function bukamodalpinjam(){
        let scanner = new Instascan.Scanner({video: document.getElementById('previewpinjam')});
        scanner.addListener('scan',function(content){
            document.getElementById('barang_id').value = content;
            document.getElementById('btn-add').click();
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