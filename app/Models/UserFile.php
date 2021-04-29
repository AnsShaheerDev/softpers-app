<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
	use HasFactory;

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
    protected $guarded = [];

   /*
    * Relationships
    *
    */
   public function data()
   {
   	 return $this->hasMany(UserFileData::class);
   }
}
