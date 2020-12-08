@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Category</h1>
<form action="{{route('category.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $category->name)}}" />
        @include('error.name')
    </div>
    <button type="submit" class="btn btn-danger">Speichern</button>
    </form>
    <a href="{{route('category.index')}}" class="btn btn-success">Zurück</a>
</div>

@endsection
