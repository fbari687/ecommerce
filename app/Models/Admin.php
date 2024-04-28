<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = "t_admin";
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    protected $guarded = ['f_id'];

    public function getRouteKeyName()
    {
        return 'f_id';
    }
}
