<?php

namespace App\Services;

use App\Models\ShortcutUrl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ShortcutUrlService
{
   public function generateUrl(string $url)
   {
       if (!$this->checkSafeUrl($url)) {
           return null;
       }
       $shortcutUrl = new ShortcutUrl();
       $shortcutUrl->original_url = $url;
       $slug = $this->generateUniqueSlug();
       $shortcutUrl->slug = $slug;
       $shortcutUrl->shorten_url = config('app.url') . '/' . $slug;
       $shortcutUrl->save();

       return $shortcutUrl;
   }

   private function checkSafeUrl(string $url)
   {
       $payload = [
           "client" => [
               "clientId" => config('app.name'),
               "clientVersion" => "1.5.2"
           ],
           "threatInfo" => [
               "threatTypes" => [
                   "MALWARE",
                   "SOCIAL_ENGINEERING"
               ],
               "platformTypes" => [
                   "WINDOWS"
               ],
               "threatEntryTypes" => [
                   "URL"
               ],
               "threatEntries" => [
                   [
                       "url" => $url
                   ]
               ]
           ]
       ];

       $safeBrowsingPayloadUrl = config('app.google_safe_browsing_api_url');
       $safeBrowsingPayloadUrl = str_replace('xxxxxx', config('app.google_api_key'), $safeBrowsingPayloadUrl);
       $response = Http::post($safeBrowsingPayloadUrl, $payload);

       if ($response->getStatusCode() == 200 && empty($response->body())) {
           return false;
       }

       return true;
   }

   private function generateUniqueSlug() {
       $slug = Str::random(6);
       $existingSlug = ShortcutUrl::where('slug', $slug)->first();

       if ($existingSlug) {
           return $this->generateUniqueSlug(); // Recursive call if slug already exists
       }

       return $slug;
   }

}
