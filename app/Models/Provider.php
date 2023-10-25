<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable =['slug','magasine_id','name','contact'];

    public function magasine(){
        return $this->belongsTo(Magasine::class);
    }

    public function restock() {
        return $this->hasMany(Restock::class);
    }
}
