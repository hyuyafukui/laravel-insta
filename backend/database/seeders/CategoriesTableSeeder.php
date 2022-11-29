<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function run()
    {
        $categories = [
            [
                'name' => 'Sciences',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Landscaping',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Gardening',
                'Created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
