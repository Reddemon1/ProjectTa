<?php

namespace App\Http\Controllers;

use App\Models\tbbarang;
use App\Models\tblokasi;
use App\Models\tbjenis;
use App\Models\tbkategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TbbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbbarang = tbbarang::all();
        $tbjenis = tbjenis::all();
        $tbkategori = tbkategori::all();
        $tblokasi = tblokasi::all();
        return view('inventaris',compact(
            'tbbarang',
            'tbkategori',
            'tbjenis',
            'tblokasi',
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
    public function store(Request $request)
    {
        $model = new tbbarang;
        $model->id = $request->id;
        $model->namabarang = $request->namabarang;
        $model->jenis = $request->jenis;
        $model->kategori = $request->kategori;
        $model->lokasi = $request->lokasi;
        $model->stock = $request->stock;
        $model->save();
        return redirect('/Inventaris');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbbarang  $tbbarang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $reqkate = $request->filter;
        $reqjenis = $request->filterjenis;
        $reqlokasi = $request->filterlokasi;

        $par = count($reqkate);
        $par2 = count($reqjenis);
        $par3 = count($reqlokasi);
        if($par == 1 && $par2 == 1 && $par3 == 1){ //nol
            $tbbarang = tbbarang::all();
        }else if($par > 1 && $par2 == 1 && $par3 == 1){ //cuma kategori
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)->get();
        }else if($par > 1 && $par2 > 1 && $par3 == 1){ //kategori & jenis
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)->whereIn('jenis',$reqjenis)->get();
        }else if($par > 1 && $par2 == 1 && $par3 > 1){ //kategori & lokasi
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)->whereIn('lokasi',$reqlokasi)->get();
        }else if($par > 1 && $par2 > 1 && $par3 > 1){ //semua filter
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)
                ->whereIn('jenis',$reqjenis)
                ->whereIn('lokasi',$reqlokasi)
                ->get();
        }else if($par == 1 && $par2 > 1 && $par3 == 1){ //cuma jenis
            $tbbarang = tbbarang::whereIn('jenis',$reqjenis)->get();
        }else if($par == 1 && $par2 > 1 && $par3 > 1){ //jenis & lokasi
            $tbbarang = tbbarang::whereIn('lokasi',$reqlokasi)->whereIn('jenis',$reqjenis)->get();
        }else if($par > 1 && $par2 > 1 && $par3 == 1){  //jenis & kategori
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)->whereIn('jenis',$reqjenis)->get();
        }else if($par > 1 && $par2 == 1 && $par3 > 1){  //lokasi & kategori
            $tbbarang = tbbarang::whereIn('kategori',$reqkate)->whereIn('lokasi',$reqlokasi)->get();
        }else if($par == 1 && $par2 == 1 && $par3 > 1){
            $tbbarang = tbbarang::whereIn('lokasi',$reqlokasi)->get();
        }
        // $checked = $_GET['filter'];

        $tbjenis = tbjenis::all();
        $tbkategori = tbkategori::all();
        $tblokasi = tblokasi::all();
        return view('inventaris',compact(
            'tbbarang',
            'tbkategori',
            'tbjenis',
            'tblokasi',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tbbarang  $tbbarang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = tbbarang::find($id);
        $tblokasi = tblokasi::all();
        $tbjenis= tbjenis::all();
        $tbkategori= tbkategori::all();
        return view('/EditBarang',compact(
            'model',
            'tblokasi',
            'tbjenis',
            'tbkategori',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbbarang  $tbbarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = tbbarang::find($id);
        $model->id = $request->id;
        $model->namabarang = $request->namabarang;
        $model->jenis = $request->jenis;
        $model->kategori = $request->kategori;
        $model->lokasi = $request->lokasi;
        $model->stock = $request->stock;
        $model->save();
        return redirect('/Inventaris');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbbarang  $tbbarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabel = tbbarang::find($id);
        $tabel->delete();
        return redirect('/Inventaris');
    }
}
