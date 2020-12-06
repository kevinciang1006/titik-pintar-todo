<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class TasksState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:state';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change task state';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->ask('Task ID?');
        $state = $this->anticipate('State?', ['to do', 'done']);

        Task::where('id', $id)->update([
            'state' => $state
        ]);
        return 0;
    }
}
