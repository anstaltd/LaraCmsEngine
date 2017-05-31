<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use ChickenTikkaMasala\LaraCms\Models\Author;
use ChickenTikkaMasala\LaraCms\Models\Site;
use Illuminate\Http\Request;

/**
 * Class AuthorController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Admin
 */
class AuthorController extends Controller
{
    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Site $site)
    {
        $authors = $site->authors();

        if ($request->has('search')) {
            $authors->where(function($query) use ($request) {
                $text = '%'.$request->search.'%';
                return $query->where('firstname', 'like', $text)
                    ->orWhere('lastname', 'like', $text)
                    ->orWhere('email', 'like', $text);
            });
        }

        return response()->json($authors->paginate(10));
    }

    /**
     * @param Site $site
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Site $site, Author $author)
    {
        return response()->json($author);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site, Author $author)
    {
        $this->authorize('edit', Author::class);

        $this->validate($request, $this->rules);

        $author->update($request->all());

        return response()->json($author);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Site $site)
    {
        $this->authorize('create', Author::class);

        $this->validate($request, $this->rules);

        $author = $site->authors()->create($request->all());

        return response()->json($author);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Site $site, Author $author)
    {
        $this->authorize('destroy', Author::class);

        $author->destroy();

        return response()->json([
            'success' => true,
        ]);
    }

}
