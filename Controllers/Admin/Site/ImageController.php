<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin\Site;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use ChickenTikkaMasala\LaraCms\Models\Image;
use ChickenTikkaMasala\LaraCms\Models\Site;
use Illuminate\Http\Request;

/**
 * Class ImageController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Admin
 */
class ImageController extends Controller
{
    /**
     * @var array
     */
    public $rules = [
        'image' => 'required',
    ];

    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Site $site)
    {
        $images = $site->images();

        if ($request->has('search')) {
            $images->where('title', 'like', '%'.$request->search.'%');
        }

        return response()->json($images->paginate(10));
    }

    /**
     * @param Site $site
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Site $site, Image $image)
    {
        return response()->json($image);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Site $site, Image $image)
    {
        $this->authorize('edit', Site::class);

        $this->validate($request, $this->rules);

        $image->update($request->all());

        return response()->json($image);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Site $site)
    {
        $this->authorize('create', Site::class);

        $this->validate($request, $this->rules);

        $image = $site->images()
            ->create($request->all());

        return response()->json($image);
    }

    /**
     * @param Request $request
     * @param Site $site
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Site $site, Image $image)
    {
        $this->authorize('destroy', Site::class);

        $image->destroy();

        return response()->json([
            'success' => true,
        ]);
    }

}
