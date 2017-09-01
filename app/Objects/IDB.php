<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class IDB extends Model
{
    protected $guarded = [''];

  /**
   * [fetch description]
   * @param  [string] $column [temporary column name]
   * @param  [string] $key    [value to find in table]
   * @return [object]         [object]
   */
    public function fetch($column, $key)
    {
        $this->primaryKey = $column;
        return $this->find($key);
    }
}
