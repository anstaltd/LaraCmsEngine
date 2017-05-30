<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $sites = Auth::user()->sites();

        if ($request->has('search')) {
            $sites->where(function($query) use($request) {
                $text = '%'.$request->search.'%';
                return $query->where('title', 'like', $text)
                    ->orWhere('domain', 'like', $text);
            });
        }

        return response()->json($sites->paginate(10));
    }

    public function show(Site $site)
    {
        return response()->json($site);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $site = \Auth::sites()->create($request->all());

        return response()->json($site);
    }

    public function update(Request $request, Site $site)
    {
        $this->validate($request, $this->rules);

        $site->update($request->all());

        return response()->json($site);
    }

    public function destroy(Site $site)
    {
        $site->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
