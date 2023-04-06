<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\New_;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 =  Role::create(['name'=>'Tecni']);

        Permission::create(['name'=>'ver:role']);
        Permission::create(['name'=>'crear:role']);
        Permission::create(['name'=>'editar:role']);
        Permission::create(['name'=>'eliminar:role']);

        Permission::create(['name'=>'ver:permiso']);

        Permission::create(['name'=>'ver:usuario']);
        Permission::create(['name'=>'crear:usuario']);
        Permission::create(['name'=>'editar:usuario']);
        Permission::create(['name'=>'eliminar:usuario']);

        $user = new User;
        $user->name = 'Admin';
        $user->email= 'admin@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();
        $user->assignRole($role1);

        $user = new User;
        $user->name = 'Tecnico';
        $user->email= 'tecnico@gmail.com';
        $user->password = bcrypt('123456789');
        $user->save();
        $user->assignRole($role2);

    }
}
