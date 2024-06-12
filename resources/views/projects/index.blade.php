@extends('layouts.app')
@section('content')

<div class="container">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Titolo</th>
        <th scope="col">Descrizione</th>
        {{-- <th scope="col">Data inizio</th>
        <th scope="col">Data fine</th> --}}
        <th scope="col">Url Progetto</th>
        <th scope="col">Tipo</th>
        <th scope="col">Azioni</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($projects as $project)
      <tr>
        <td>{{ $project->title }}</td>
        <td>{{ $project->description }}</td>
        {{-- <td>{{ $project->start_date }}</td>
        <td>{{ $project->end_date }}</td> --}}
        <td>{{ $project->project_url }}</td>
        <td>{{ optional($project->type)->title }}</td>
        <td>
          <a href="{{route('projects.show', $project)}}" class="btn btn-primary">Visualizza</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>




@endsection