<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'evaluation_5s', 'evaluation_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}