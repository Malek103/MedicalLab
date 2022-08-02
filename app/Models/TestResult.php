<?php

namespace App\Models;

use App\Models\PatientExamination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestResult extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function patient_examination(){
        return $this->belongsTo(PatientExamination::class);
    }
}
