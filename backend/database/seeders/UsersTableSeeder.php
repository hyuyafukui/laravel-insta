<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run()
    {
        $users = [
            [
                'name' => 'Hyuya',
                'email' => 'hyuya@email.com',
                'password' => Hash::make('password'),
                'role_id' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Alex',
                'email' => 'alex@email.com',
                'password' => Hash::make('password'),
                'role_id' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Kyle',
                'email' => 'kyle@email.com',
                'password' => Hash::make('password'),
                'role_id' => '2',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];
        $this->user->insert($users);
    }
}
