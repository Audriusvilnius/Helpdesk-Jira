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
        'request',
        // 'upload',
    ];

    public function ticketsImportant()
    {
        return $this->belongsTo(Important::class, 'important_id', 'id');
    }
    public function ticketsStatus()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function ticketsUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function upload_File()
    {
        return $this->hasMany(Upload::class, 'upload_ticket_id', 'id');
    }
    public function share_User()
    {
        return $this->hasMany(Share::class, 'share_ticket_id', 'id');
    }
}
