<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        // Bot ke eki "success" response dei, jate se bujhte na pare dhora poreche
        $done = fn () => $request->expectsJson()
            ? response()->json(['ok' => true])
            : back()->with('success', 'Thank you! We will get back to you shortly.');

        // 1. Honeypot: manush ei hidden field dekhe na, bot fill kore
        if ($request->filled('website')) {
            return $done();
        }

        // 2. Time trap: page load er 3 second er moddhe submit hole bot
        try {
            $loadedAt = (int) decrypt($request->input('form_time'));
        } catch (\Throwable $e) {
            return $done();
        }
        if (now()->timestamp - $loadedAt < 3) {
            return $done();
        }

        // 3. Validation
        $data = $request->validate([
            'name'    => 'required|string|min:2|max:100',
            'email'   => 'required|email:rfc|max:150',
            'message' => 'required|string|min:10|max:2000',
        ]);

        $data['name']    = strip_tags($data['name']);
        $data['message'] = strip_tags($data['message']);

        // 4. Link spam: message e 2 tar beshi link thakle ignore
        if (preg_match_all('~https?://|www\.~i', $data['message']) > 2) {
            return $done();
        }

        // 5. Duplicate: ek-i email theke ek-i message 24 ghontar moddhe abar asle ignore
        $duplicate = Contact::where('email', $data['email'])
            ->where('message', $data['message'])
            ->where('created_at', '>=', now()->subDay())
            ->exists();
        if ($duplicate) {
            return $done();
        }

        Contact::create([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'message' => $data['message'],
        ]);

        return $done();
    }
}