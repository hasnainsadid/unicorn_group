<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CheckUploads
{
    public function handle(Request $request, Closure $next)
    {
        $all   = $request->allFiles();   // age variable e rakho (reference e pathate hoy)
        $files = [];
        array_walk_recursive($all, function ($f) use (&$files) {
            $files[] = $f;
        });

        foreach ($files as $file) {
            if ($file instanceof UploadedFile && ! $file->isValid()) {
                $message = $file->getErrorMessage();

                // Gallery uploader (AJAX) ei message pabe
                if ($request->expectsJson()) {
                    return response()->json(['message' => $message], 422);
                }

                notify()->error($message);
                return back()->withInput($request->except('_token'));
            }
        }

        return $next($request);
    }
}