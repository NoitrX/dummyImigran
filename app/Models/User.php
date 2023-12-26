<?php

namespace App\Models;

use App\Models\SaranaKesehatan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded= [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
{
    parent::boot();
    
    static::creating(function ($coa) {
        $user = Auth::user();
        $coa->created_by = $user ? $user->id : 1;
    });

    static::updating(function ($coa) {
        $user = Auth::user();
        $coa->updated_by = $user ? $user->id : 1;
    });
}


        public function createdByUser() {
        return $this->belongsTo(Admin::class, 'created_by');
        }
            public function updatedByUser(){
        return $this->belongsTo(Admin::class, 'updated_by');
        }

        public function saranaKesehatan()
        {
            return $this->belongsTo(SaranaKesehatan::class, 'data_medical_id');
        }
    
}
