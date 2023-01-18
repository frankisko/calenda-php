<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = "types";

    protected $primaryKey = 'id_type';

    protected $fillable = [
        "name",
        "color",
        "duration",
        "status"
    ];

    public const DURATIONS = ["P" => "Permanent", "O" => "Once"];
    public const STATUSES = ["A" => "Active", "I" => "Inactive"];

    public function duration() {
        return self::DURATIONS[$this->duration];
    }

    public function status() {
        return self::STATUSES[$this->status];
    }
}
