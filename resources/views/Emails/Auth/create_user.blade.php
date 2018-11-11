@extends('layouts.base-email')

@section('content')
    <p>
        Olá,<br/>
        Seja bem vindo.
        <br>
        Abaixo seus dados de acesso ao sistema.
        <br>
        <strong>E-mail: </strong>{{ $user->email }}
        <br>
        <strong>Senha: </strong>{{ $user->password }}
    </p>
@endsection
