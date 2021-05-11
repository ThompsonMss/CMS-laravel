@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
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
            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nome completo</label>
                    <div class="col-sm-8">
                        <input type="text" value="{{ $user->name }}" name="name"
                            class="form-control @error('name') is-invalid @enderror" />
                    </div>
                </div>
                <hr />
                <div class="form-group row">

                    <label class="col-sm-4 col-form-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" value="{{ $user->email }}"
                            class="form-control @error('email') is-invalid @enderror" />
                    </div>

                </div>
                <hr />
                <div class="form-group row">

                    <label class="col-sm-4 col-form-label">Nova Senha</label>
                    <div class="col-sm-8">
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" />
                    </div>

                </div>
                <hr />
                <div class="form-group row">

                    <label class="col-sm-4 col-form-label">Senha Novamente</label>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password') is-invalid @enderror" />
                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-8">
                        <input type="submit" value="Salvar" class="btn btn-success" />
                    </div>

                </div>

            </form>
        </div>
    </div>
    </div>
@endsection