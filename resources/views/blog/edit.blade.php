@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{route('blog.update', $blogEntry)}}" method="POST">
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

                            <select
                                name="categories[]"
                                multiple
                                class="form-control"
                            >
                                {{-- For each tag insert an option --}}
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($attachedCategories->contains($category->id)) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>

                      

                        </div>
</div>
    <button type="submit" class="btn btn-danger">Speichern</button>
    </form>
    <a href="{{route('blog.index')}}" class="btn btn-success">Zurück</a>
</div>

@endsection
