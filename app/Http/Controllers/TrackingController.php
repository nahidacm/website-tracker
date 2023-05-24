<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Request $request)
    {

        // Generate a 1x1 pixel transparent GIF image response
        $imageData = base64_decode('R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=');

        // Return image response
        return response($imageData)->header('Content-Type', 'image/gif');
    }
}
