<?php

namespace Ansta\LaraCms\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function user()
    {
        return \Auth::user();
    }
}
