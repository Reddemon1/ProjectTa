<?php

namespace App\Http\Controllers;

use App\Models\tbbarang;
use App\Models\tbpinjam;
use App\Models\tempkembali;
use Illuminate\Http\Request;

class TempkembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $kode = $request->barang_id;
        $check = tbpinjam::where('kodebarang','=',$kode)->where('status','Belum')->first();
        $check2 = tempkembali::where('barang_id','=',$kode)->first();
        $check3 = tbbarang::where('id','=',$kode)->first();
        if($check3 === null){
            return redirect('/redirect');
        }else{
            if($check === null && $check2===null){
                return redirect('/redirectkembali');
            }
            else{
                $model = new tempkembali();
                
                $sel = tbbarang::select('namabarang')->where('id', $kode)->get();
                $namabarang = $sel[0]['namabarang'];
                $model->namabarang = $namabarang;
                $model->barang_id = $kode;
                $model->save();
                return redirect('/confirmkembali');
                
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tempkembali  $tempkembali
     * @return \Illuminate\Http\Response
     */
    public function show(tempkembali $tempkembali)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tempkembali  $tempkembali
     * @return \Illuminate\Http\Response
     */
    public function edit(tempkembali $tempkembali)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tempkembali  $tempkembali
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tempkembali $tempkembali)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tempkembali  $tempkembali
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = tempkembali::find($id);
        $model->delete();
        return redirect('/confirmkembali');  
    }
}
