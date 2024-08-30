<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainRule extends Model
{
    use HasFactory;

    // Lista de atributos que você permite a atribuição em massa
    protected $fillable = ['domain', 'rule_type', 'status', 'priority', 'user_id', 'description'];

}

