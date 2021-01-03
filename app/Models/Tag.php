<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Tag extends Model
{
    use HasFactory;

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
