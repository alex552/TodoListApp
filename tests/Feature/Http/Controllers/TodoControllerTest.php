<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_list_all_todos()
    {
        $todos = Todo::factory()->count(3)->create();

        $response = $this->get(route('todos.index'));

        $response->assertStatus(200);

        $response->assertJson($todos->toArray());
    }

    public function test_can_create_a_todo()
    {
        $todoData = [
            'title' => 'Test Todo',
            'completed' => true,
        ];

        $response = $this->post(route('todos.store'), $todoData);

        $response->assertStatus(201);
        $response->assertJsonFragment($todoData);
        $this->assertDatabaseHas('todos', $todoData);
    }

    public function test_can_show_a_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->get(route('todos.show', $todo));

        $response->assertStatus(200);
        $response->assertJson($todo->toArray());
    }

    public function test_can_update_a_todo()
    {
        $todo = Todo::factory()->create();
        $todoData = [
            'title' => 'Updated Todo',
            'completed' => false,
        ];

        $response = $this->put(route('todos.update', $todo->id), $todoData);

        $response->assertStatus(200);
        $response->assertJsonFragment($todoData);
        $this->assertDatabaseHas('todos', $todoData);
    }

    public function test_can_delete_a_todo()
    {
        $todo = Todo::factory()->create();

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', $todo->toArray());
    }

    public function test_cannot_create_a_todo_with_invalid_data()
    {
        $todoData = [
            'title' => '',
            'completed' => 'invalid',
        ];

        $response = $this->post(route('todos.store'), $todoData);

        $response->assertJsonValidationErrors(['title', 'completed']);
        $this->assertDatabaseMissing('todos', $todoData);
    }

    public function test_cannot_update_a_todo_with_invalid_data()
    {
        $todo = Todo::factory()->create();
        $todoData = [
            'title' => '',
            'completed' => 'invalid',
        ];

        $response = $this->put(route('todos.update', $todo), $todoData);
        $response->assertJsonValidationErrors(['title', 'completed']);
        $this->assertDatabaseHas('todos',  ['title' => $todo->title, 'completed' => $todo->completed]);
    }
}
