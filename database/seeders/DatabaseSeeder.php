<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database
     * @return void
     */
    public function run()
    {
         User::factory(15)->create();
         Image::factory(20)->create();
         Post::factory(30)->create();
         Comment::factory(150)->create();
    }
}
