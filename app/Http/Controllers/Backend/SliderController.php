<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->orderBy('id')->get();
        return view('backend.pages.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('backend.pages.sliders.create');
    }

    public function store(Request $request)
    {
        Slider::create($this->validated($request));

        notify()->success('Slide added successfully.');
        return redirect()->route('sliders.index');
    }

    public function edit(Slider $slider)
    {
        return view('backend.pages.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $slider->update($this->validated($request));

        notify()->success('Slide updated successfully.');
        return redirect()->route('sliders.index');
    }

    public function toggle(Slider $slider)
    {
        $slider->update(['status' => !$slider->status]);

        notify()->success('Slide status changed.');
        return redirect()->route('sliders.index');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        notify()->success('Slide deleted successfully.');
        return redirect()->route('sliders.index');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'eyebrow'    => 'nullable|string|max:120',
            'title'      => 'required|string|max:200',
            'highlight'  => 'nullable|string|max:80',
            'text'       => 'nullable|string|max:500',
            'btn1_text'  => 'nullable|string|max:60',
            'btn1_url'   => 'nullable|string|max:255|required_with:btn1_text',
            'btn2_text'  => 'nullable|string|max:60',
            'btn2_url'   => 'nullable|string|max:255|required_with:btn2_text',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['status'] = $request->boolean('status');

        return $data;
    }
}