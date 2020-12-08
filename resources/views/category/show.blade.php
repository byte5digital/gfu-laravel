<?php
/**
 * @var \App\Category $category
 */
?>


@extends('layouts.app')

@section('content')
<div class="container">
{{-- If session has status display parapraph with status--}}
    @if(Session::has('status'))
        <p class="alert alert-success">{{ Session::get('status') }}</p>
    @endif
<h1>Kategorie - {{$category->name}}</h1>
<div class="col-2">
                        <a class="btn btn-success" href="{{route('category.edit', $category->id)}}">Editieren</a>
		    </div>
<form action="{{route('category.destroy',$category->id)}}" method="post">

     @csrf <!-- Cross-Site-Request-Forgery -->
      @method('delete')
   <button type="submit" class="btn btn-danger">Delete</button>
</form>
</div>
@endsection
