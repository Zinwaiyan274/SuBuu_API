<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Audio;
use App\Models\Artist;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MusicArtistTest extends TestCase
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

    public function test_music_artist_can_be_rendered() {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/artist');

        $response->assertStatus(200)
                ->assertSee('Artist List');
    }

    public function test_music_artist_can_be_created() {
        $user = $this->authenticate();
        $artistData = [
            'name' => 'Test Artist',
            'image' => UploadedFile::fake()->image('test_artist_image.jpg'),
            'status' => 1
        ];
        $response = $this->actingAs($user)->post('new-artist', $artistData);

        $response->assertStatus(200);
    }

    public function test_music_artist_view_can_be_rendered() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $response = $this->actingAs($user)->get("/artist/{$artist->id}");

        $response->assertStatus(200);
    }

    public function test_music_artist_edit_can_be_rendered() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $response = $this->actingAs($user)->get("/edit-artist/{$artist->id}");

        $response->assertStatus(200);
    }

    public function test_music_artist_can_be_updated() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $artistData = [
            'name' => 'Updated Test Artist',
            'image' => UploadedFile::fake()->image('test_artist_update_image.jpg'),
            'status' => 1
        ];
        $response = $this->actingAs($user)->post("/update-artist/{$artist->id}", $artistData);

        $response->assertStatus(200);
    }

    public function test_music_artist_can_be_deleted() {
        $user = $this->authenticate();
        $artist = $this->getArtist();
        $music = Audio::where('artist_id', $artist->id)->first();
        if($music) {
            $music->delete();
        }
        $response = $this->actingAs($user)->delete("/delete-artist/{$artist->id}");

        $response->assertStatus(200);
    }
}
