<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['title'] . '-' . config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container py-3">
        @if ($access)
            <a href="{{ route('text.edit', $data['slug']) }}" type="button" class="btn btn-dark btn-sm float-end">Редактировать</a>
        @endif
        <h1>{{ $data['title'] }}</h1>
        <?= $message??'' ?>
        <p class="text-muted">{{ $data['author']??'Аноним' }} / {{ $data['updated_at']->format('d.m.Y') }}</p>
        <p>{{ $data['text'] }}</p>
    </div>
</body>
</html>
