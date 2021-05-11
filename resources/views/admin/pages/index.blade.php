@extends('adminlte::page')

@section('title', 'Páginas')

@section('content_header')
    <h1>Minhas Páginas
        <a href="{{ route('pages.create') }}" class="btn btn-sm btn-success">Nova Página</a>
    </h1>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <table class='table table-hover'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->titulo }}</td>
                            <td>
                                <a href="{{ route('pages.edit', ['page' => $page->id]) }}"
                                    class="btn btn-sm btn-info">Editar</a>

                                <form class="d-inline" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluír?')"
                                    action="{{ route('pages.destroy', ['page' => $page->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-sm btn-danger" value="Excluír" type="submit" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $pages->links() }}

@endsection
