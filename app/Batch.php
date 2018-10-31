<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $table = 'batches';
    protected $fillable = ['id','number','max_count','valid_from','valid_till','status','description','created_at','updated_at'];
      protected $primaryKey='id';
}
