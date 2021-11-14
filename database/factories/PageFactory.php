<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->words(rand(1,3),true);
        $slug=Str::slug($title);
        $created_at=$this->faker->dateTimeBetween('-2 year', 'now');

        return [
            
            'title'=>$title,
            'slug'=>$slug,

            'subtitle'=>$this->faker->sentence(rand(4,8)),
            'photo'=>'article.jpg',

            'excerpt'=>$this->faker->paragraphs(rand(1,3),true),
            'presentation'=>$this->faker->paragraphs(rand(1,3),true),
            'content'=>$this->faker->paragraphs(rand(6,12),true),

            'view'=>rand(125,2345),
            'published_at'=>$this->faker->randomElement(array(null,$created_at)),
            'created_at'=>$created_at,

            'user_id' => User::all()->where('role','author')->random(),

            'meta_title'=>$this->faker->words(rand(2,5),true),
            'meta_description'=>$this->faker->words(rand(10,15),true),
            'meta_keywords'=>$this->faker->words(rand(10,20),true)
        ];
    }
}
