<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogCategoryTest extends TestCase
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

    public function test_blog_category_index_can_be_rendered()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get('/blog-category');

        $response->assertStatus(200)
                ->assertSee('Blog Categories List');
    }

    public function test_blog_category_can_be_created()
    {
        $user = $this->authenticate();
        $category = [
            'name' => 'Test Blog Category',
            'status' => 1,
            'description' => 'This is test blog category',
        ];
        $response = $this->actingAs($user)->post('/new-blog-category', $category);

        $response->assertStatus(200);
    }

    public function test_blog_category_edit_can_be_rendered()
    {
        $user = $this->authenticate();
        $category = BlogCategory::first();
        $response = $this->actingAs($user)->get("/edit-blog-category/{$category->id}");

        $response->assertStatus(200)
                ->assertSee('Edit blog category');
    }

    public function test_blog_category_can_be_updated()
    {
        $user = $this->authenticate();
        $category = BlogCategory::first();
        $categoryData = [
            'name' => 'Test Blog Category Update',
            'status' => 1,
            'description' => 'This is updated test blog category',
        ];
        $response = $this->actingAs($user)->post("/update-blog-category/{$category->id}", $categoryData);

        $response->assertStatus(200);
    }

    public function test_blog_category_can_be_deleted()
    {
        $user = $this->authenticate();
        $category = BlogCategory::first();
        $response = $this->actingAs($user)->delete("/delete-blog/{$category->id}");

        $response->assertStatus(200);
    }


    // Api Testing
    public function test_blog_category_list_api()
    {
        $user = $this->authenticate();
        $response = $this->actingAs($user)->get("/api/v1/blog-categories");

        $response->assertStatus(200);
    }

}
