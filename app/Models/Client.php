<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Psy\CodeCleaner\ReturnTypePass;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','last_name','document_number','email','phone'];
    //

    public function getFullNameAttribute(){
        return "{$this->name}, {$this->last_name}";
    }

    public function vehicles():HasMany{
        return $this->hasMany(Vehicle::class);
    }
}
