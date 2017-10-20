<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'work';


    public function getAllByUser($userId)
    {
        $this->where('userId', $userId)->get()->toArray();
    }

}
