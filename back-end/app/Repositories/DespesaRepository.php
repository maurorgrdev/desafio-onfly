<?php

namespace App\Repositories;

use App\Models\Despesa;
use App\Repositories\BaseRepository;

class DespesaRepository extends BaseRepository
{
    protected $model = Despesa::class;
}