<?php

namespace App\Repositories;

use App\Models\Despesa;
use App\Repositories\BaseRepository;

class DespesaRepository extends BaseRepository
{
    protected $model = Despesa::class;

    public function all_by_user_id($user_id){

        return Despesa::where('user_id', $user_id)->get();
    }
}