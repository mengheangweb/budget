<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";
    protected $fillable = [
        'category_id',
        'date',
        'description',
        'amount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
