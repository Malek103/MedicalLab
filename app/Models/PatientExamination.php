<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Template;
use App\Models\TestResult;
use App\Models\TechnicianLab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientExamination extends Model
{
    use HasFactory;
    protected $table = "patient_examinations";
    protected $guarded = [];
    // protected $fillable = ['created_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function TechnicianLab()
    {
        return $this->belongsTo(TechnicianLab::class, 'TID', 'TID');
    }
    public function template()
    {
        return $this->belongsTo(Template::class,);
    }
    public function testResult()
    {
        return $this->hasMany(TestResult::class);
    }
}
