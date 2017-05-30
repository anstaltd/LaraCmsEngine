<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use Illuminate\Http\Request;
use ChickenTikkaMasala\LaraCms\Models\Page;

class PageController extends Controller
{
    public function index(Site $site)
    {
        $pages = $site->pages();

        if ($request->has('search')) {
            $pages->where('title', 'like', '%'.$request->search.'%');
        }

        $pages = $pages->paginate(10);

        return response()->json($pages);
    }

    public function store(Request $request, Site $site)
    {
        $this->validate($request, $this->rules);

        $page = $site->pages()->create($request->all());

        return resonse()->json($page);
    }

    public function show(Site $site, Page $page)
    {
        return response()->json($page);
    }

    public function update(Request $request, Site $site, Page $page)
    {
        $this->validate($request, $this->rules);

        $page->update($request->all());

        return resonse()->json($page);
    }

    public function destroy(Site $site, Page $page)
    {
        $page->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
