<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 't_kategori';
    protected $primaryKey = 'f_id';
    protected $guarded = ['f_id'];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'f_id';
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'f_idkategori', 'f_id');
    }
}
