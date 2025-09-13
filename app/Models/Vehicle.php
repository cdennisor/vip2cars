<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['plate','brand','model','manufacturing_year','id_client'];

    public function client():BelongsTo{
        return $this->belongsTo(Client::class, 'id_client');
    }
}
