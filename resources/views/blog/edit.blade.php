<!-- Extend this view using layouts / app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts / app.blade.php -->
@section('content')
<div class="container">

    <div>
        <!-- get image from storage with asset -->
        <img src="{{asset('storage').$blogEntry->img_url}}" width="150" height="150" alt="{{$blogEntry->headline}}">
    </div>

    <!-- Form to update blogEntry -->
    <form action="{{route('blog.update', $blogEntry)}}" method="POST">
        <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
        @csrf
        <div class="form-group">
            <label for="headline">Überschrift</label>
            <input type="text" class="form-control" id="headline" name="headline" value="{{$blogEntry->headline}}" />
        </div>
        <div class="form-group">
            <label for="content">Inhalt</label>
            <textarea class="form-control" id="content" name="content">{{$blogEntry->content}}</textarea>
        </div>
        <div class="field">
            <label class="label" for="body">Category</label>
            <div class="control">

                <select name="categories[]" multiple class="form-control">
                    <!-- For each category insert an option  -->
                    @foreach($categories as $category)
                    <!-- Mark already attached categories as selected -->
                    <option value="{{$category->id}}" @if($attachedCategories->contains($category->id)) selected @endif>{{$category->name}}</option>
                    <!-- End of foreach block -->
                    @endforeach
                </select>



            </div>
        </div>
        <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
    <!-- url previous sends the user back to the page they were before, good for pagination! -->
    <a href="{{url()->previous()}}" class="btn btn-danger">Zurück</a>
</div>

<!-- End of content section -->
@endsection