<?php

namespace App\Http\Controllers;

use App\Mail\LinkNotice;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TextController extends Controller
{
    public function create()
    {
        return view('main');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email'],
        ]);

        setcookie('author', $validated['author'], time()+60*60*24*365);

        // Cut long title
        if (mb_strlen($validated['title']) > 252) {
            $validated['title'] = Str::limit($validated['title'], 252, '...');
        }

        $text = new Text;
        $text->ip = request()->ip();

        // Generate slug
        $preSlug = Str::slug(Str::limit($validated['title'], 50), '-');
        $slug = $preSlug . today()->format('-d-m-y');
        for ($i = 1; Text::firstWhere('slug', $slug); $i++) {
            $slug = $preSlug . '-' . $i . today()->format('-d-m-y');
        }
        $text->slug = $slug;

        $result = $text->fill($validated)->save();

        if ($result) {
            notice('Пост успешно опубликован!');

            if ($validated['email']) {
                // Mail::to($validated['email'])->send(new LinkNotice($text));
            }

            // Generate secret validate token
            $token = Hash::make(config('app.key') . $slug);

            return redirect()
                ->route('text.show', $slug)->cookie(
                    $slug, $token, 60 * 24 * 365
                );
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function show(string $slug)
    {
        // Check access
        $access = checkAccess($slug) || auth()->check();

        $data = Text::where('slug', $slug)->firstOrFail();
        return view('show', compact('data', 'access'));
    }

    public function edit(string $slug)
    {
        // Check access
        if (! checkAccess($slug) && ! auth()->check()) {
            abort(403);
        }

        $data = Text::where('slug', $slug)->firstOrFail();
        return view('main', compact('data'));
    }

    public function update(Request $request, string $slug)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'text' => ['required', 'string'],
            'author' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email'],
        ]);

        setcookie('author', $validated['author'], time()+60*60*24*365);

        // Cut long title
        if (mb_strlen($validated['title']) > 252) {
            $validated['title'] = Str::limit($validated['title'], 252, '...');
        }

        $text = Text::where('slug', $slug)->firstOrFail();
        $text->ip = request()->ip();
        $result = $text->fill($validated)->save();

        if ($result) {
            notice('Пост успешно отредактирован!');

            return redirect()
                ->route('text.show', $slug);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function destroy($slug)
    {
        $text = Text::where('slug', $slug)->firstOrFail();
        $text->forceDelete();
        notice('Пост успешно удалён!');
        return redirect()
                ->route('text.create');
    }
}
