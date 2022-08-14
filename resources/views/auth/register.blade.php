@extends('templates.base')

@section('meta-title', 'Регистрация нового администратора - ' . config('app.name'))

@section('content')

    @if (!empty($errors->any()))
        <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    @endif

    <h2 class="text-center">Регистрация нового администратора</h2>
    <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
        После добавления нового администратора, не забудьте отключить данный роут!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
    </div>
    <form method="POST">
        @csrf

        <div class="mb-3">
            <input type="text" name="login" class="form-control" placeholder="Логин" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Пароль еще раз" required>
        </div>
        <button type="submit" class="btn btn-primary">Регистрация</button>
    </form>
@endsection
