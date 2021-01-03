<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Tag;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
