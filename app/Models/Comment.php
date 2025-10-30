<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected  $fillable = [
        'comment_text',
        'user_id',
        'project_id'

    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

  public function task(){
        return $this->belongsTo(Task::class);
  }
public function project()
    {
        return $this->belongsTo(Project::class);
    }














}
