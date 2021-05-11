@extends('adminlte::page')

@section('title', 'Configurações')

@section('content_header')
    <h1>Configurações</h1>
@stop

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

    @if (session('warning'))
        <div class="alert alert-success">
            {{ session('warning') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.save') }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Título do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" value="{{ $settings['title'] }}" class="form-control" />
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Sub-titulo do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitle" value="{{ $settings['subtitle'] }}" class="form-control" />
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">E-mail para contato</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $settings['email'] }}" class="form-control" />
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Cor do fundo</label>
                    <div class="col-sm-10">
                        <input style="width: 70px" type="color" name="bgcolor" value="{{ $settings['bgcolor'] }}"
                            class="form-control" />
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Cor do Texto</label>
                    <div class="col-sm-10">
                        <input style="width: 70px" type="color" name="textcolor" value="{{ $settings['textcolor'] }}"
                            class="form-control" />
                    </div>
                </div>

                <hr />

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" value="Salvar" class="btn btn-success" />
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
