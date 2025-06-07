<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EffectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('Effects')->insert([
                'author' => 'Author ' . $i,
                'effect_name' => 'Effect ' . $i,
                'type' => 'Type ' . $i,
                'title' => 'Title effect number ' . $i,
                'link' => null,
                'html' => '<div>HTML content ' . $i . '</div>',
                'css' => '.class-' . $i . ' { color: red; }',
                'js' => 'console.log("Effect ' . $i . ' loaded.");',
            ]);
        }
    }
}
