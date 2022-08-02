<?php

namespace App\Models;

use App\Models\Template;
use App\Models\ManagerLab;
use App\Models\TechnicianLab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabSchedule extends Model
{
    protected $primaryKey = 'LID';
    protected $table = "lab_schedule";
    protected $guarded = [];
    use HasFactory;
    public function ManagerLab()
    {
        return $this->belongsTo(ManagerLab::class, 'MID', 'id');
    }
    public function technicians()
    {
        return $this->belongsToMany(TechnicianLab::class);
    }



    // safa
    public function templates (){
        $this->hasMany(Template::class);
    }

}
