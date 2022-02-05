<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $table = 'prescription_items';

    protected $fillable = [
        'prescription_id', 'signa_id', 'name', 'qty', 'type'
    ];

    public function presciption()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function prescription_item_detail()
    {
        return $this->hasMany(PrescriptionItemDetail::class);
    }

    public function signa()
    {
        return $this->belongsTo(Signa::class, 'signa_id', 'signa_id');
    }
}
