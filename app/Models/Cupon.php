<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    public function findByCode($code)
    {
        return Cupon::where('code', $code)->first();
    }

    public function discount($total)
    {
        if($this->type == 'fixed'){
            return $this->value;
        }elseif($this->type == 'percent'){
            return ($this->percent_off / 100) * $total;
        }else{
            return 0;
        }
    }
}
