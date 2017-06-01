<?php

namespace ChickenTikkaMasala\LaraCms\Controllers\Admin\Auth;


/**
 * Class LoginController
 * @package ChickenTikkaMasala\LaraCms\Controllers\Admin\Auth
 */
class LoginController extends \ChickenTikkaMasala\LaraCms\Controllers\Auth\LoginController
{
    /**
     * @var string
     */
    public $guard = 'author';
}
