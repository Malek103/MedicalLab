<?php

namespace App\Models;

use App\Models\User;
use App\Models\ManagerLab;
use App\Models\TechnicianLab;
use App\Models\PatientExamination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    protected $guarded = [];

    public function patient_examinations()
    {
        return $this->hasMany(PatientExamination::class,);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'ACNO', 'id');
    }

    public function technician()
    {
        return $this->belongsTo(TechnicianLab::class);
    }

}
