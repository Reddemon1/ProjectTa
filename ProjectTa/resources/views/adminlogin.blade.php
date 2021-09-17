@extends('layout.main')
@section('content')
        <div class="cont-admin">
            <h1 style="color:#C31814;font-weight:bold;text-align:center;margin-top:20%;margin-bottom:30px">Login Admin</h1>
            <hr width="55%" style="margin-left: 24%;height:3px ">
            <div class="form-admin" style="margin-left: 20%">
            <form method="POST" action="{{ route('postlogin') }}">       
                @csrf 
                <input type="text"  class="input_verify" name="email" placeholder="Email">
                <input type="password" class="input_verify" name="password" placeholder="Password" style="margin-top: 20px;margin-bottom:30px;">
                <input type="submit" class="btn" style="background: #1D87E4;color:white;width:400px;margin-left:32px;font-size:20px;margin-bottom:20px" value="Verify">
            </form>
            </div>
        </div>
</div>
</div>
</body>
@endsection