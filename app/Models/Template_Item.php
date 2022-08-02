<?php

namespace App\Models;

use App\Models\Template;
use App\Models\LabSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template_Item extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function template(){
        $this->belongsTo(Template::class);
    }
}
