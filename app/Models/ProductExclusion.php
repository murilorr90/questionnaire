<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExclusion extends Model
{
    use HasFactory;

    protected $fillable = ['answer_id', 'product_id'];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
