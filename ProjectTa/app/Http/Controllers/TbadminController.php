<?php

namespace App\Http\Controllers;

use App\Models\tbadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TbadminController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tbadmin  $tbadmin
     * @return \Illuminate\Http\Response
     */
    public function show(tbadmin $tbadmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tbadmin  $tbadmin
     * @return \Illuminate\Http\Response
     */
    public function edit(tbadmin $tbadmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbadmin  $tbadmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tbadmin $tbadmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbadmin  $tbadmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(tbadmin $tbadmin)
    {
        //
    }
}
