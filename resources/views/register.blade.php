@extends('layout/layout-common')

@section('space-work')

<h1>Register</h1>

   @if($errors->any())
       @foreach($errors->all() as $error)
       <p style="color:red;">{{ $error}}</p>
       @endforeach
    @endif

    <form action="{{ route('studentRegister')}}"method="POST">
       @csrf
        <input type="text" name="name" placeholder="Enter Name">
        <br><br>
        <input type="email" name="email" placeholder="Enter Email">
        <br><br>
        <input type="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Enter Confirm Password">
        <br><bsr>
        <input type="submit" value="Register">

    </form>

    @if(Session::has('succes'))
     <p style="color:green;">{{ Session::get('succes')}}</p>
    @endif

@endsection