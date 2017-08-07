<?php

namespace Ansta\LaraCms\Controllers\Admin;

use Ansta\LaraCms\Controllers\Controller;
use Ansta\LaraCms\Models\Column;
use Ansta\LaraCms\Models\Page;
use Ansta\LaraCms\Models\Row;
use Illuminate\Http\Request;

/**
 * Class ColumnController
 * @package Ansta\LaraCms\Controllers\Admin
 */
class ColumnController extends Controller
{
    public $rules = [
        'position' => 'required|integer',
    ];

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, Page $page, Row $row)
    {
        $columns = $row->columns()->paginate(10);

        return response()->json($columns);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Page $page, Row $row)
    {
        $this->authorize('create', Column::class);

        $this->validate($request->all(), $this->rules);

        $column = $row->columns()->create($request->all());

        return response()->json($column);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @param Column $column
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Page $page, Row $row, Column $column)
    {
        $this->authorize('update', Column::class);

        $this->validate($request->all(), $this->rules);

        $column->update($request->all());

        return response()->json($column);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @param Row $row
     * @param Column $column
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, Page $page, Row $row, Column $column)
    {
        $this->authorize('destroy', Column::class);

        $row->destroy();

        return response()->json([
            'success' => true,
        ]);
    }
}
