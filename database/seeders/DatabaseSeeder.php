<?php

use App\Models\Comment;
use App\Models\MediaLibrary;
use App\Models\Post;
use App\Models\Role;
use App\Models\Token;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        Role::firstOrCreate(['name' => Role::ROLE_EDITOR]);
        $role_admin = Role::firstOrCreate(['name' => Role::ROLE_ADMIN]);

        // MediaLibrary
        MediaLibrary::firstOrCreate([]);

        // Users
        $user = User::firstOrCreate(
            ['email' => 'larapage@larapage.org'],
            [
                'name'              => 'Lara Page',
                'password'          => Hash::make('larapage'),
                'email_verified_at' => now(),
            ]
        );

        $user->roles()->sync([$role_admin->id]);

        // TODO Move posts to separate file
        $post = Post::firstOrCreate(
            [
                'title'     => 'Hello World',
                'author_id' => $user->id,
            ],
            [
                'posted_at' => now(),
                'content'   => "
                    Welcome to Laravel-blog !<br><br>
                    Don't forget to read the README before starting.<br><br>
                    Feel free to add a star on Laravel-blog on Github !<br><br>
                    You can open an issue or (better) a PR if something went wrong.",
            ]
        );
        $post = Post::firstOrCreate(
            [
                'title'     => 'Hello World 2',
                'author_id' => $user->id,
            ],
            [
                'posted_at' => now(),
                'content'   => "
                    Welcome to Laravel-blog !<br><br>
                    Don't forget to read the README before starting.<br><br>
                    Feel free to add a star on Laravel-blog on Github !<br><br>
                    You can open an issue or (better) a PR if something went wrong.",
            ]
        );

        // TODO Move comments to separate file
        Comment::firstOrCreate(
            [
                'author_id' => $user->id,
                'post_id'   => $post->id,
            ],
            [
                'posted_at' => now(),
                'content'   => "Hey ! I'm a comment as example.",
            ]
        );

        // API tokens
        User::where('api_token', null)->get()->each->update([
            'api_token' => Token::generate(),
        ]);
    }
}
