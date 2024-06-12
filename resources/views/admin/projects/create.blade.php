@extends('layouts.app')
@section('content')

<div class="container my-5">
    <form action="{{ route('admin.projects.store') }}" method="POST">

        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Data di inizio</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Data di fine</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date')}}">
        </div>

        <div class="mb-3">
            <label for="project_url" class="form-label">Url Progetto</label>
            <input type="text" class="form-control" id="project_url" name="project_url" value="{{old('project_url')}}">
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Type</label>
            <select name="type_id" id="type_id" class="form-control">
                <option value="">Seleziona il tipo</option>
                @foreach($types as $type)
                    <option @selected( $type->id == old('type_id') ) value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2 mb-3">
            @foreach ($technologies as $technology)
            <input @checked( in_array($technology->id, old('technologies',[])) ) name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="tag-{{$technology->id}}">
            <label class="form-check-label" for="tag-{{$technology->id}}">
              {{ $technology->title }}
            </label>
                
            @endforeach
          </div>
        
        <button type="submit" class="btn btn-success btn-lg">Crea</button>
      </form>

      <div class="my-4">
        @if ( $errors->any() )
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>




@endsection