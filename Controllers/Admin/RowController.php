<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin;

use ChickenTikkaMasala\LaraCms\Controllers\Controller;
use ChickenTikkaMasala\LaraCms\Models\Page;
use ChickenTikkaMasala\LaraCms\Models\Row;
use Illuminate\Http\Request;

/**
 * Class RowController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Admin
 */
class RowController extends Controller
{
    public $rules = [
        'position' => 'required|integer',
    ];

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Page $page)
    {
        $rows = $page->rows()->paginate(10);

        return response()->json($rows);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Page $page)
    {
        $this->authorize('create', Row::class);

        $this->validate($request->all(), $this->rules);

        $row = $page->rows()->create($request->all());

        return response()->json($row);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Page $page, Row $row)
    {
        $this->authorize('update', Row::class);

        $this->validate($request->all(), $this->rules);

        $row->update($request->all());

        return response()->json($row);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Page $page, Row $row)
    {
        $this->authorize('destroy', Row::class);

        $row->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
