<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name','Admin')->first();
        $moderatorRole = Role::where('name','Moderator')->first();
        $authorRole = Role::where('name','Author')->first();



        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'Admin@ad.com';
        $admin->password = bcrypt('secret');
        $admin->api_token = Str::random(60);
        $admin->save();
        $admin->roles()->attach($adminRole->id);


        $moderator = new User();
        $moderator->name = 'Pera';
        $moderator->email = 'Moderator@mo.com';
        $moderator->password = bcrypt('secret');
        $moderator->api_token = Str::random(60);
        $moderator->save();
        $moderator->roles()->attach($moderatorRole->id);
        $moderator->roles()->attach($authorRole->id);


        $author = new User();
        $author->name = 'Srdja';
        $author->email = 'Author@au.com';
        $author->password = bcrypt('secret');
        $author->api_token = Str::random(60);
        $author->save();
        $author->roles()->attach($authorRole->id);

        $author = new User();
        $author->name = 'Pedja';
        $author->email = 'Author1@au.com';
        $author->password = bcrypt('secret');
        $author->api_token = Str::random(60);
        $author->save();
        $author->roles()->attach($authorRole->id);

        $author = new User();
        $author->name = 'Nedja';
        $author->email = 'Author2@au.com';
        $author->password = bcrypt('secret');
        $author->api_token = Str::random(60);
        $author->save();
        $author->roles()->attach($authorRole->id);


    }
}
