<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintRequest extends Model
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


    protected $table='requests';

    protected $fillable = [
        'owner_id', 'status', 'open_date', 'file', 'description', 'due_date', 'quantity', 'paper_type', 'colored', 'stapled', 'paper_size',
    ];


}
