@extends('templates.base')

@section('content')
    <h1 class="text-center">Telegraph</h1>
    <form method="POST" action="{{ empty($data) ? '' : route('text.update', $data['slug']) }}">
        @csrf

        @if (! empty($data))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label required">Заголовок</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" value="{{ $data['title'] ?? '' }}" required>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label required">Текст</label>
            <textarea name="text" cols="30" rows="10" id="text" class="form-control" placeholder="Текст заметки..." required>{{ $data['text'] ?? '' }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="author" class="form-label">Ваше имя <span class="text-muted">(не обязательно)</span></label>
                    <input type="text" name="author" id="author" class="form-control" placeholder="Аноним" value="{{ $data['author'] ?? $_COOKIE['author'] ?? '' }}" maxlength="50">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Ваш Email <span class="text-muted">(для получения ссылки на заметку)</span></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="mymail@mail.ru">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            @if (! empty($data))
                Сохранить
            @else
                Отправить
            @endif
        </button>
    </form>
@endsection
