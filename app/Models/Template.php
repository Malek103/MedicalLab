<?php

namespace App\Models;

use App\Models\LabSchedule;
use App\Models\Template_Item;
use App\Models\PatientExamination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function lab()
    {
        $this->belongsTo(LabSchedule::class);
    }

    public function template_items()
    {
        $this->hasMany(Template_Item::class);
    }
    public function patientExamination()
    {
        return $this->hasMany(PatientExamination::class, );
    }
}
