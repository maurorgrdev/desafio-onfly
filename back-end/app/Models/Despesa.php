<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Despesa extends Model
{
    use HasFactory;

    protected $table = 'despesas';

    protected $fillable = [
        'descricao',
        'data',
        'valor',
        'user_id',
    ];

    public $timestamps = true;
    
    public function post()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
