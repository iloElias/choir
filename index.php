<?php

error_reporting(E_ERROR | E_PARSE);

use Ilias\PhpHttpRequestHandler\Bootstrap\Handler;

require_once("./vendor/autoload.php");

Handler::handle();