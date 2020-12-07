@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Blogbeiträge</h1>
    @foreach($blogEntries as $blogEntry)
    <a href="{{route('blog.show', $blogEntry)}}">
        <div class="row">
            <div class="col-4">{{$blogEntry->headline}}</div>
            <div class="col-4">{{$blogEntry->user->name}}</div>
        </div>
    </a>
    @endforeach

    @auth
    <div class="row">
        <div class="col-4">
            <a href="{{route('blog.create')}}" class="btn btn-success">Blogbeitrag erstellen</a>
        </div>
    </div>
    @endauth
</div>
@endsection
