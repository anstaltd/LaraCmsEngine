<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
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

    public function show(Site $site, Author $author)
    {
        return response()->json($author);
    }

    public function update(Request $request, Site $site, Author $author)
    {
        $this->validate($request, $this->rules);

        $author->update($request->all());

        return response()->json($author);
    }

    public function store(Request $request, Site $site)
    {
        $this->validate($request, $this->rules);

        $author = $site->authors()->create($request->all());

        return response()->json($author);
    }

    public function destroy(Request $request, Site $site, Author $author)
    {
        $author->destroy();

        return response()->json([
            'success' => true,
        ]);
    }

}
