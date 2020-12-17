<!-- Extend this view using layouts / app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts / app.blade.php -->
@section('content')
<div class="container">
    <h1>Kategorien</h1>
    <!-- If session has status display parapraph with status- -->
    @if(Session::has('status'))
    <p class="alert alert-success">{{ Session::get('status') }}</p>
    <!-- end if session has status -->
    @endif
    <!-- for each category create a row -->
    @foreach ($categories as $category)
    <div class="row">
        <div class="col-1">
            {{$category->id}}
        </div>
        <div class="col-2">
            <a href="{{route('category.show', $category->id)}}">{{$category->name}}</a>
        </div>
    </div>
    <!-- end foreach -->
    @endforeach

    <!-- Blade partial for auth, the parts in this will only be shown to logged in users -->
    <!-- Opposite of auth is guest which shows specific parts only to not logged in users  -->
    @auth
    <div class="row">
        <div class="col-2">
            <a href="{{route('category.create')}}" class="btn btn-success">Neue Kategorie</a>
        </div>
    </div>
    <!-- End of auth block -->
    @endauth
</div>
<!-- End of content section -->
@endsection