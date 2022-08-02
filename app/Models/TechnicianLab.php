<?php

namespace App\Models;

use App\Models\User;
use App\Models\ManagerLab;
use App\Models\LabSchedule;
use App\Models\PatientExamination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnicianLab extends Model
{
    use HasFactory;
    protected $table = "technician_labs";
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'ACNO', 'id');
    }
    public function labs(){
        return $this->belongsToMany(LabSchedule::class);
    }
    // public function manager()
    // {
    //     return $this->belongsTo(ManagerLab::class);
    // }
    public function patient_examinations()
    {
        return $this->hasMany(PatientExamination::class, 'TID', 'TID');
    }
    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
}
