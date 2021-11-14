<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Page;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title=$this->faker->words(rand(1,3),true);
        $created_at=$this->faker->dateTimeBetween('-2 year', 'now');

        return [
            'title'=>$title,
            'content'=>$this->faker->sentence(rand(4,8)),
            'user_id' => User::all()->where('role','author')->random(),
            'page_id' => Page::all()->where('published_at','<>','null')->random(),
            'created_at'=>$created_at,
        ];
    }
}
