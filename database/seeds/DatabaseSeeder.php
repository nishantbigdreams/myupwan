<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\Admin::create([
            'name' => 'admin',
            'email' => 'admin@devfbss.in',
            'password'=> \Hash::make('123456')
        ]);

        \App\Category::create([
            'name' => 'Printer',
            'sku_initial' => 'PRN',
            'data'=> '[[{"name":"Brand"},[{"attribute":"SONY","type":"checkbox"},{"attribute":"HP","type":"checkbox"},{"attribute":"SAMSUNG","type":"checkbox"},{"attribute":"LG","type":"checkbox"}]],[{"name":"Color"},[{"attribute":"WHITE","type":"checkbox"},{"attribute":"BLACK","type":"checkbox"},{"attribute":"GRAY","type":"checkbox"}]],[{"name":"Type"},[{"attribute":"LASER","type":"checkbox"},{"attribute":"INKJET","type":"checkbox"}]],[{"name":"Details"},[{"attribute":"OS","type":"text"},{"attribute":"PAPER-SIZE","type":"text"}]],[{"name":"Dimension"},[{"attribute":"HEIGHT","type":"text"},{"attribute":"WEIGHT","type":"text"},{"attribute":"WIDTH","type":"text"}]]]'
        ]);
    }
}
