<!-- Extend this view using layouts/app.blade.php -->
@extends('layouts.app')

<!-- Define content section which is yield in layouts/app.blade.php -->
@section('content')
<div class="container">
    <h1>Blogbeiträge</h1>

    <!-- Blade partial foreach, $categories are passed from controller to this view -->
    @foreach($categories as $category)

    <!-- {{}} partial can use functions like route() or display content of variables -->
    <a class="btn btn-primary" href="{{route('blog.categorized', $category->id)}}">{{$category->name}}</a>

    <!-- End foreach block -->
    @endforeach

    <!-- Blade partial foreach, $blogEntries are passed from controller to this view -->
    @foreach($blogEntries as $blogEntry)

    <div class="row pb-2">
        <!-- Blade partial to get headline of blogEntry -->
        <div class="col-3">{{$blogEntry->headline}}</div>
        <div class="col-2">
            <!-- Foreach to display fake button  -->
            @foreach($blogEntry->categories as $category)

            <a role="button" class="badge badge-primary" href="{{route('blog.categorized', $category->id)}}">{{$category->name}}</a>
            <!-- End foreach block -->
            @endforeach
            <a class="btn btn-primary" href="{{route('blog.show', $blogEntry)}}">Details</a>
        </div>
        <!-- Blade partial for auth, the parts in this will only be shown to logged in users -->
        <!-- Opposite of @auth is @guest which shows specific parts only to not logged in users  -->
        @auth
        <div class="col-2">
            <a class="btn btn-success" href="{{route('blog.edit', $blogEntry)}}">Editieren</a>
        </div>
        <div class="col-2">
            <!-- Fake form for Delete Button -->
            <form method="POST" action="{{route('blog.delete', $blogEntry)}}">
                <!-- Browser knows only POST and GET so we have to set the method to Delete via blade partial @method() -->
                @method('DELETE')
                <!-- Blade partial for csrf token, forms wont work without this and return 419 when the form is send! -->
                @csrf
                <button class="btn btn-danger" type="submit">Löschen</button>
            </form>

        </div>
        <!-- End of auth block -->
        @endauth

    </div>

    @endforeach

    <!-- Display button to blog.create only to logged in users -->
    @auth
    <div class="row">
        <div class="col-4">
            <a href="{{route('blog.create')}}" class="btn btn-success">Blogeintrag erstellen</a>
        </div>
    </div>
    <!-- End of auth block -->
    @endauth

    <!-- Blade partial that displays the pagination result using Bootstrap CSS  -->
    <div>{{ $blogEntries->links() }}</div>
</div>
<!-- End of content section -->
@endsection