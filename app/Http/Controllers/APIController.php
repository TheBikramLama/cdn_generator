<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function generate_cdn(Request $request)
    {
        $url_array = explode('%yz', $request->url);
        if ( count($url_array) < 1 )
        {
            return response()->json([
                'error' => true,
                'message' => 'Invalid URL'
            ]);
        }
        $username = $url_array[1];
        $repo = $url_array[2];
        $version = $url_array[3];
        $file = str_replace(['%yz','%ab'], ['/', '.'], explode($version, $request->url)[1]);

        $new_url = "https://cdn.jsdelivr.net/gh/{$username}/{$repo}@{$version}{$file}";

        return response()->json([
            'error' => false,
            'cdn_url' => $new_url
        ]);
    }
}
