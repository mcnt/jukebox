<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    protected function userAuth()
    {
        return User::where('email', 'like', '%@example%')->first();
    }

    public function test_create(): void
    {
        $task = Task::factory()->makeOne()->toArray();
        $user = $this->userAuth();

        $response = $this->actingAs($user)
            ->post(route('tasks.store'), $task);

        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks', [
            'title' => $task['title'],
            'description' => $task['description'],
            'user_id' => $user['id']
        ]);
    }

    public function test_list(): void
    {
        $user = $this->userAuth();

        $response = $this->actingAs($user)->get(route('tasks.index'));

        $response->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description'
                    ]
                ]
            ]);

        $tasks = $response->json();

        foreach ($tasks['data'] as $task) {
            $this->assertEquals($user['id'], $task['user_id']);
        }
    }

    public function test_show(): void
    {
        $user = $this->userAuth();
        $task = Task::where('user_id', $user['id'])->inRandomOrder()->first();

        $response = $this->actingAs($user)->get(
            route('tasks.show', ['task' => $task['id']])
        );

        $response->assertSuccessful()
            ->assertJsonPath('title', $task['title'])
            ->assertJsonPath('description', $task['description']);
    }

    public function test_update(): void
    {
        $user = $this->userAuth();
        $task = Task::where('user_id', $user['id'])->inRandomOrder()->first();
        $newTask = Task::factory()->make()->toArray();

        $response = $this->actingAs($user)->patch(
            route('tasks.update', ['task' => $task['id']]),
            $newTask
        );

        $response->assertSuccessful()
            ->assertJsonPath('success', 'task.updated');
    }

    public function test_delete(): void
    {
        $user = $this->userAuth();
        $task = Task::where('user_id', $user['id'])->inRandomOrder()->first();

        $response = $this->actingAs($user)->delete(
            route('tasks.destroy', ['task' => $task['id']])
        );

        $response->assertSuccessful()
            ->assertJsonPath('success', 'task.deleted');
    }
}
