<?php

namespace Ansta\LaraCms\Controllers\Admin;

use Ansta\LaraCms\Controllers\Controller;
use Ansta\LaraCms\Models\Site;
use App\User;
use Carbon\Carbon;
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
        //'config' => 'required',
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

        $options = $request->all();
        $options['available_at'] = Carbon::now();

        $page = $site->pages()->create($options);

        if (isset($options['components']) && is_array($options['components'])) {
            //TODO child creation
            $page->components()->createMany($options['components']);
        }

        return response()->json($page);
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

        //need to update components

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
