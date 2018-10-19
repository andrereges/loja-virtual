<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User;
        $user1->name = "Usuário 1";
        $user1->email = "usuario1@teste.com";
        $user1->password = Hash::make('123456');
        $user1->email_verified_at = now();
        $user1->created_at = now();
        $user1->updated_at = now();        
        $user1->save();

        $user2 = new User;
        $user2->name = "Usuário 2";
        $user2->email = "usuario2@teste.com";
        $user2->password = Hash::make('123456');
        $user2->email_verified_at = now();
        $user2->created_at = now();
        $user2->updated_at = now();        
        $user2->save();
    }
}
