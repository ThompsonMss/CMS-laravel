@extends('adminlte::page')

@section('title', 'Novo Usuários')

@section('content_header')
    <h1>Novo Usuário</h1>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Erro</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="form-group">
            <div class="box-body">
                <label class="col-sm-4 control-label">Nome completo</label>
                <div class="col-sm-8">
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="box-body">
                <label class="col-sm-4 control-label">E-mail</label>
                <div class="col-sm-8">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="box-body">
                <label class="col-sm-4 control-label">Senha</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="box-body">
                <label class="col-sm-4 control-label">Confirmação da Senha</label>
                <div class="col-sm-8">
                    <input type="password" name="password_confirmation" class="form-control" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="box-body">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                    <input type="submit" value="Cadastrar" class="btn btn-success" />
                </div>
            </div>
        </div>
    </form>
    </div>
@endsection
