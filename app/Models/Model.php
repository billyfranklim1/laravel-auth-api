<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;

class Model extends BaseModel
{
    protected $dateFormat = 'd-m-Y H:i:s';
}
