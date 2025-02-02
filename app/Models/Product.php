<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uid', 'size'];

    protected $hidden = ['created_at', 'updated_at'];

    public function productExclusions()
    {
        return $this->hasMany(ProductExclusion::class);
    }
}
