<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Audio;
use App\Models\Artist;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MusicAudioTest extends TestCase
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

    public function test_music_can_be_rendered() {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/audio');

        $response->assertStatus(200)
                ->assertSee('Music List');
    }

    public function test_music_can_be_created() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $musicData = [
            'title' => 'Test music',
            'artist' => $artist->id,
            'status' => 1,
            'image' => UploadedFile::fake()->image('test_music_cover_image.jpg'),
            'audio' => UploadedFile::fake()->image('test_music_song.mp3'),
        ];
        $response = $this->actingAs($user)->post('/new-audio', $musicData);

        $response->assertStatus(200);
    }

    public function test_music_view_can_be_rendered() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $response = $this->actingAs($user)->get("/audio/{$music->id}");

        $response->assertStatus(200)
                ->assertSee('Music Title');
    }

    public function test_music_edit_can_be_rendered() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $response = $this->actingAs($user)->get("/edit-audio/{$music->id}");

        $response->assertStatus(200);
    }

    public function test_music_can_be_updated() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $artist = $this->getArtist();
        $musicData = [
            'title' => 'Updated test music',
            'artist' => $artist->id,
            'status' => 1,
            'image' => UploadedFile::fake()->image('test_music_updated_cover_image.jpg'),
            'audio' => UploadedFile::fake()->image('test_music_updated_song.mp3'),
        ];
        $response = $this->actingAs($user)->post("/update-audio/{$music->id}", $musicData);

        $response->assertStatus(200);
    }

    public function test_music_can_be_deleted() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $response = $this->actingAs($user)->delete("/delete-audio/{$music->id}");

        $response->assertStatus(200);
    }
}
