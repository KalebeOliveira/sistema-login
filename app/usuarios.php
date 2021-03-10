<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    // alterando o nome da Primary Key
    protected $primaryKey = 'id_usuario';
}
