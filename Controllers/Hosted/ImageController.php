<?php
namespace Ansta\LaraCms\Controllers\Hosted;

use Ansta\LaraCms\Controllers\Controller;
use League\Glide\Server;

/**
 * Class ImageController
 * @package App\Http\Controllers
 */
class ImageController extends Controller {

    /**
     * @param Server $server
     * @param $path
     * @return mixed
     */
    public function show(Server $server, $path)
    {
        return $server->getImageResponse($path, request()->all());
    }

}
