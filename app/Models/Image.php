<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'imagepath',
    ];

    /**
     *  Relationship with Item model
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
