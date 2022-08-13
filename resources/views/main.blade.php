<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .required::after {
            content: ' *';
            color: red;
        }
    </style>
</head>
<body>
    <div class="container py-3">
        <h1 class="text-center">Telegraph</h1>
        <?= $message??'' ?>
        <form method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label required">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" required>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label required">Текст</label>
                <textarea name="text" cols="30" rows="10" id="text" class="form-control" placeholder="Текст заметки..." required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="author" class="form-label">Ваше имя <span class="text-muted">(не обязательно)</span></label>
                        <input type="text" name="author" id="author" class="form-control" placeholder="Аноним" maxlength="50">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Ваш Email <span class="text-muted">(для получения ссылки на заметку)</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="mymail@mail.ru">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</body>
</html>
