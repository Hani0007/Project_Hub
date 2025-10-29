<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_name',
        'task_description',
        'user_id',
        'project_id',
        'status_id',
        'comment_id',
        ];

public function project(){
    return $this->belongsTo(Project::class);
}

public function status(){
    return $this->belongsTo(Statuses::class);
}

public function comment(){
    return $this->hasMany(Comment::class);
}

 public function attachment(){
    return $this->hasMany(Attachment::class);
 }
}
