<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;

    protected $fillable=['slug','item_id','provider_id','quantity','price'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
