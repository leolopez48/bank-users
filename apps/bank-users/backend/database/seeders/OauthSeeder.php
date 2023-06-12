<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class OauthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                "id" => "9956ed49-c9a7-4fe3-9518-715c3d850a30",
                "user_id" => null,
                "name" => "Secure Bank Auth",
                "secret" => null,
                "provider" => null,
                "redirect" => "http://localhost:5173/callback,http://localhost/callback",
                "personal_access_client" => "0",
                "password_client" => "0",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => "9962f233-4dbf-4caa-a4a0-5f6e468d3d09",
                "user_id" => null,
                "name" => "Secure Bank Password Grant Client",
                "secret" => "$2y$10\$BCzM1MNrN6q8ExUCmKvOvOQj/hij9guunRQTo.b09JmyC8PUnYNLa",
                "provider" => "users",
                "redirect" => "http://localhost",
                "personal_access_client" => "0",
                "password_client" => "1",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
