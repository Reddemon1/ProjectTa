<?php

namespace App\Http\Controllers;

use App\Models\tbbarang;
use App\Models\tbpinjam;
use App\Models\temppinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TemppinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = temppinjam::all();
        return $datas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pinjambanyak(Request $request){
        $kode = $request->id;
        $jumlah = $request->jumlah;
        $check3 = tbbarang::where('id','=',$kode)->first();
        $check2 = temppinjam::where('barang_id','=',$kode)->first();
        $stock = $check3->stock;
        if($check3 === null){
            return redirect('/redirect');
        }else{
            if($stock == '0'){
                return redirect('/redirect');
            }
            else{
                if($check2 === null){
                    $model = new temppinjam;
                    $sel = tbbarang::select('namabarang')->where('id', $kode)->get();
                    $namabarang = $sel[0]['namabarang'];
                    $model->namabarang = $namabarang;
                    $model->jumlah = $jumlah;
                    $model->barang_id = $kode;
                    $model->save();
                    return redirect('/');
                }else{
                    $model = temppinjam::where('barang_id','=',$kode)->first();
                    $model->jumlah = $model->jumlah+$jumlah;
                    $model->save();
                    return redirect('/');
                }
            }
        }
    }
    public function store(Request $request)
    {
        $kode = $request->barang_id;
        $check3 = tbbarang::where('id','=',$kode)->first();
        $check2 = temppinjam::where('barang_id','=',$kode)->first();
        $stock = $check3->stock;
        if($check3 === null){
            return redirect('/redirect');
        }else{
            if($stock == '0'){
                return redirect('/redirect');
            }
            else{
                if($check2 === null){
                    $model = new temppinjam;
                    $sel = tbbarang::select('namabarang')->where('id', $kode)->get();
                    $namabarang = $sel[0]['namabarang'];
                    $model->namabarang = $namabarang;
                    $model->jumlah = 1;
                    $model->barang_id = $kode;
                    $model->save();
                    return redirect('/');
                }else{
                    $model = temppinjam::where('barang_id','=',$kode)->first();
                    $model->jumlah = $model->jumlah+1;
                    $model->save();
                    return redirect('/');
                }
            }
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\temppinjam  $temppinjam
     * @return \Illuminate\Http\Response
     */
    public function show(temppinjam $temppinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\temppinjam  $temppinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(temppinjam $temppinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\temppinjam  $temppinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, temppinjam $temppinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\temppinjam  $temppinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = temppinjam::find($id);
        $model->delete();
        return redirect('/');        
    }
}
