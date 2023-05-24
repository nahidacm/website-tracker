<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TrackEventJob;


class TrackingController extends Controller
{
    public function track(Request $request)
    {
        $trackingData = $request->all();
        dispatch(new TrackEventJob($trackingData));

        // Generate a 1x1 pixel transparent GIF image response
        $imageData = base64_decode('R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=');

        // Return image response
        return response($imageData)->header('Content-Type', 'image/gif');
    }
}
