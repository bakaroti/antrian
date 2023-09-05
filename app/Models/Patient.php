<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Patient extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    // protected $fillable = [
    //     'poly_id',
    //     'initial_poli',
    //     'queue_number'
    // ];

    protected $guarded = ['id'];

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'poly_initial', 'initial');
    }
}
