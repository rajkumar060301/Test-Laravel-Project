@extends('layouts.app')  // Include your layout if you have one

@section('content')
    <h1>All Session Values</h1>

    <ul>
        @foreach ($allSessionValues as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
        @endforeach
    </ul>
@endsection
