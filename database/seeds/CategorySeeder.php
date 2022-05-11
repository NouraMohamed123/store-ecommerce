<?php


use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 25)->create([
            'parent_id'=> $this->getRandomParentId()
        ]);


    }
    private function getRandomParentId(){
      return  \App\Models\Category::inRandomOrder()->first();
    }
}
