@extends('Layout')

@section('content')


    <h1 class="form-title">Connexion</h1>
    @if ($message = Session::get('success'))
        <h3>{{ $message }}</h3>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="form" method="post">
        @csrf

        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Saisir l'e-mail ici ...">
        <br /><br />

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Saisir le mot de passe ici ...">
        <br /><br />

        <button type="submit">
            Se connecter
        </button>
    </form>
@endsection
