<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function imageable()
    {
        return $this->hasMany(Imageable::class);    
    }
}
