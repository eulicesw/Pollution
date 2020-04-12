<?php

namespace ACA;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Particle extends Model
{
    use SoftDeletes;
    protected $table = 'particles';
}
