<?php

namespace ACA\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElementConfiguration extends Model
{
    use SoftDeletes;
    protected $table = 'elements_configuration';
}
