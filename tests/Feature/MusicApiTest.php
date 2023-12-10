<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Audio;
use App\Models\Artist;
use App\Models\Api\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MusicApiTest extends TestCase
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
                'name' => 'TestUser',
                'email' => 'testuser@gmail.com',
                'password' => bcrypt('testuser'),
                'user_type' => 'User',
                'refer' => 'RF5869'
            ]);
        }
        return $user;
    }

    private function getArtist() {
        $artist = Artist::first();
        if(!$artist) {
            $artist  = Artist::create([
                'artist_name' => 'Test Artist',
                'image' => UploadedFile::fake()->image('test_artist_image.jpg'),
                'status' => 1
            ]);
        }
        return $artist;
    }

    private function getMusic() {
        $audio = Audio::first();
        $artist = $this->getArtist();
        if(!$audio) {
            $audio  = Audio::create([
                'audio_title' => 'Test music',
                'artist_id' => $artist->id,
                'status' => 1,
                'image' => UploadedFile::fake()->image('test_music_cover_image.jpg'),
                'audio' => UploadedFile::fake()->image('test_music_song.mp3'),
            ]);
        }
        return $audio;
    }


    public function test_music_list_api() {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get("/api/v1/music");

        $response->assertStatus(200);
    }

    public function test_single_music_api() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $response = $this->actingAs($user)->get("/api/v1/single-music/{$music->id}");

        $response->assertStatus(200);
    }

    public function test_music_add_favorite_api() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $data = [
            'audio_id' => $music->id,
            'like' => 1
        ];
        $response = $this->actingAs($user)->post("/api/v1/add-favorite", $data);

        $response->assertStatus(200);
    }

    public function test_music_by_artist_api() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $response = $this->actingAs($user)->get("/api/v1/music-by-artist/{$artist}");

        $response->assertStatus(200);
    }

    public function test_favourite_music_api() {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get("/api/v1/favorite-music");

        $response->assertStatus(200);
    }
}
