<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = "t_anggota";
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    protected $guarded = ['f_id'];

    public function getRouteKeyName()
    {
        return 'f_id';
    }

    public function peminjaman()
    {
        return $this->hasMany(BorrowBook::class, 'f_idanggota', 'f_id');
    }
}
