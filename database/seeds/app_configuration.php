<?php

use App\error_types as ErrorTypes;
use App\User as User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Role;

class app_configuration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //USERS AND ROLES

        User::create([
            'name' => 'Esqola',
            'address' => 'Guatemala',
            'age' => '0',
            'email' => 'administrator@esqola.com',
            'firstaccess' => 0,
            'lastname' => 'Admin',
            'telephone' => '00000000',
            'uuid' => Uuid::generate(),
            'password' => Hash::make('esqolaadmin'),
        ]);

        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'Estudiante'
        ]);

        Role::create([
            'name' => 'Maestro'
        ]);

        Permission::create([
            'name' => 'administrate'
        ]);

        $user = User::find(1)->first();
        $user->assignRole('admin');
        $role = Role::find(1)->first();
        $role->givePermissionTo('administrate');

        // ERRORS

        ErrorTypes::create([
            'error_name' => 'Warning'
        ]);

        ErrorTypes::create([
            'error_name' => 'Error'
        ]);

    }
}
