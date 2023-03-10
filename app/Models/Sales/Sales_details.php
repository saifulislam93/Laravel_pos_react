<?php

namespace App\Models\Sales;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_details extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
