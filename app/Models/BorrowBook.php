<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    use HasFactory;

    protected $table = 't_peminjaman';
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    protected $guarded = ['f_id'];

    public function getRouteKeyName()
    {
        return 'f_id';
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'f_idadmin', 'f_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'f_idanggota', 'f_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasOne(BorrowBookDetail::class, 'f_idpeminjaman', 'f_id');
    }
}
