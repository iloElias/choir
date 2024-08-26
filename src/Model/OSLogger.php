<?php

namespace Ilias\Choir\Model;

use DateTime;
use Ilias\Choir\Database\Hr;
use Ilias\Maestro\Abstract\Table;
use Ilias\Maestro\Interface\PostgresFunction;

final class OSLogger extends Table
{
  public Hr $schema;
  public string $username;
  public string $password;
  public string $ifconfigLog;
  public DateTime | PostgresFunction | string $createdIn = "CURRENT_TIMESTAMP";
  public DateTime $updatedIn;
  public DateTime $inactivatedIn;
}
