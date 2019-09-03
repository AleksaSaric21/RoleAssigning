<?php

use Illuminate\Database\Seeder;
use \App\Role;
use App\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Author = new Role();
        $Author->name = "Author";
        $Author->description = "Can write new, edit and delete his posts";
        $Author->save();

        $adminUser = new Role();
        $adminUser->name = "Admin";
        $adminUser->description = "Can ban/delete users, give and revoke permissions";
        $adminUser->save();

        $moderator = new Role();
        $moderator->name = "Moderator";
        $moderator->description = "Can approve or deny Author's posts and write/edit/delete his own posts";
        $moderator->save();


    }
}
