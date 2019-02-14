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
            'email' => 'juan.huerta@morelos.gob.mx',
            'name' => 'SuperUser',
            'username' => 'root',
            'password' => \Hash::make('Biblioteca.2019')
        ]);
        $superadmin->assign('superadmin');
    }
}
