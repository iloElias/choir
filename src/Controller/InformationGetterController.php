<?php

namespace Ilias\Choir\Controller;

use Ilias\Choir\Model\OSLogger;
use Ilias\Maestro\Core\Manager;
use Ilias\Maestro\Database\Insert;
use Ilias\Maestro\Database\PDOConnection;
use Ilias\Opherator\Request\Request;

class InformationGetterController
{
  public function setUbuntu()
  {
    $requestData = Request::getBody();
    $oslogger = new OSLogger();
    $oslogger->ifconfigLog = $requestData['ifconfigLog'];
    $oslogger->username = $requestData['username'];
    $oslogger->password = $requestData['password'];

    $insert = new Insert();
    $insert->into('oslogger')
      ->values($oslogger);
    $manager = new Manager();
    $manager->executeQuery(PDOConnection::getInstance(), $insert->getSql());
  }
}