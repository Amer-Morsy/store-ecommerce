<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::factory()->count(10)->create([
            'parent_id' => $this->getRandomParentId(),
        ]);
    }

    private function getRandomParentId()
    {
        $parent_id =  Category::inRandomOrder()->first();
        return $parent_id;
    }
}
