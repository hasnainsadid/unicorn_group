<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::ordered()->get();
        return view('backend.pages.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('backend.pages.clients.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = imageUploadManager($request->file('logo'), Str::slug($data['name']), 'clients');
        } else {
            unset($data['logo']);
        }

        Client::create($data);

        notify()->success('Client added successfully.');
        return redirect()->route('clients.index');
    }

    public function edit(Client $client)
    {
        return view('backend.pages.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $this->validated($request);

        if ($request->hasFile('logo')) {
            $data['logo'] = imageUpdateManager($request->file('logo'), Str::slug($data['name']), 'clients', $client->logo);
        } elseif ($request->boolean('remove_logo')) {
            if ($client->logo) {
                imageDeleteManager($client->logo);
            }
            $data['logo'] = null;
        } else {
            unset($data['logo']);
        }

        $client->update($data);

        notify()->success('Client updated successfully.');
        return redirect()->route('clients.index');
    }

    public function toggle(Client $client)
    {
        $client->update(['status' => !$client->status]);

        notify()->success('Client status changed.');
        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            imageDeleteManager($client->logo);
        }
        $client->delete();

        notify()->success('Client deleted successfully.');
        return redirect()->route('clients.index');
    }

    private function validated(Request $request): array
{
    $data = $request->validate([
        'name'       => 'required|string|max:120',
        'logo'       => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
        'sort_order' => 'nullable|integer|min:0',
    ]);

    $data['sort_order'] = $data['sort_order'] ?? 0;

    return $data;
}
}