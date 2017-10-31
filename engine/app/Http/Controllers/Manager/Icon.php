<?php

namespace RecycleArt\Http\Controllers\Manager;

/**
 * Class Icon
 * @package RecycleArt\Http\Controllers\Manager
 */
class Icon extends ManagerController
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function list()
    {
        return 1;
    }
}
