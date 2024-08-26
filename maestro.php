<?php
use Ilias\Maestro\Core\Manager;
use SebastianBergmann\CodeCoverage\Report\PHP;

require_once 'vendor/autoload.php';

$manager = new Manager();
$choirDB = new Ilias\Choir\Database\ChoirDB();

echo implode("\n", $manager->createDatabase($choirDB)) . PHP_EOL;
