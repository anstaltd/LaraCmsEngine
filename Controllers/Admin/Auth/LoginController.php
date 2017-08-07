<?php

namespace Ansta\LaraCms\Controllers\Admin\Auth;


/**
 * Class LoginController
 * @package Ansta\LaraCms\Controllers\Admin\Auth
 */
class LoginController extends \Ansta\LaraCms\Controllers\Auth\LoginController
{
    /**
     * @var string
     */
    public $guard = 'author';
}
