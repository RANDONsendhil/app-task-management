<?php

require_once(BASE_PATH . '/config/utils.php');
require_once(BASE_PATH . '/taskComponent/controller/controllerTask.php');
require_once(BASE_PATH . '/taskComponent/model/task.php');
require_once(BASE_PATH . '/taskComponent/model/taskObj.php');


$currentDir = dirname($_SERVER['PHP_SELF']);



class IndexTask
{
    private $controllerTask;
    private $utils;
    public function __construct()
    {
        $this->controllerTask = new ControllerTask();

        $this->utils = new Utils("");
    }
}

new IndexTask();
