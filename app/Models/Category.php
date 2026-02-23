<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'image', 'description'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
