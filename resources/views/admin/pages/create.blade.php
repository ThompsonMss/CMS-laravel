@extends('adminlte::page')

@section('title', 'Nova Página')

@section('content_header')
    <h1>Nova Página</h1>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h4><i class="icon fas fa-ban"></i>Erro</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">

        <div class="card-body">
            <form action="{{ route('pages.store') }}" method="POST" class="form-horizontal">
                @csrf

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label">Título</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ old('title') }}" name="title"
                            class="form-control @error('title') is-invalid @enderror" />
                    </div>

                </div>
                <hr />
                <div class="form-group row">

                    <label class="col-sm-4 col-form-label">Corpo</label>
                    <div class="col-sm-8">

                        <textarea name="body" id="body" cols="30" rows="10"
                            class="form-control">{{ old('body') }}</textarea>
                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8">
                        <input type="submit" value="Criar" class="btn btn-success" />
                    </div>

                </div>

            </form>
        </div>
    </div>
    </div>
@endsection
