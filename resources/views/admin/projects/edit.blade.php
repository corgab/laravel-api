@extends('layouts.app')
@section('content')

<div class="container my-5">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old('title', $project->title)}}">
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug', $project->slug)}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" class="form-control" id="description" name="description" value="{{old('description', $project->description)}}">
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Data di inizio</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date', $project->start_date)}}">
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Data di fine</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date', $project->end_date)}}">
        </div>

        <div class="mb-3">
            <label for="project_url" class="form-label">Url Progetto</label>
            <input type="text" class="form-control" id="project_url" name="project_url" value="{{old('project_url', $project->project_url)}}">
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label">Tipo</label>
            <select name="type_id" id="type_id" class="form-control">
                <option value="">Seleziona il tipo</option>
                @foreach($types as $type)
                    <option @selected( $type->id == old('type_id', $project->type_id) ) value="{{ $type->id }}">{{ $type->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2 mb-3">
            @foreach ($technologies as $technology)

            {{-- @dd($technology) --}}
            {{-- @dd($technology->technologies->pluck('id')->all()) --}}

              <div class="form-check">
                <input @checked( in_array($technology->id,  old('technologies',$project->technologies->pluck('id')->all() )) ) name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="tag-{{$technology->id}}">
                <label class="form-check-label" for="tag-{{$technology->id}}">
                  {{ $technology->title }}
                </label>
              </div>
                
            @endforeach
          </div>
        
        <button type="submit" class="btn btn-success btn-lg">Modifica</button>
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