<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importsm extends Model
{
	 protected $table = 'importsms';
    protected $fillable = ['id','send_to','text','sender','batch_id','status','creator_id','created_at','updated_at'];
      protected $primaryKey='id';
    
}
