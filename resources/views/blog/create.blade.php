<!-- Extend this view using layouts/app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts/app.blade.php -->
@section('content')
<div class="container">
    <h1>Blog Beitrag erstellen</h1>
    <!-- show this partial if errors exist -->
    <!-- Errors will be returned by validator -->
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <ul>
            <!-- for each error, show error -->
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            <!-- end foreach error -->
            @endforeach
        </ul>
    </div>
    <!-- end if errors exist -->
    @endif
    <!-- form to store new entry -->
    <!-- enctype = multipart/form-data is needed for passing images -->
    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
        <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
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
                    <!-- For each category insert an option  -->
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    <!-- end foreach category options -->
                    @endforeach
                </select>



            </div>
        </div>
        <button type="submit" class="btn btn-danger">Speichern</button>
    </form>
</div>

<!-- End of content section -->
@endsection