<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin\Author;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use ChickenTikkaMasala\LaraCms\Models\Author;
use ChickenTikkaMasala\LaraCms\Models\Image;
use Illuminate\Http\Request;

/**
 * Class ImageController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Admin\Author
 */
class ImageController extends Controller
{
    public $rules = [

    ];

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(\Auth::user()->images()->paginate(10));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Image::class);
        $this->validate($request->all(), $this->rules);

        $image = \Auth::user()->images()->create($request->all());

        if ($request->has('set_default') && $request->set_default == 1) {
            $user = $this->setDefault(\Auth::user(), $image);
            return respnse()->json([
                'user' => $user,
                'image' => $image,
            ]);
        }

        return response()->json([
            'image' => $image,
        ]);
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Image $image)
    {
        $this->authorize('edit', Image::class);
        $this->validate($request->all(), $this->rules);

        $image->update($request->all());

        if ($request->has('set_default') && $request->set_default == 1) {
            $user = $this->setDefault(\Auth::user(), $image);
            return respnse()->json([
                'user' => $user,
                'image' => $image,
            ]);
        }

        return response()->json([
            'image' => $image,
        ]);
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return mixed
     */
    public function setDefaultImage(Request $request, Image $image)
    {
        $this->authorize('edit', Image::class);

        $user = $this->setDefault(\Auth::user(), $image);

        return respnse()->json([
            'user' => $user,
            'image' => $image,
        ]);
    }

    /**
     * @param Author $author
     * @param Image $image
     */
    protected function setDefault(Author $author, Image $image)
    {
        $author->default_image_id = $image->id;
        $author->save();
        return $author;
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     */
    protected function destroy(Request $request, Image $image)
    {
        $this->authorize('destroy', Image::class);

        $user = \Auth::user();

        if (\Auth::user()->default_image_id == $image->id) {
            $user->default_image_id = 0;
            $user->save();
        }

        $image->destroy();

        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    }

}
