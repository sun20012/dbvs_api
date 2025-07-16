<?php

namespace Database\Seeders;

use App\Models\Member;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * 執行資料庫 Seeder
     */
    public function run(): void
    {
        // 呼叫會員 Seeder
        $this->call([
            MemberSeeder::class,
        ]);
    }
}
