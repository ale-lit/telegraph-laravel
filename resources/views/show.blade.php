@extends('templates.base')

@section('meta-title', $data['title'] . ' - ' . config('app.name'))

@section('content')
    @if ($access)
        <button onclick="removeConfirm('{{ $data['slug'] }}')" type="button" class="btn btn-danger btn-sm float-end">Удалить</button>
        <a href="{{ route('text.edit', $data['slug']) }}" type="button" class="btn btn-dark btn-sm me-1 float-end">Редактировать</a>
    @endif
    <h1>{{ $data['title'] }}</h1>
    <p class="text-muted">{{ $data['author']??'Аноним' }} / {{ $data['updated_at']->format('d.m.Y') }}</p>
    <p>{{ $data['text'] }}</p>
@endsection
