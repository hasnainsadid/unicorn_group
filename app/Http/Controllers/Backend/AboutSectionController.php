<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function index()
    {
        $sections = AboutSection::orderBy('id')->get();
        return view('backend.pages.about_sections.index', compact('sections'));
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('backend.pages.about_sections.edit', ['section' => $aboutSection]);
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $data = $request->validate([
            'eyebrow'    => 'nullable|string|max:80',
            'title'      => 'required|string|max:200',
            'highlight'  => 'nullable|string|max:120',
            'body'       => 'nullable|string|max:5000',
            'btn_text'   => 'nullable|string|max:60',
            'btn_url'    => 'nullable|string|max:255|required_with:btn_text',
            'image_main' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image_sub'  => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        foreach (['image_main', 'image_sub'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = imageUpdateManager($request->file($field), $aboutSection->key, 'sections', $aboutSection->$field ?? '');
            } else {
                unset($data[$field]);
            }
        }

        $aboutSection->update($data);

        notify()->success('Section updated successfully.');
        return redirect()->route('about-sections.index');
    }
}