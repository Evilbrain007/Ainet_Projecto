<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    private $id;
    private $ownerId;
    private $status;
    private $openDate;
    private $dueDate;
    private $description;
    private $quantity;
    private $colored;   // boolean
    private $stapled;   // boolean
    private $paperSize;
    private $paperType;
    private $file;
    private $printerID;
    private $closedDate;
    private $closedUser;
    private $refusedReason;
    private $satisfactionGrade;
}
