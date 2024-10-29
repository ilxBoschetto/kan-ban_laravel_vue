<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BoardColumnTask;
use App\Models\BoardColumn;
use App\Models\Task;

class BoardColumnTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardColumns = BoardColumn::all();
        $tasks = Task::all();

        // Check that both tables have data
        if ($boardColumns->isEmpty() || $tasks->isEmpty()) {
            $this->command->info("No board columns or tasks found. Please seed those tables first.");
            return;
        }

        // Create entries in the board_column_tasks table
        foreach ($boardColumns as $boardColumn) {
            foreach ($tasks->random(rand(1, 5)) as $task) { // Link each board column with a random set of tasks
                BoardColumnTask::create([
                    'board_column_id' => $boardColumn->id,
                    'task_id' => $task->id,
                ]);
            }
        }
    }
}
