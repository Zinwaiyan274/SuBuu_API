<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
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

    private function getBlogCategoryId() {
        $category = BlogCategory::first();
        if(!$category) {
            $category = BlogCategory::factory()->create([
                            'name' => 'Test Blog Category',
                            'description' => 'This is test blog category'
                        ]);
        }
        return $category->id;
    }

    public function test_blog_index_can_be_rendered()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/blog');

        $response->assertStatus(200)
                ->assertSee('Blogs List');
    }

    public function test_blog_can_be_created()
    {
        $user = $this->authenticate();
        $blog = [
            'category_id' => $this->getBlogCategoryId(),
            'title' => 'Test Blog',
            'content' => 'This is test blog',
        ];
        $response = $this->actingAs($user)->post('/new-blog', $blog);

        $response->assertStatus(200);
    }

    public function test_blog_view_can_be_rendered()
    {
        $user = $this->authenticate();
        $blog = Blog::first();
        $response = $this->actingAs($user)->get("/blog/{$blog->id}");

        $response->assertStatus(200);
    }

    public function test_blog_edit_can_be_rendered()
    {
        $user = $this->authenticate();
        $blog = Blog::first();
        $response = $this->actingAs($user)->get("/edit-blog/{$blog->id}");

        $response->assertStatus(200);
    }

    public function test_blog_can_be_updated()
    {
        $user = $this->authenticate();
        $blog = Blog::first();
        $blogData = [
            'category_id' => $this->getBlogCategoryId(),
            'title' => 'Test updated Blog',
            'content' => 'This is updated test blog',
        ];
        $response = $this->actingAs($user)->post("/update-blog/{$blog->id}", $blogData);

        $response->assertStatus(200);
    }

    public function test_blog_can_be_deleted()
    {
        $user = $this->authenticate();
        $blog = Blog::first();
        $response = $this->actingAs($user)->delete("/delete-blog/{$blog->id}");

        $response->assertStatus(200);
    }

    // Api Testing
    public function test_blog_list_api()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get("/api/v1/blogs");

        $response->assertStatus(200);
    }

    public function test_blog_detail_api()
    {
        $user = $this->authenticate();
        $blog = Blog::first();
        $response = $this->actingAs($user)->get("/api/v1/blogs/{$blog->id}/detail");

        $response->assertStatus(200);
    }
}
