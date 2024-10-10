@extends('client.layout.index')
@section('title')
    Admin Demo
@endsection
@section('main')
<h1>Trang Admin</h1>
@auth
Xin chào {{Auth()->user()->name}}
<form action="{{route('dangxuat')}}" method='post'>
@csrf
<button>Logout</button>
</form>
@else
<a href="/dang-nhap">Đăng Nhập</a>
@endauth
@endsection
