<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortenUrlRequest;
use App\Models\ShortcutUrl;
use App\Services\ShortcutUrlService;

class ShortcutUrlController extends Controller
{
    public function store(StoreShortenUrlRequest $request, ShortcutUrlService $service)
    {
        $shortcutUrl = $service->generateUrl($request->url);

        if (!$shortcutUrl) {
            return response()->json([
                'message' => 'Shortcut URL was not generated because original URL is unsafe'
            ], 403);
        }

        return response()->json([
            'message' => 'Shortcut URL was generate successfully'
        ], 200);
    }

    public function shortcutRedirect(string $slug)
    {
        $shortcutUrl = ShortcutUrl::where('slug', $slug)->firstOrFail();

        return redirect($shortcutUrl->original_url);
    }

}
