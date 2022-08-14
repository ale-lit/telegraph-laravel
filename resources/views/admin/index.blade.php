@extends('templates.base')

@section('meta-title', 'Админпанель - ' . config('app.name'))

@section('content')
    <a href="{{ route('auth.logout') }}" type="button" class="btn btn-dark btn-sm me-1 float-end">Выход</a>
    <h1>Админпанель</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Пост</th>
                <th scope="col">Автор</th>
                <th scope="col">Дата создания</th>
                <th scope="col">ip</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td><a href="{{ $post->slug }}">{{ $post->title }}</a> [{{ Str::length($post->text) }}]</td>
                    <td>{{ $post->author }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->ip }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
