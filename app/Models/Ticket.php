<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message_json',
        'important_id',
        'user_id',
        'status_id',
        'user_name',
    ];

    public function ticketsImportant()
    {
        return $this->belongsTo(Important::class, 'important_id', 'id');
    }
}
