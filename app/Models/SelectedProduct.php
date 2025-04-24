<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_session', 'user_email', 'quantity', 'is_checked_out'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeNotCheckedOut($query)
    {
        return $query->where('is_checked_out', false);
    }
}