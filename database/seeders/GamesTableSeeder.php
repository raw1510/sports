<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $games = [
            'Archery',
            'Para athletics',
            'Para badminton',
            'Boccia',
            'Para canoe',
            'Para cycling',
            'Para equestrian',
            'Blind football',
            'Goalball',
            'Para Cricket',
            'Para judo',
            'Para powerlifting',
            'Para rowing',
            'Shooting para sport',
            'Sitting volleyball',
            'Para swimming',
            'Para table tennis',
            'Para taekwondo',
            'Para triathlon',
            'Wheelchair basketball',
            'Wheelchair fencing',
        ];

        $timestamp = Carbon::now();

        foreach ($games as $game) {
            DB::table('games')->insert([
                'game_name'  => $game,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
