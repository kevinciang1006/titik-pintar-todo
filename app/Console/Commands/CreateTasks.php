<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class CreateTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new task';

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
        $name = $this->ask('Name?');
        $sectionId = $this->ask('Section ID?');

        Task::create([
            'section_id' => $sectionId,
            'name' => $name,
            'state' => 'to do'
        ]);
        return 0;
    }
}
