<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'truck_id', 'driver_id', 'is_completed'];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
