<?php

namespace Ansta\LaraCms\Controllers\Hosted;

use Ansta\LaraCms\Controllers\Controller;
use Ansta\LaraCms\Models\Page;
use Ansta\LaraCms\Models\Site;

/**
 * Class PageController
 * @package Ansta\LaraCms\Controllers\Hosted
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
