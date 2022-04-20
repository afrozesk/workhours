<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class AddUser.
 */
class AddUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserModel::create([
            'email' => env('USER_EMAIL'),
            'password' => Hash::make(env('USER_PWD')),
        ]);
    }
}
