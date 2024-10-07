<?php

namespace App\Jobs;

use App\Services\RabbitMQService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RabbitMQJob implements ShouldQueue
{
    use Queueable;

    public string $confirmationCode;

    /**
     * Create a new job instance.
     */
    public function __construct(string $confirmationCode)
    {
        $this->confirmationCode = $confirmationCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new RabbitMQService;

        $service->rabbitConnect();

        $service->sendConfirmationCode($this->confirmationCode);

        $service->closeConnection();
    }
}
