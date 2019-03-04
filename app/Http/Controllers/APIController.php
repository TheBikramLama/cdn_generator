<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function generate_cdn(Request $request)
    {
        $decoded_url = base64_decode($request->url);
        $url_array = explode('%yz', $decoded_url);
        if ( count($url_array) < 4 || count($url_array) == null )
        {
            return response()->json([
                'error' => true,
                'message' => 'Invalid URL'
            ]);
        }
        $username = $url_array[1];
        $repo = $url_array[2];
        $version = $url_array[3];
        $file = str_replace(['%yz','%ab'], ['/', '.'], explode($version, $decoded_url)[1]);

        $new_url = "https://cdn.jsdelivr.net/gh/{$username}/{$repo}@{$version}{$file}";

        return response()->json([
            'error' => false,
            'cdn_url' => $new_url
        ]);
    }
}
