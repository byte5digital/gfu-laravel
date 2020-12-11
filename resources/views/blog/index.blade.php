@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Blogbeiträge</h1>

    @foreach($categories as $category)

<a class="btn btn-primary" href="{{route('blog.categorized', $category->id)}}">{{$category->name}}</a>

@endforeach

    @foreach($blogEntries as $blogEntry)

    <div class="row pb-2">
        <div class="col-3">{{$blogEntry->headline}}</div>
        <div class="col-2">
            {{-- For each tag display fake button --}}
            @foreach($blogEntry->categories as $category)

            <a role="button" class="badge badge-primary" href="{{route('blog.categorized', $category->id)}}">{{$category->name}}</a>

            @endforeach
            <a class="btn btn-primary" href="{{route('blog.show', $blogEntry)}}">Details</a>
        </div>
        @auth
        <div class="col-2">
            <a class="btn btn-success" href="{{route('blog.edit', $blogEntry)}}">Editieren</a>
        </div>
        <div class="col-2">
            <form method="POST" action="{{route('blog.delete', $blogEntry)}}">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Löschen</button>
            </form>

        </div>
        @endauth

    </div>

    @endforeach

    @auth
    <div class="row">
        <div class="col-4">
            <a href="{{route('blog.create')}}" class="btn btn-success">Blogeintrag erstellen</a>
        </div>
    </div>
    @endauth

    {{-- Blade partial that displays the pagination result using Bootstrap CSS --}}
    {{-- <div>{{ $blogEntries->links() }}</div> --}}
</div>
@endsection
