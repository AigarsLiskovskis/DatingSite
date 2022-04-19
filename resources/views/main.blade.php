@extends('layout.layout')

@section('content')
    <div class="class1">
        <div class="center">
            <form method="post" action="/main" class="inline">
                @csrf
                <input type="hidden" name="personId" value="{{ $person->id }}">
                <button type="submit" name="like_dislike" value="D" class="disliked" style="width: 300px; height:200px;
                         position: relative; background: firebrick; border-radius: 20px; font-size: 100px;">
                    Dislike
                </button>
            </form>
        </div>
    </div>
    <div class="class2">
        <a href="gallery/{{ $person->id }}">
            <div class="center">
                <div class="panel-heading "
                     style="color: black; font-weight: bold; padding: 4px; text-align: center; font-size: 25px;">
                    {{ $person->first_name }} {{ $person->last_name  }} <br> Age: {{ $person->age }}
                </div>
                <img src="{{ url('/storage/'. $image) }}" alt="profile image" title="image">
            </div>
        </a>
    </div>
    <div class="class3">
        <div class="center">
            <form method="post" action="/main" class="inline">
                @csrf
                <input type="hidden" name="personId" value="{{ $person->id }}">
                <button type="submit" name="like_dislike" value="L"
                        class="link-button" style="width: 300px; height:200px;
                         position: relative; background: chartreuse; border-radius: 20px; font-size: 100px;">
                    Like
                </button>
            </form>
        </div>
    </div>
@endsection
