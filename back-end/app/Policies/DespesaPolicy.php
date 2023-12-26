<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class DespesaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index_despesa(User $user, array $despesas)
    {
        foreach ($despesas as $despesa) {
            if($despesa->user_id != $user->id){
                Response::deny('Permissão negada');
            }
        }

        return Response::allow();
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function show(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Permissão negada');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update_despesa(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Permissão negada');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id
            ? Response::allow()
            : Response::deny('Permissão negada');
    }
}