<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Statuses extends Model
{
    use HasFactory;
    protected  $fillable = ['status_name'];

    public function tasks(){
        return $this->hasMany(Task::class);
    }


}
