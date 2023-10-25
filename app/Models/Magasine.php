<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magasine extends Model
{
    use HasFactory;
    protected $fillable=['name','picture','adress','contact','slug'];

    public function provider(){
        return $this->hasMany(Provider::class);
    }
}
