<?php

namespace App\Http\Controllers;

use App\Models\tbbarang;
use App\Models\tbkelas;
use App\Models\tbpinjam;
use App\Models\tbstatus;
use App\Models\tbuser;
use App\Models\tempkembali;
use App\Models\temppinjam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TbpinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbpinjam = tbpinjam::orderBy('status','desc')->get();
        $status = tbpinjam::select('status')->distinct()->get();
        $tbkelas = tbkelas::where('id','!=','0')->get();
        $tbstatus = tbstatus::all();
        return view('history',compact(
            'tbpinjam',
            'tbkelas',
            'tbstatus',
            'status',
        ));
    }
    public function filter(Request $request){
        $reqkelas = $request->filter;
        $reqstat = $request->filterstat;

        $dtkembali = $request->dtkembali;
        $dtkembaliend = $request->dtkembaliend;

        $dtpinjam = $request->dtpinjam;
        $dtpinjamend = $request->dtpinjamend;

        $par = count($reqkelas);
        $par2 = count($reqstat);
        if($par == 1 && $par2 == 1 && $dtkembali === null && $dtpinjam === null){ //nol
            $tbpinjam = tbpinjam::orderBy('status','desc')->get();
        }else if($par > 1 && $par2 == 1 && $dtkembali === null && $dtpinjam === null){ // kelas
            $tbpinjam = tbpinjam::whereIn('kelas',$reqkelas)->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 > 1 && $dtkembali === null && $dtpinjam === null){ // wstatus
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 == 1 && $dtkembali != null && $dtpinjam === null){ // dtkembali
            $tbpinjam = tbpinjam::where('tgl_kembali','<=',$dtkembaliend)->where('tgl_kembali','>=',$dtkembali)
                        ->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 == 1 && $dtkembali === null && $dtpinjam != null){ // dtpinjam
            $tbpinjam = tbpinjam::where('tgl_pinjam','<=',$dtpinjamend)->where('tgl_pinjam','>=',$dtpinjam)
                        ->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 > 1 && $dtkembali === null && $dtpinjam === null){ //status kelas
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)->whereIn('kelas',$reqkelas)->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 > 1 && $dtkembali != null && $dtpinjam === null){ //status kelas dtkembali
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)
                        ->whereIn('kelas',$reqkelas)
                        ->where('tgl_kembali','<=',$dtkembaliend)->where('tgl_kembali','>=',$dtkembali)
                        ->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 == 1 && $dtkembali != null && $dtpinjam === null){ // kelas dtkembali
            $tbpinjam = tbpinjam::whereIn('kelas',$reqkelas)
                        ->where('tgl_kembali','<=',$dtkembaliend)->where('tgl_kembali','>=',$dtkembali)
                        ->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 > 1 && $dtkembali != null && $dtpinjam === null){ //status dtkembali
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)
                        ->where('tgl_kembali','<=',$dtkembaliend)->where('tgl_kembali','>=',$dtkembali)
                        ->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 == 1 && $dtkembali === null && $dtpinjam != null){ // kelas dtpinjam
            $tbpinjam = tbpinjam::whereIn('kelas',$reqkelas)
                        ->where('tgl_pinjam','<=',$dtpinjamend)->where('tgl_pinjam','>=',$dtpinjam)
                        ->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 > 1 && $dtkembali === null && $dtpinjam != null){ //status dtpinjam
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)
                        ->where('tgl_pinjam','<=',$dtpinjamend)->where('tgl_pinjam','>=',$dtpinjam)
                        ->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 > 1 && $dtkembali === null && $dtpinjam != null){ //status kelas dtpinjam
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)
                        ->whereIn('kelas',$reqkelas)
                        ->where('tgl_pinjam','<=',$dtpinjamend)->where('tgl_pinjam','>=',$dtpinjam)
                        ->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 > 1 && $dtkembali != null && $dtpinjam != null){ //all
            $tbpinjam = tbpinjam::whereIn('status',$reqstat)
                        ->whereIn('kelas',$reqkelas)
                        ->where('tgl_pinjam','<=',$dtpinjamend)->where('tgl_pinjam','>=',$dtpinjam)
                        ->where('tgl_kembali','<=',$dtkembaliend)->where('tgl_kembali','>=',$dtkembali)
                        ->orderBy('nama','asc')->get();
        }
        $tbkelas = tbkelas::where('id','!=','0')->get();
        $tbstatus = tbstatus::all();
        return view('history',compact(
            'tbpinjam',
            'tbkelas',
            'tbstatus',
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autologin(Request $request)
    {
        $id = $request->kodeuser;
        // echo $id;return;
        $check = tbuser::find($id);
        if($check === null){
            return redirect('/redirect/autologin');
        }else{
            return $this->f_store($check);
        }
        
    }    
    public function autologinkembali(Request $request)
    {
        $id = $request->kodeuser;
        // echo $id;return;
        $check = tbuser::find($id);
        $check2 = tbpinjam::where('nis_id','=',$id)->where('status','=','Belum')->first();

        if($check === null){
            return redirect('/redirect/autologin');
        }else{
            if($check2 === null){
                return redirect('/redirectkembali');
            }else{
                return $this->f_kembali($id);
            }
        }
        
    }
    public function pinjambanyak(Request $request){
        
    }
    public function loginkembali(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // echo $id;return;
        $check = tbuser::where('email','=',$email)->where('password','=',$password)->first();


        if($check === null){
            return redirect('/redirect/autologin');
        }else{
            $id = $check->id;
            $check2 = tbpinjam::where('nis_id','=',$id)->where('status','=','Belum')->first();
            if($check2 === null){
                return redirect('/redirectkembali');
            }else{
                return $this->f_kembali($id);
            }
        }
        
    }
    public function f_kembali($id){
        $tbpinjam = tbpinjam::where('nis_id','=',$id)->where('status','=','Belum')->get();
        foreach($tbpinjam as $tbpinjams){
            $tempkembali = new tempkembali;
            $tbbarang = tbbarang::where('id','=',$tbpinjams->kodebarang)->first();
            // $tbbarang->save();
            $tempkembali->barang_id = $tbpinjams->kodebarang;
            $tempkembali->jumlah = $tbpinjams->jumlah;
            // echo $tbbarang->namabarang;
            $tempkembali->namabarang = $tbbarang->namabarang;
            $tempkembali->save();

        }
        // temppinjam::truncate();
        return redirect('/confirmkembali');
    }
    public function store(Request $request)
    {
        $email = $request->email;
        $pass = $request->password;
        $check = tbuser::where('email','=',$email)->where('password','=',$pass)->first();
        if($check === null){
            return redirect('/redirect/login');
        }else{
            return $this->f_store($check);
        }
        
    }
    public function f_store($check){
        
        foreach(temppinjam::all() as $temppinjam){
            $tbpinjam = new tbpinjam;
            $tbbarang = tbbarang::find($temppinjam->barang_id);
            $tbpinjam->lokasi = $tbbarang->lokasi;
            $tbbarang->stock = $tbbarang->stock-1;
            $tbbarang->save();
            $count = tbpinjam::count();
            $tbpinjam->id = $count+1;
            $tbpinjam->nama = $check->nama;
            $tbpinjam->kelas = $check->kelas;
            $tbpinjam->jumlah = $temppinjam->jumlah;
            $tbkelas = tbkelas::find($check->kelas);
            $kls = substr($tbkelas->kelas, 0, 2);
            $tbpinjam->kelompok = $kls;
            $tbpinjam->kodebarang = $temppinjam->barang_id;
            $tbpinjam->nis_id = $check->id;
            $tbpinjam->tgl_pinjam = Carbon::now();
            $tbpinjam->tgl_kembali = '0001-01-01 00:00:01';
            $tbpinjam->status = "Belum";
            $tbpinjam->save();

        }
        temppinjam::truncate();
        return redirect('/BerhasilPinjam');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbpinjam  $tbpinjam
     * @return \Illuminate\Http\Response
     */
    public function show(tbpinjam $tbpinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tbpinjam  $tbpinjam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tempkembali = tempkembali::all();
        return view('/confirmkembali',compact(
            "tempkembali",
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbpinjam  $tbpinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        foreach(tempkembali::all() as $temppinjam){
            $tbpinjam = tbpinjam::where('kodebarang','=',$temppinjam->barang_id)->where('status','=','Belum')->first();
            $tbbarang = tbbarang::find($temppinjam->barang_id);
            $tbbarang->stock = $tbbarang->stock + $tbpinjam->jumlah;
            $tbbarang->save();
            $tbpinjam->tgl_kembali = Carbon::now();
            $tbpinjam->status = "Sudah";
            $tbpinjam->save();
        }
        tempkembali::truncate();
        return redirect('/BerhasilKembali');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbpinjam  $tbpinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy(tbpinjam $tbpinjam)
    {
        //
    }
}
