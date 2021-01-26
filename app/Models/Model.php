<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

/***
 * Class Model
 * @mixin \Eloquent
 * @package App\Models
 */
class Model extends Eloquent
{
    use HasFactory;

    protected $guarded = [];
}
