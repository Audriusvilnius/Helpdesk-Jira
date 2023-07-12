<?php

namespace App\Models;

use App\Mail\ContactMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'subject',
        'message'
    ];
    // public $fillable = ['name', 'email', 'phone', 'subject', 'message'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot()
    {

        parent::boot();

        static::created(function ($item) {

            $adminEmail = "audrius@ivko.org";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}
