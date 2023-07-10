<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;
    protected $fillable = [
        'share_ticket_id',
        'share_user_id',
    ];

    public function shareUser()
    {
        return $this->belongsTo(User::class, 'share_user_id', 'id');
    }
    public function shareTicket()
    {
        return $this->belongsTo(Ticket::class, 'share_ticket_id', 'id');
    }
}
