<?php

error_reporting(E_ERROR | E_PARSE);

use Ilias\PhpHttpRequestHandler\Bootstrap\Core;

require_once("./vendor/autoload.php");

Core::handle();