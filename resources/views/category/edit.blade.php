<!-- Extend this view using layouts/app.blade.php -->
@extends('layouts.app')


<!-- Define content section which is yield in layouts/app.blade.php -->
@section('content')
<div class="container">
    <h1>Edit Category</h1>
<form action="{{route('category.update', $category->id)}}" method="POST">
     <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
    @csrf
    <!-- Browser knows only POST and GET so we have to set the method to PUT via blade partial @method() -->
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <!-- if error exists include is-invalid tag -->
         <!-- old() fills value with data in form before it was sent in case an error happens -->
         <!-- if old value doesnt exists take the name of the category -->
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $category->name)}}" />
         <!-- Include view error.name in case an error occurs -->
        @include('error.name')
    </div>
    <button type="submit" class="btn btn-danger">Speichern</button>
    </form>
    <a href="{{route('category.index')}}" class="btn btn-success">Zurück</a>
</div>

<!-- End of content section -->
@endsection
