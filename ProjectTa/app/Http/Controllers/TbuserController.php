<?php

namespace App\Http\Controllers;

use App\Models\tbkelas;
use App\Models\tbstatus;
use App\Models\tbuser;
use Illuminate\Http\Request;

class TbuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbuser = tbuser::orderBy('nama','asc')->get();
        $tbkelas = tbkelas::where('id','!=','0')->get();
        $tbstatus = tbstatus::all();
        return view('siswa',compact(
            'tbuser',
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
    public function store(Request $request)
    {
        $model = new tbuser;
        $model->id = $request->id;
        $model->nama = $request->nama;
        $model->email = $request->email;
        $model->password = $request->password;
        $model->status = $request->status;
        $model->kelas = $request->kelas;
        $model->save();
        return redirect('/User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbuser  $tbuser
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $reqkelas = $request->filter;
        $reqstat = $request->filterstat;
        
        $par = count($reqkelas);
        $par2 = count($reqstat);
        echo $par;
        echo $par2;
        if($par == 1 && $par2 == 1){ //nol
            $tbuser = tbuser::orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 == 1){
            $tbuser = tbuser::whereIn('kelas',$reqkelas)->orderBy('nama','asc')->get();
        }else if($par == 1 && $par2 > 1){
            $tbuser = tbuser::whereIn('status',$reqstat)->orderBy('nama','asc')->get();
        }else if($par > 1 && $par2 > 1){
            $tbuser = tbuser::whereIn('status',$reqstat)->whereIn('kelas',$reqkelas)->orderBy('nama','asc')->get();
        }
        // $tbuser = tbuser::orderBy('nama','asc')->get();
        $tbkelas = tbkelas::where('id','!=','0')->get();
        $tbstatus = tbstatus::all();
        return view('siswa',compact(
            'tbuser',
            'tbkelas',
            'tbstatus',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tbuser  $tbuser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = tbuser::find($id);
        $tbstatus = tbstatus::all();
        $tbkelas = tbkelas::all();
        return view('/EditSiswa',compact(
            'model',
            'tbstatus',
            'tbkelas',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbuser  $tbuser
     * @return \Illuminate\Http\Response
     */
    public function filterkelas($id)
    {
        $tbuser = tbuser::where('kelas','=',$id)->get();
        return view('siswafilter',compact(
            'tbuser',
        ));
    }
    public function update(Request $request, $id)
    {
        $model = tbuser::find($id);
        $model->id = $request->id;
        $model->nama = $request->nama;
        $model->email = $request->email;
        $model->password = $request->password;
        $model->status = $request->status;
        $model->kelas = $request->kelas;
        $model->save();
        return redirect('/User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbuser  $tbuser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabel = tbuser::find($id);
        $tabel->delete();
        return redirect('/User');
    }
}
