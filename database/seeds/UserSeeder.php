<?php

use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = factory(User::class)->create([
            'email' => 'abner.gp@gmail.com',
            'name' => 'SuperUser',
            'username' => 'root',
            'password' => \Hash::make('Dextro1990')
        ]);
        $superadmin->assign('superadmin');

        $admin = factory(User::class)->create([
            'email' => 'majomkting@hotmail.com',
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => \Hash::make('secret')
        ]);
        $admin->assign('admin');
    }
}
