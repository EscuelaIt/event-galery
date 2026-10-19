<?php

namespace App\Http\Controllers\Galleries;

use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the user's galleries.
     */
    public function index()
    {
        $galleries = Gallery::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('Gallery', [
            'galleries' => GalleryResource::collection($galleries)->resolve(),
        ]);
    }
}
