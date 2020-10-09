<?php

// Process URL from browser
require_once "./mvc/core/App.php";

// How controllers call Views & Models
require_once "./mvc/core/Controller.php";

// Connect Database
require_once "./mvc/core/DB.php";

require_once './mvc/core/config.php';
// Function 'helpers'
require_once "./mvc/core/helper.php";
    $helpers = new helpers;
// Class helper by provider
require_once './provider/mvc/core/helper.php';
    $helper = new helper;