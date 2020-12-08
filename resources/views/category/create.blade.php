@extends('layouts.app')
@section('content')
<div class="container">
<h1>Kategorie erstellen</h1>
<form action="{{route('category.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input 
        type="text" 
        class="form-control @error('name') is-invalid @enderror" 
        id="name" name="name" 
        placeholder="Name" 
        value="{{old('name')}}"/>
        @include('error.name')
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
</form>
</div>
@endsection
