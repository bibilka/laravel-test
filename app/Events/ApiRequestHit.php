<?php

namespace App\Events;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Событие "обращение к апи".
 */
class ApiRequestHit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Carbon\Carbon
     */
    public $time;

    /**
     * @var App\Models\User
     */
    public $user;

    /**
     * Create a new event instance. 
     * 
     * @param User $user
     * @param Carbon $time
     *
     * @return void
     */
    public function __construct(User $user, Carbon $time)
    {
        $this->user = $user;
        $this->time = $time;
    }
}
