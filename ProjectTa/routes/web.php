<?php

use App\Http\Controllers\TbadminController;
use App\Http\Controllers\TbbarangController;
use App\Http\Controllers\TbpinjamController;
use App\Http\Controllers\TbuserController;
use App\Http\Controllers\TempkembaliController;
use App\Http\Controllers\TemppinjamController;
use App\Http\Controllers\UserController;
use App\Models\tbadmin;
use App\Models\tbbarang;
use App\Models\tbjenis;
use App\Models\tbkategori;
use App\Models\tbkelas;
use App\Models\tblokasi;
use App\Models\tbpinjam;
use App\Models\tbstatus;
use App\Models\tempkembali;
use App\Models\temppinjam;
use App\Models\User;
use Database\Factories\TbuserFactory;
use GuzzleHttp\Promise\Create;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    tempkembali::truncate();
    return view('index',[
        "temppinjam" => temppinjam::all(),
    ]);
});
Route::get('/PinjamBanyak', function () {
    // tempkembali::truncate();
    return view('pinjambanyak',[
        "tbbarang" => tbbarang::all(),
    ]);
});
Route::get('confirm', function(){
    return view('confirm',[
        "temppinjam" => temppinjam::all(),
    ]);
});
Route::get('confirmkembali', function(){
    return view('confirmkembali',[
        "tempkembali" => tempkembali::all(),
    ]);
});
Route::get('/redirect', function () {
    return view('redirect');
});
Route::get('/redirectkembali', function () {
    return view('redirectkembali');
});
Route::get('/AdminRedirect', function () {
    return view('redirectloginadmin');
});
Route::get('/redirect/login', function () {
    return view('redirectlogin');
});
Route::get('/redirect/autologin', function () {
    return view('redirectautologin');
});
Route::get('/BerhasilPinjam', function () {
    return view('berhasilpinjam');
});
Route::get('/BerhasilKembali', function () {
    return view('berhasilkembali');
});
Route::resource('temppinjam',TemppinjamController::class);
Route::resource('tempkembali',TempkembaliController::class);
Route::resource('tbpinjams',TbpinjamController::class);
Route::post('pinjambanyak',[TemppinjamController::class,'pinjambanyak']);
Route::post('tbpinjam',[TbpinjamController::class,'autologin'])->name('autologin');
Route::post('tbkembali',[TbpinjamController::class,'autologinkembali'])->name('autologinkembali');
Route::post('tbkembalim',[TbpinjamController::class,'loginkembali'])->name('loginkembali');
Route::get('/desall', function () {
    temppinjam::truncate();
    return redirect('/');
});
Route::get('/batalkembali', function () {
    tempkembali::truncate();
    return redirect('/');
});
Route::get('/kembalisalah', function () {
    return view('redirectloginsalah');
});
Route::get('/loginsalahkembali', function () {
    return view('redirectloginkembali');
});
Route::group(['middleware'=>['auth']],function(){
    Route::get('/HomeAdmin', function () {
        return view('homeadmin',[
            "tbpinjam" => tbpinjam::where('status','=','Belum')->get(),
            "tbbarang" => tbbarang::all(),
        ]);
    });
});

Route::group(['middleware'=>['auth']],function(){
    Route::get('/Inventaris',[TbbarangController::class,'index']);
    Route::get('/InventarisSearch',[TbbarangController::class,'show']);
    Route::get('/User',[TbuserController::class,'index']);
    Route::get('/UserSearch',[TbuserController::class,'show']);
    Route::get('/History', [TbpinjamController::class,'index']);
    Route::get('/HistorySearch', [TbpinjamController::class,'filter']);
});
Route::post('/postlogin',[UserController::class,'login'])->name('postlogin');
Route::get('/postlogout',[UserController::class,'logout'])->name('postlogout');
Route::get('/TambahBarang', function () {
    return view('tambahbarang',[
        'tblokasi'=> tblokasi::all(),
        'tbjenis'=> tbjenis::all(),
        'tbkategori'=> tbkategori::all(),
    ]);
});
Route::get('/TambahSiswa', function () {
    return view('tambahsiswa',[
        'tbstatus'=> tbstatus::all(),
        'tbkelas'=> tbkelas::all(),
    ]);
});
Route::get('/Admin', function () {
    return view('adminlogin');
})->name('login');
Route::resource('tbbarang',TbbarangController::class);
Route::resource('tbuser',TbuserController::class);
Route::resource('tbadmin',TbadminController::class);