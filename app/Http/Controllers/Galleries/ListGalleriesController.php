<?php

namespace App\Http\Controllers\Galleries;

use App\Http\Controllers\Controller;
use App\Services\ListServices\GalleryListService;
use EscuelaIT\APIKit\ResourceListable;

class ListGalleriesController extends Controller
{
    use ResourceListable;

    public function __invoke(GalleryListService $service)
    {
        return $this->list($service);
    }
}
