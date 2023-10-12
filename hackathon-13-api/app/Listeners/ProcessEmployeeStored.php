<?php

namespace App\Listeners;

use App\Events\EmployeeStored;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessEmployeeStored
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeStored $event): void
    {
        $employee = $event->employee;
        $nip = $event->nip;
        $positionId = $event->positionId;

        $employee->employeeDetail()->create(['nip' => $nip, 'employee' => $employee->id]);
        $employee->positions()->attach($positionId);
    }
}
