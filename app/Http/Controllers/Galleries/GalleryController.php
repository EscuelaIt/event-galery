<?php

namespace App\Http\Controllers\Galleries;

use App\Http\Controllers\Controller;
use Inertia\Response;

class GalleryController extends Controller
{
    /**
     * Display the gallery page. The listing is loaded by the frontend from the API.
     */
    public function index(): Response
    {
        return inertia('Gallery');
    }
}
