<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBookDetail extends Model
{
    use HasFactory;
    protected $table = 't_detailpeminjaman';
    protected $primaryKey = 'f_id';
    public $timestamps = false;
    protected $guarded = ['f_id'];

    public function getRouteKeyName()
    {
        return 'f_id';
    }

    public function detailBook()
    {
        return $this->belongsTo(BookDetail::class, 'f_iddetailbuku', 'f_id');
    }
}
