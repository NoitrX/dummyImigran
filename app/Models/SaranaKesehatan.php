<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaranaKesehatan extends Model
{
    use HasFactory;
    protected $table = 'sarana_kesehatan';
    protected $guarded = [];


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
}
