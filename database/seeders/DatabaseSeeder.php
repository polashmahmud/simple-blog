<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->role = 1;
        $user->save();

        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
        $user->save();

        User::factory((int)env('USER_SEED_COUNT'))->create();
        Post::factory((int)env('POST_SEED_COUNT'))->create();
    }
}
