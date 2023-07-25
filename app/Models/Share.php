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
        'share_status_id',
        'share_important_id',
    ];

    public function shareUser()
    {
        return $this->belongsTo(User::class, 'share_user_id', 'id');
    }
    public function shareTicket()
    {
        return $this->belongsTo(Ticket::class, 'share_ticket_id', 'id');
    }
    public function shareImportant()
    {
        return $this->belongsTo(Important::class, 'share_important_id', 'id');
    }
    public function shareStatus()
    {
        return $this->belongsTo(Status::class, 'share_status_id', 'id');
    }
    public function upload_User_File()
    {
        return $this->hasMany(Upload::class, 'upload_ticket_id', 'share_ticket_id');
    }
    public function share_User_User()
    {
        return $this->hasMany(Share::class, 'share_ticket_id', 'id');
    }
}
