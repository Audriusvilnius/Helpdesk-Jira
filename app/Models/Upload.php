<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'upload_user_id',
        'upload_dir',
        'upload_file',
    ];

    public function deleteFile()
    {
        $fileName = $this->file;
        $fileDir = $this->dir;

        if (file_exists(public_path() . $fileDir . '/' . $fileName)) {
            unlink(public_path() . $fileDir . '/' .  $fileName);
        }
        $this->save();
    }
}
