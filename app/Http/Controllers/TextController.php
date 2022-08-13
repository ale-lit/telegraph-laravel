<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TextController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            // ! TODO: Отправить email $validated['email']

            // Generate secret validate token
            $token = Hash::make(config('app.key') . $slug);

            // var_dump(Hash::check(config('app.key') . $slug, $token));
            // var_dump(Hash::check('plain-text', $token));

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        // Check access
        $access = checkAccess($slug);

        $data = Text::where('slug', $slug)->firstOrFail();
        return view('show', compact('data', 'access'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        // Check access
        if (! checkAccess($slug)) {
            abort(403);
        }

        $data = Text::where('slug', $slug)->firstOrFail();
        return view('main', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

            // ! TODO: Отправить email $validated['email']

            return redirect()
                ->route('text.show', $slug);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $text = Text::where('slug', $slug)->firstOrFail();
        $text->forceDelete();
        notice('Пост успешно удалён!');
        return redirect()
                ->route('text.create');
    }
}
