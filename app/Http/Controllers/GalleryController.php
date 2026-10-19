<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Services\ListServices\GalleryListService;
use EscuelaIT\APIKit\ResourceListable;

class GalleryController extends Controller
{
    use ResourceListable;

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

    /**
     * List user galleries with API Kit.
     */
    public function listGalleries(GalleryListService $service)
    {
        return $this->list($service);
    }
}
