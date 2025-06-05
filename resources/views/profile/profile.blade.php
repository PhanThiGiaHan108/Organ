
@extends('FrontEnd.master')

@section('content')
<div class="container">
    <h2>Thông tin cá nhân</h2>
    <p>Tên: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    
</div>
@endsection
