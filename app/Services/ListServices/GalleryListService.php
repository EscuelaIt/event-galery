<?php

namespace App\Services\ListServices;

use App\Models\Gallery;
use EscuelaIT\APIKit\ListService;
use Illuminate\Support\Facades\Auth;

class GalleryListService extends ListService
{
    protected string $listModel = Gallery::class;

    protected function createQuery()
    {
        return $this->listModel::query()
            ->where('user_id', Auth::id());
    }
}
