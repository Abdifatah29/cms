@extends('layouts.app')
@section('title', 'Contact')
@section('content')

<form>
    <input type="text" name="contact" value="contact"/>
</form>

@foreach($people AS $person)
    <p>This is user {{ $person }}</p>
@endforeach

@endsection()

@section('footer')
    <p>This is my footer</p>
@endsection()