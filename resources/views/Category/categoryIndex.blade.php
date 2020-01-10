@extends('app')

@section('simple crud', 'Simple CRUD')

@section('sidebar')
    @parent
    <p>Category listing.</p>
@endsection
@section('content')
    @foreach($categories as $key => $value)
        <p>
            <a href="/categories/{{$value->id}}">
                Category: {{ $value->id }} - {{ $value->name }}
            </a>
        </p>
    @endforeach

    <a href="/categories/create">
        CREATE
    </a>
@endsection
