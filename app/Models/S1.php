<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S1 extends Model
{ 
    use HasFactory;

    protected $guarded = [];

    public static function createOrUpdate($id, $value)
    {
        try {
            
            DB::beginTransaction();

              // Row
              $row           = (isset($id)) ? self::findOrFail($id) : new self;
              $row->title    = $value['title'] ?? NULL;
              $row->artist   = $value['artist'] ?? NULL;
              $row->year     = $value['year'] ?? NULL;
              $row->comments = $value['comments'] ?? NULL;
              $row->save();

              //


            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
