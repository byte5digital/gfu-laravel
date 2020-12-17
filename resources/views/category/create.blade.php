<!-- Extend this view using layouts/app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts/app.blade.php -->
@section('content')
<div class="container">
<h1>Kategorie erstellen</h1>
<form action="{{route('category.store')}}" method="POST">
     <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <!-- if error exists include is-invalid tag -->
        <input 
        type="text" 
        class="form-control @error('name') is-invalid @enderror" 
        id="name" name="name" 
        placeholder="Name" 
        value="{{old('name')}}"/>
        <!-- old() fills value with data in form before it was sent in case an error happens -->
       <!-- Include view error.name in case an error occurs -->
        @include('error.name')
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
</form>
</div>

<!-- End of content section -->
@endsection
