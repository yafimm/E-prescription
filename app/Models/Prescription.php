<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class Prescription extends Model
{
    use HasFactory;

    protected $table = 'prescriptions';

    protected $fillable = [
        'id', 'code', 'created_by'
    ];

    // Observer
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
           $model->code = HelperSetPrescriptionCode();
           $model->user_id = Auth::user()->id;
        });
    }

    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
