<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Album;
use App\Models\Audio;
use App\Models\Artist;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MusicAlbumTest extends TestCase
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

    private function getAlbum() {
        $album = Album::first();
        $music = $this->getMusic();
        if(!$album) {
            $album  = Album::create([
                'album_name' => 'Test music',
                'status' => 1,
                'image' => UploadedFile::fake()->image('test_music_cover_image.jpg'),
                'song_list' => array($music->id)
            ]);
        }
        return $album;
    }


    public function test_music_album_can_be_rendered() {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/album');

        $response->assertStatus(200)
                ->assertSee('Album List');
    }

    public function test_music_album_can_be_created() {
        $user = $this->authenticate();
        $music = $this->getMusic();
        $artistData = [
            'name' => 'Test Album',
            'image' => UploadedFile::fake()->image('test_album_image.jpg'),
            'status' => 1,
            'audio' => array($music->id)
        ];
        $response = $this->actingAs($user)->post('new-album', $artistData);

        $response->assertStatus(200);
    }

    public function test_music_album_view_can_be_rendered() {
        $user = $this->authenticate();
        $album = $this->getAlbum();
        $response = $this->actingAs($user)->get("/album/{$album->id}");

        $response->assertStatus(200);
    }

    public function test_music_album_edit_can_be_rendered() {
        $user = $this->authenticate();
        $album = $this->getAlbum();
        $response = $this->actingAs($user)->get("/edit-album/{$album->id}");

        $response->assertStatus(200);
    }

    public function test_music_album_can_be_updated() {
        $user = $this->authenticate();
        $album = $this->getAlbum();
        $music = $this->getMusic();
        $albumData = [
            'name' => 'Updated Test Album',
            'image' => UploadedFile::fake()->image('test_album_updated_image.jpg'),
            'status' => 1,
            'audio' => array($music->id)
        ];
        $response = $this->actingAs($user)->post("/update-album/{$album->id}", $albumData);

        $response->assertStatus(200);
    }

    public function test_music_artist_can_be_deleted() {
        $user = $this->authenticate();
        $album = $this->getAlbum();
        // $music = Audio::where('artist_id', $artist->id)->first();
        // if($music) {
        //     $music->delete();
        // }
        $response = $this->actingAs($user)->delete("/delete-album/{$album->id}");

        $response->assertStatus(200);
    }
}
