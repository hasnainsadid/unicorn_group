<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Management;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::ordered()->get();
        return view('backend.pages.managements.index', compact('managements'));
    }

    public function edit(Management $management)
    {
        return view('backend.pages.managements.edit', compact('management'));
    }

    public function update(Request $request, Management $management)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = imageUpdateManager($request->file('photo'), Str::slug($data['name']), 'management', $management->photo ?? '');
        } elseif ($request->boolean('remove_photo')) {
            imageDeleteManager($management->photo ?? '');
            $data['photo'] = null;
        } else {
            unset($data['photo']);
        }

        $management->update($data);

        notify()->success('Member updated successfully.');
        return redirect()->route('managements.index');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'role_title'  => 'required|string|max:120',
            'name'        => 'required|string|max:120',
            'designation' => 'required|string|max:160',
            'quote'       => 'nullable|string|max:300',
            'message'     => 'required|string|max:8000',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:30720',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}