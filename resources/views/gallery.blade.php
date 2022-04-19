@extends('layout.layout')

@section('content')
        <div style="padding: 10px" >
            <div class="panel-heading " style="color: black; font-weight: bold; padding: 4px; text-align: center; font-size: 25px;}">
                {{ $message }}
            </div>
        </div>
        <div class="cards">
            @foreach ($gallery as $picture)
                <img src="{{ url('/storage/'. $picture) }}" alt="gallery picture" title="image">
            @endforeach
        </div>
@endsection
