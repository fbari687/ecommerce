<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 't_buku';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'f_id';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'f_idkategori', 'f_id');
    }

    public function detail()
    {
        return $this->hasOne(BookDetail::class, 'f_idbuku', 'f_id');
    }
}
