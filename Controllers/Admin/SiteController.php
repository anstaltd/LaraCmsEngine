<?php

namespace Ansta\LaraCms\Controllers\Admin;

use Ansta\LaraCms\Controllers\Controller;
use Ansta\LaraCms\Models\Site;
use Illuminate\Http\Request;

/**
 * Class SiteController
 * @package Ansta\LaraCms\Controllers\Admin
 */
class SiteController extends Controller
{
    /**
     * @var array
     */
    public $rules = [
        'title' => 'required',
        'domain' => 'required',
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $sites = \Auth::user()->sites();

        if ($request->has('search')) {
            $sites->where(function($query) use($request) {
                $text = '%'.$request->search.'%';
                return $query->where('title', 'like', $text)
                    ->orWhere('domain', 'like', $text);
            });
        }

        return response()->json($sites->paginate(10));
    }

    /**
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Site $site)
    {
        return response()->json($site);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Site::class);

        $this->validate($request, $this->rules);

        $site = \Auth::sites()->create($request->all());

        return response()->json($site);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site)
    {
        $this->authorize('edit', Site::class);

        $this->validate($request, $this->rules);

        $site->update($request->all());

        return response()->json($site);
    }

    /**
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Site $site)
    {
        $this->authorize('destroy', Site::class);

        $site->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
