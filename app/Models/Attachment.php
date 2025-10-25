<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'attachment_type',
        'attachment_format',
        'task_id',


    ];
    public function  task(){
        return $this->belongsTo(Task::class);


    }


}
