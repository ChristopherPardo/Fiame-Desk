<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Gathering;
use App\Models\Item;
use App\Models\users_order_batches;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(60)->create();
        $items = Item::factory(10)->create(['user_id' => function() use ($users) {return $users->random()->id;}]);
        $gatherings = Gathering::factory(10)->create(['user_id' => function() use ($users) {return $users->random()->id;}]);
        $batches = Batch::factory(10)->create(['gathering_id' => function() use ($gatherings) {return $gatherings->random()->id;}, 'item_id' => function() use ($items) {return $items->random()->id;}]);
        users_order_batches::factory(10)->create(['user_id' => function() use ($users) {return $users->random()->id;}, 'batch_id' => function() use ($batches) {return $batches->random()->id;}]);
    }
}
