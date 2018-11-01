<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class send extends Model
{
    protected $table = 'sends';
    protected $fillable = ['id','send_to','text','sender','batch_id','creator_id','created_at','updated_at'];
      protected $primaryKey='id';
}
