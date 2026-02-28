@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Akun Saya</h2>
    @if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card p-4">
        <form action ="{{route('akun.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-3">
                @if (Auth::user()->foto)
                <img src="{{asset('foto_profil/'.Auth::user()->foto)}}" width="120" class="rounded-circle">
                @else
                <img src="https://via.placeholder.com/120" class="rounded-circle">
                @endif
            </div>
            <div class="mb-3">
                <label>Foto Profil</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
            </div>
            <button type="submit" class="btn btn-primary">Update Profil</button>
            <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </form>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>
</div>
@endsection