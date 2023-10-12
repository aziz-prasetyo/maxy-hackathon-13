<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmployeeStored
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $employee;
    public $nip;
    public $positionId;

    /**
     * Create a new event instance.
     * @param  User     $employee
     * @param  string   $nip
     * @param  string   $positionId
     * @return void
     */
    public function __construct(User $employee, $nip, $positionId)
    {
        $this->employee = $employee;
        $this->nip = $nip;
        $this->positionId = $positionId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('employee-stored'),
        ];
    }
}
