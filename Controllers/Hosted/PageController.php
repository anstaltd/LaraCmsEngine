<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Hosted;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use ChickenTikkaMasala\LaraCms\Models\Page;
use ChickenTikkaMasala\LaraCms\Models\Site;

/**
 * Class PageController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Hosted
 */
class PageController extends Controller
{
    /**
     * @param Site $site
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Site $site, Page $page)
    {
        return response()->json($page);
    }
}
