<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;
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
        $validated['title'] = Str::limit($validated['title'], 252, '...');

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
            // notice('Пост успешно опубликован!', 'success');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data = Text::where('slug', $slug)->firstOrFail();
        return view('show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
