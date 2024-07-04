<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@demo.xyz',
            'password' => Hash::make(12345678),
        ]);

        DB::table('sales')->insert([
            'start_sales' => false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('movies')->insert([[
            'title' => 'Звёздные войны XXIII: Атака клонированных клонов',
            'description' => 'Две сотни лет назад малороссийские хутора разоряла шайка нехристей-ляхов во главе с могущественным колдуном.',
            'duration_minutes' => '130',
            'origin' => 'США',
            'picture' => asset('storage/posters/poster1.jpg'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'title' => 'Альфа',
            'description' => '20 тысяч лет назад Земля была холодным и неуютным местом, в котором смерть подстерегала человека на каждом шагу.',
            'duration_minutes' => '96',
            'origin' => 'Франция',
            'picture' => asset('storage/posters/poster2.jpg'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'title' => 'Хищник',
            'description' => 'Самые опасные хищники Вселенной, прибыв из глубин космоса, высаживаются на улицах маленького городка, чтобы начать свою кровавую охоту. Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее.',
            'duration_minutes' => '101',
            'origin' => 'Канада, США',
            'picture' => asset('storage/posters/poster2.jpg'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]]);

        DB::table('halls')->insert([[
            'name' => 'Demo hall1',
            'total_rows' => '5',
            'total_cols' => '6',
            'price_standard' => '100',
            'price_vip' => '200',
            'is_started_sales' => false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'name' => 'Demo hall2',
            'total_rows' => '6',
            'total_cols' => '5',
            'price_standard' => '150',
            'price_vip' => '250',
            'is_started_sales' => false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]]);

        DB::table('ticket_seats')->insert([
            [
                'ticket_id' => '1',
                'seat_id' => '1',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'ticket_id' => '2',
                'seat_id' => '2',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'ticket_id' => '3',
                'seat_id' => '3',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'ticket_id' => '3',
                'seat_id' => '4',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ],
        ]);

        DB::table('tickets')->insert([[
            'uuid' => '111',
            'seance_id' => '1',
            'date' => '2023-07-19',
            'price' => '123',
            'qr_code' => '',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'uuid' => '222',
            'seance_id' => '1',
            'date' => '2023-07-19',
            'price' => '123',
            'qr_code' => '',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ],
            [
                'uuid' => '333',
                'seance_id' => '1',
                'date' => '2023-07-19',
                'price' => '123',
                'qr_code' => '',
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
            ]
        ]);

        DB::table('seances')->insert([[
            'hall_id' => '1',
            'movie_id' => '1',
            'start_time' => '09:00',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'movie_id' => '2',
            'start_time' => '11:00',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'movie_id' => '1',
            'start_time' => '13:00',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'movie_id' => '3',
            'start_time' => '16:30',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'movie_id' => '2',
            'start_time' => '07:00',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'movie_id' => '1',
            'start_time' => '10:30',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'movie_id' => '2',
            'start_time' => '16:00',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'movie_id' => '3',
            'start_time' => '19:30',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]]);

        DB::table('seats')->insert([[
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '1',
            'index_col' => '6',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '2',
            'index_col' => '6',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '3',
            'index_col' => '6',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '4',
            'index_col' => '6',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '1',
            'index_row' => '5',
            'index_col' => '6',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '1',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '1',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '1',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '1',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '1',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '2',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '2',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '2',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '2',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '2',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '3',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '3',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '3',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '3',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '3',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '4',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '4',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '4',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '4',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '4',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '5',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '5',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '5',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '5',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '5',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '6',
            'index_col' => '1',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '6',
            'index_col' => '2',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '6',
            'index_col' => '3',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '6',
            'index_col' => '4',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ], [
            'hall_id' => '2',
            'index_row' => '6',
            'index_col' => '5',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]]);
    }
}
