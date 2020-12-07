@extends('layouts.app')
@section('content')
<div class="container">
<h1>Blog Beitrag erstellen</h1>
<form action="{{route('blog.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="headline">Überschrift</label>
        <input type="text" class="form-control" id="headline" name="headline" placeholder="Überschrift" />
    </div>
    <div class="form-group">
        <label for="content">Inhalt</label>
        <textarea class="form-control" id="content" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-danger">Speichern</button>
</form>
</div>
@endsection
