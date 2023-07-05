<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Important extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'important_color_text',
        'importanr_color_back',
    ];
    // public function importantTicket()
    // {
    //     return $this->hasMany(Ticket::class, 'important_id', 'id');
    // }
}
