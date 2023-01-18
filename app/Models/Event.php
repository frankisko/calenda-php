<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";

    protected $primaryKey = 'id_event';

    protected $fillable = [
        "name",
        "description",
        "date",
        "status",
        "id_type"
    ];

    protected $dates = ["date"];

    public function type() {
        return $this->hasOne(Type::class, 'id_type', 'id_type');
    }
}
