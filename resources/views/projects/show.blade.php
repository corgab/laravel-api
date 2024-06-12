@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Data inizio</th>
                <th scope="col">Data fine</th>
                <th scope="col">Url Progetto</th>
                <th scope="col">Tipo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->slug }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>{{ $project->project_url }}</td>
                <td>{{ optional($project->type)->title }}</td>
            </tr>
        </tbody>
    </table>
</div>


@endsection