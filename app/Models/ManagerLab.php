<?php

namespace App\Models;

use App\Models\User;
use App\Models\Patient;
use App\Models\LabSchedule;
use App\Models\TechnicianLab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagerLab extends Model
{

    protected $table = "manager_labs";
    protected $guarded = [];
    use HasFactory;
    public function LabSchedule()
    {
        return $this->hasMany(LabSchedule::class, 'MID', 'id');
    }
    public function technicians()
    {
        return $this->belongsToMany(TechnicianLab::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'ACNO', 'id');
    }

}
