<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <style>
        .required::after {
            content: ' *';
            color: red;
        }
    </style>
</head>
<body>
    <div class="container py-3">
        <x-notice />
        <h1 class="text-center">Telegraph</h1>
        <?= $message??'' ?>
        <form method="POST" action="{{ empty($data) ? '' : route('text.update', $data['slug']) }}">
            @csrf

            @if (! empty($data))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label required">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" value="{{ $data['title']??'' }}" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label required">Текст</label>
                <textarea name="text" cols="30" rows="10" id="text" class="form-control" placeholder="Текст заметки..." required>{{ $data['text']??'' }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="author" class="form-label">Ваше имя <span class="text-muted">(не обязательно)</span></label>
                        <input type="text" name="author" id="author" class="form-control" placeholder="Аноним" value="{{ $data['author']??'' }}" maxlength="50">
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
    </div>
</body>
</html>
