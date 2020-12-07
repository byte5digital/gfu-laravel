@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Blogbeiträge</h1>
    @foreach($blogEntries as $blogEntry)

            <div class="row pb-2">
                <div class="col-3">{{$blogEntry->headline}}</div>
                <div class="col-3">{{$blogEntry->user->name}}</div>
                <div class="col-2">
                    <a class="btn btn-primary" href="{{route('blog.show', $blogEntry)}}">Details</a>
                </div>
                @auth
                    <div class="col-2">
                        <a class="btn btn-success" href="{{route('blog.edit', $blogEntry)}}">Editieren</a>
		    </div>
		    <div class="col-2">
			<form method="POST" action="{{route('blog.delete', $blogEntry)}}">
				@method('DELETE')
				@csrf
				<button class="btn btn-danger" type="submit">Löschen</button>
			</form>
		    </div>
                @endauth

            </div>

    @endforeach

    @auth
    <div class="row">
        <div class="col-4">
            <a href="{{route('blog.create')}}" class="btn btn-success">Blogbeitrag erstellen</a>
        </div>
    </div>
    @endauth
</div>
@endsection
