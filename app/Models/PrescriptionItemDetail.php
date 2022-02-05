<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItemDetail extends Model
{
    use HasFactory;

    protected $table = 'prescription_item_details';

    public $timestamps = false;

    protected $fillable = [
        'prescription_item_id', 'obatalkes_id', 'qty'
    ];

    public function presciption()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function presciption_item_detail()
    {
        return $this->hasMany(PrescriptionItemDetail::class);
    }
}
