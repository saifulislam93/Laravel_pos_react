<?php

namespace App\Models\Purchases;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase_details extends Model
{
    use HasFactory,SoftDeletes;
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
