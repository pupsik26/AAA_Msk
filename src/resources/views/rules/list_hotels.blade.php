@extends('rules.index')
@section('content')
    @if(request()->session()->get('success'))
        <h2>Правила</h2>
        @foreach(request()->session()->get('success') as $item)
            <li>{{$item}}</li>
        @endforeach
        <br>
        <hr>
    @endif

    @foreach($hotels as $hotel)
        <li><a href=" {{ route('check', $hotel->id) }}">{{ $hotel->name }}</a></li>
    @endforeach
@endsection
