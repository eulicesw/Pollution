<?php

namespace ACA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monoxide extends Model
{
    use SoftDeletes;
    protected $table = 'monoxides';
}
