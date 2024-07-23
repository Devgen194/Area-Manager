<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $fillable = ['name', 'description', 'coordinates', 'start_date', 'end_date', 'display_in_breach_list', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

