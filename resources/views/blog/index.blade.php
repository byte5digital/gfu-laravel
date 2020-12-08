@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Blogbeiträge</h1>
  
    @foreach($categories as $category)

            <div class="row pb-2">
                <div class="col-3">{{$category->headline}}</div>
                <div class="col-2">
                    <a class="btn btn-primary" href="{{route('category.show', $category)}}">Details</a>
                </div>
                @auth
                    <div class="col-2">
                        <a class="btn btn-success" href="{{route('category.edit', $category)}}">Editieren</a>
		    </div>
		    <div class="col-2">
			<form method="POST" action="{{route('category.delete', $category)}}">
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
            <a href="{{route('category.create')}}" class="btn btn-success">Kategorie erstellen</a>
        </div>
    </div>
    @endauth
</div>
@endsection
