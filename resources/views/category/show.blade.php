<!-- Extend this view using layouts / app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts / app.blade.php -->
@section('content')
<div class="container">
    <!-- If session has status display parapraph with status -->
    @if(Session::has('status'))
    <p class="alert alert-success">{{ Session::get('status') }}</p>
    <!-- end if session has status -->
    @endif
    <h1>Kategorie - {{$category->name}}</h1>
    <div class="col-2">
        <a class="btn btn-success" href="{{route('category.edit', $category->id)}}">Editieren</a>
    </div>
    <form action="{{route('category.destroy',$category->id)}}" method="post">
        <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
        @csrf
        <!-- Browser knows only POST and GET so we have to set the method to Delete via blade partial method -->
        @method('delete')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>

<!-- End of content section -->
@endsection