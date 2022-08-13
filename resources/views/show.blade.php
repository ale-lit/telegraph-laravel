@extends('templates.base')

@section('meta-title', $data['title'] . ' - ' . config('app.name'))

@section('content')
    @if ($access)
        <form method="POST" action="{{ route('text.destroy', $data['slug']) }}">
            @csrf
            @method('DELETE')

            <button onclick="return confirm('Вы уверены?')" type="submit" class="btn btn-danger btn-sm float-end">Удалить</button>
        </form>
        <a href="{{ route('text.edit', $data['slug']) }}" type="button" class="btn btn-dark btn-sm me-1 float-end">Редактировать</a>
    @endif
    <h1>{{ $data['title'] }}</h1>
    <p class="text-muted">
        {{ $data['author'] ?? 'Аноним' }}
        <span class="date">
            {{ $data['updated_at']->format('d.m.Y') }}
        </span>
    </p>
    <p>{{ $data['text'] }}</p>
@endsection
