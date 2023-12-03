<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private function authenticate() {
        $user = User::where('email', 'admin@admin.com')->first();
        if(!$user) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'user_type' => 'Admin'
            ]);
        }
        return $user;
    }

    public function test_game_index_can_be_rendered()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/game');

        $response->assertStatus(200)
                ->assertSee('Games List');
    }

    public function test_game_can_be_created()
    {
        $user = $this->authenticate();
        $heroImage = UploadedFile::fake()->image('test_hero_image.jpg');
        $coverImage = UploadedFile::fake()->image('test_cover_image.jpg');
        $game = [
            'title' => 'Test Game',
            'hero_image' => $heroImage,
            'cover_image' => $coverImage,
            'game_link' => 'https://laravel.com/docs/10.x/testing',
            'status' => 1
        ];
        $response = $this->actingAs($user)->post('/new-game', $game);

        $response->assertStatus(200);
    }

    public function test_game_edit_can_be_rendered()
    {
        $user = $this->authenticate();
        $game = Game::first();
        $response = $this->actingAs($user)->get("/edit-game/{$game->id}");

        $response->assertStatus(200)
                ->assertSee('Edit game');
    }

    public function test_game_can_be_updated()
    {
        $user = $this->authenticate();
        $game = Game::first();
        $heroImage = UploadedFile::fake()->image('test_updated_hero_image.jpg');
        $coverImage = UploadedFile::fake()->image('test_updated_cover_image.jpg');
        $gameData = [
            'title' => 'Test Game Update',
            'hero_image' => $heroImage,
            'cover_image' => $coverImage,
            'game_link' => 'https://laravel.com/docs/10.x/testing',
            'status' => 1
        ];
        $response = $this->actingAs($user)->post("/update-game/{$game->id}", $gameData);

        $response->assertStatus(200);
    }

    public function test_game_can_be_deleted()
    {
        $user = $this->authenticate();
        $game = Game::first();
        $response = $this->actingAs($user)->delete("/delete-game/{$game->id}");

        $response->assertStatus(200);
    }


    // Api Testing
    public function test_game_list_api()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get("/api/v1/games");

        $response->assertStatus(200);
    }

    public function test_game_detail_api()
    {
        $user = $this->authenticate();
        $game = Game::first();
        if(!$game) {
            $heroImage = UploadedFile::fake()->image('test_hero_image.jpg');
            $coverImage = UploadedFile::fake()->image('test_cover_image.jpg');
            $game = Game::create([
                'title' => 'Test Game',
                'hero_image' => $heroImage,
                'cover_image' => $coverImage,
                'game_link' => 'https://laravel.com/docs/10.x/testing',
                'status' => 1
            ]);
        }
        $response = $this->actingAs($user)->get("/api/v1/games/{$game->id}/detail");

        $response->assertStatus(200);
    }
}
