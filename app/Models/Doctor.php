<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Doctor extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    // protected $fillable = [
    //     'poly_id',
    //     'status',
    //     'id_user'
    // ];

    protected $guarded = ['id'];
    protected $with = ['poly'];

    public function poly()
    {
        return $this->belongsTo(Poly::class, 'poly_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
