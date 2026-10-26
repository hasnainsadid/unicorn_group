<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Concern;

class ConcernController extends Controller
{
    public function show(string $path)
    {
        $concern = Concern::where('path', trim($path, '/'))->firstOrFail();
        $concern->load('children');

        $ancestors = $concern->ancestors();
        $root = $ancestors->first() ?? $concern;
        $root->load('childrenRecursive');

        return view('frontend.pages.concerns.show', compact('concern', 'ancestors', 'root'));
    }
}
