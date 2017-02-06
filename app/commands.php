<?php
namespace App;

use App\Command\CrudCommand;
use App\Command\DBCommand;
use App\Command\FtpCommand;
use App\Command\GenCommand;
use App\Command\GruntCommand;
use App\Command\MailCommand;

return [
    GruntCommand::class,
    CrudCommand::class,
    MailCommand::class,
    FtpCommand::class,
    DBCommand::class,
    GenCommand::class
];