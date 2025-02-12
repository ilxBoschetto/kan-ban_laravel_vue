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
        Schema::create('task_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->string('background_color');
            $table->timestamps();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('task_priority_id')->nullable(1)->constrained('task_priorities')->onDelete('cascade');
        });

        DB::table('task_priorities')->insert([
            ['name' => 'High', 'icon' => 'angle-double-up', 'background_color' => '#ed2618'],
            ['name' => 'Medium', 'icon' => 'equals', 'background_color' => '#ed9f18'],
            ['name' => 'Low', 'icon' => 'angle-double-down', 'background_color' => '#4ded18'],
        ]);

        $priorities = DB::table('task_priorities')->pluck('id')->toArray();

        DB::table('tasks')->get()->each(function ($task) use ($priorities) {
            DB::table('tasks')
                ->where('id', $task->id)
                ->update(['task_priority_id' => $priorities[array_rand($priorities)]]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_priorities');
    }
};
