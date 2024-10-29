<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->string('background_color');
            $table->timestamps();
        });

        Schema::create('task_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('background_color');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('task_type_id')->constrained('task_types')->onDelete('cascade');
            $table->foreignId('task_status_id')->constrained('task_statuses')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('background');
            $table->timestamps();
        });

        Schema::create('board_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('index');
            $table->string('background');
            $table->foreignId('board_id')->constrained('boards')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('board_column_tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('index');
            $table->foreignId('board_column_id')->constrained('board_columns')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('task_types')->insert([
            ['name' => 'Development', 'icon' => 'code', 'background_color' => '#3498db'],
            ['name' => 'Design', 'icon' => 'palette', 'background_color' => '#e74c3c'],
            ['name' => 'Testing', 'icon' => 'bug', 'background_color' => '#2ecc71'],
        ]);

        DB::table('task_statuses')->insert([
            ['name' => 'To Do', 'background_color' => '#f1c40f'],
            ['name' => 'In Progress', 'background_color' => '#e67e22'],
            ['name' => 'Completed', 'background_color' => '#2ecc71'],
        ]);

        DB::table('boards')->insert([
            ['name' => 'Default Board', 'background' => '#3498db']
        ]);

        // Insert tasks
        $taskTypeIds = DB::table('task_types')->pluck('id');
        $taskStatusIds = DB::table('task_statuses')->pluck('id');

        for ($i = 1; $i <= 10; $i++) {
            DB::table('tasks')->insert([
                'name' => 'Task ' . $i,
                'task_type_id' => $taskTypeIds->random(),
                'task_status_id' => $taskStatusIds->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert board columns
        $boardColumns = [
            ['name' => 'Backlog', 'index' => 1000, 'background' => '#f39c12', 'board_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'In Progress', 'index' => 2000, 'background' => '#2980b9', 'board_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Completed', 'index' => 3000, 'background' => '#27ae60', 'board_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('board_columns')->insert($boardColumns);

        // Insert board column tasks
        $boardColumnTasks = [];
        $indexGap = 60000;
        foreach (range(1, 10) as $taskId) {
            $boardColumnTasks[] = [
                'index' => $indexGap * $taskId,
                'board_column_id' => rand(1, 3),
                'task_id' => $taskId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('board_column_tasks')->insert($boardColumnTasks);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_column_tasks');
        Schema::dropIfExists('board_columns');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('boards');
        Schema::dropIfExists('task_types');
        Schema::dropIfExists('task_statuses');
    }
};
