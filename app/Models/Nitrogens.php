<?php

namespace ACA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nitrogens extends Model
{
    use SoftDeletes;
    protected $table = 'nitrogens';
}
