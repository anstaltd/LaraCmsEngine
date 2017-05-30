<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Hosted;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;

class PageController extends Controller
{
    public function index(Site $site, Page $page)
    {
        return response()->json($page);
    }
}
