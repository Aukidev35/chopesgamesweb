<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleNouvelles extends Model
{
    protected $table = 'newsletter';
    protected $allowedFields = ['NONEWSLETTER', 'OBJET', 'TITRE', 'MESSAGE'];
    protected $primaryKey = 'NONEWSLETTER';

    public function nouvelle($id =1)
    {
        return $this->where('NONEWSLETTER',$id)->first();
    }
}