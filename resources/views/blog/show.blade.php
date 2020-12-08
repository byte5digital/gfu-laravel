@extends('layouts.app')
@section('content')
<div class="container">
    <div class="form-group">
        <label for="headline">Überschrift</label>
        <input type="text" class="form-control" id="headline" name="headline" readonly value="{{$blogEntry->headline}}" />
    </div>
    <div class="form-group">
        <label for="content">Inhalt</label>
        <textarea class="form-control" id="content" name="content" readonly>{{$blogEntry->content}}</textarea>
    </div>
    <a href="{{url()->previous()}}" class="btn btn-success">Zurück</a>
</div>

@endsection
