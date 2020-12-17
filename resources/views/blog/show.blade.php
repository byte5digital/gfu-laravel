<!-- Extend this view using layouts/app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts/app.blade.php -->
@section('content')
<div class="container">
    <div class="form-group">
        <label for="headline">Überschrift</label>
        <input type="text" class="form-control" id="headline" name="headline" readonly value="{{$blogEntry->headline}}" />
    </div>
    <div>
        <!-- get image from storage with asset() -->
        <img src="{{asset('storage').$blogEntry->img_url}}" width="150" height="150" alt="{{$blogEntry->headline}}">
    </div>
    <div class="form-group">
        <label for="content">Inhalt</label>
        <textarea class="form-control" id="content" name="content" readonly>{{$blogEntry->content}}</textarea>
    </div>
    <!-- url()->previous() sends the user back to the page they were before, good for pagination! -->
    <a href="{{url()->previous()}}" class="btn btn-success">Zurück</a>
</div>

<!-- End of content section -->
@endsection