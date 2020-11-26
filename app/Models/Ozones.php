<?php

namespace ACA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ozones extends Model
{
    use SoftDeletes;
    protected $table = 'ozones';
}
