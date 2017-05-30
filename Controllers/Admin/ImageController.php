<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(Request $request, Site $site)
    {
        $images = $site->images();

        if ($request->has('search')) {
            $images->where('title', 'like', '%'.$request->search.'%');
        }

        return response()->json($images->paginate(10));
    }

    public function show(Site $site, Image $image)
    {
        return response()->json($image);
    }

    public function update(Request $request, Site $site, Image $image)
    {
        $this->validate($request, $this->rules);

        $image->update($request->all());

        return response()->json($image);
    }

    public function store(Request $request, Site $site)
    {
        $this->validate($request, $this->rules);

        $image = $site->authors()->create($request->all());

        return response()->json($image);
    }

    public function destroy(Request $request, Site $site, Image $image)
    {
        $image->destroy();

        return response()->json([
            'success' => true,
        ]);
    }

}
