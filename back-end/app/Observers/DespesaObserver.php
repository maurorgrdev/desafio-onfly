<?php

namespace App\Observers;

use App\Models\Despesa;
use App\Notifications\NovaDespesaNotify;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class DespesaObserver
{
    /**
     * Handle the Despesa "created" event.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return void
     */
    public function created(Despesa $despesa)
    {
        $user_auth = Auth::user();
        $user_repository = new UserRepository();

        $user_dto = $user_repository->find_by_id($user_auth->id);

        $user_dto->notify(new NovaDespesaNotify());
    }

    /**
     * Handle the Despesa "updated" event.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return void
     */
    public function updated(Despesa $despesa)
    {
        //
    }

    /**
     * Handle the Despesa "deleted" event.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return void
     */
    public function deleted(Despesa $despesa)
    {
        //
    }

    /**
     * Handle the Despesa "restored" event.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return void
     */
    public function restored(Despesa $despesa)
    {
        //
    }

    /**
     * Handle the Despesa "force deleted" event.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return void
     */
    public function forceDeleted(Despesa $despesa)
    {
        //
    }

    private function queueMailable(Despesa $despesa)
    {
        // $teacher = User::findOrFail($classroom->teacher_id)->first();
        // $student = User::findOrFail($classroom->student_id)->first();

        // \Mail::to($teacher->email)->send(
        //     new $mailable($teacher, $student)
        // );
    }
}
