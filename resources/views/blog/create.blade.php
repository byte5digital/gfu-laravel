@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Blog Beitrag erstellen</h1>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="headline">Überschrift</label>
            <input type="text" class="form-control" id="headline" name="headline" placeholder="Überschrift" />
        </div>
        <div class="form-group">
            <label for="content">Inhalt</label>
            <textarea class="form-control" id="content" name="content"></textarea>
        </div>
        <div>
            <label for="img">Image</label>
            <div class="col-md-6">
                <input id="img" type="file" class="form-control" name="img">

            </div>
        </div>
        <div class="field">
            <label class="label" for="body">Category</label>
            <div class="control">

                <select name="categories[]" multiple class="form-control">
                    {{-- For each tag insert an option --}}
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>



            </div>
        </div>
        <button type="submit" class="btn btn-danger">Speichern</button>
    </form>
</div>
@endsection