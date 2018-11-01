<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outgoing extends Model
{
    protected $table = 'outgoings';
    protected $fillable = ['id','send_to','text','sender','batch_id','creator_id','created_at','updated_at'];
      protected $primaryKey='id';
}
