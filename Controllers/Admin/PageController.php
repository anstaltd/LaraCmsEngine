<?php

namespace Ansta\LaraCms\Controllers\Admin;

use Ansta\LaraCms\Controllers\Controller;
use Ansta\LaraCms\Models\Site;
use Illuminate\Http\Request;
use Ansta\LaraCms\Models\Page;

/**
 * Class PageController
 * @package Ansta\LaraCms\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * @var array
     */
    public $rules = [
        'title' => 'required',
    ];

    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Site $site)
    {
        $pages = $site->pages();

        if ($request->has('search')) {
            $pages->where('title', 'like', '%'.$request->search.'%');
        }

        $pages = $pages->paginate(10);

        return response()->json($pages);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @return mixed
     */
    public function store(Request $request, Site $site)
    {
        $this->authorize('create', Page::class);

        $this->validate($request, $this->rules);

        $page = $site->pages()->create($request->all());

        return resonse()->json($page);
    }

    /**
     * @param Site $site
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Site $site, Page $page)
    {
        return response()->json($page);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @param Page $page
     * @return mixed
     */
    public function update(Request $request, Site $site, Page $page)
    {
        $this->authorize('edit', Page::class);

        $this->validate($request, $this->rules);

        $page->update($request->all());

        return resonse()->json($page);
    }

    /**
     * @param Site $site
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site, Page $page)
    {
        $this->authorize('destroy', Page::class);

        $page->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
