<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       $arr = [
            'http://lorempixel.com/output/fashion-q-c-640-480-3.jpg',
            'http://lorempixel.com/output/cats-q-c-640-480-3.jpg',
            'http://lorempixel.com/output/nightlife-q-c-640-480-2.jpg',
            'http://lorempixel.com/output/nature-q-c-640-480-8.jpg',
            'http://lorempixel.com/output/business-q-g-640-480-1.jpg',
       ];

        $key = array_rand($arr);
        return [
            'url' => $arr[$key],
        ];
    }
}
