<?php

use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Request::class)->create(['level' => 'cendi']);
        factory(\App\Models\Request::class)->create(['level' => 'primaria']);
        factory(\App\Models\Request::class)->create(['level' => 'secundaria']);
        factory(\App\Models\Request::class)->create(['level' => 'preparatoria']);
    }
}
