<?php

namespace App\Observers;

use App\Models\Despesa;

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
        // $user
        // $this->queueMailable($despesa);
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
