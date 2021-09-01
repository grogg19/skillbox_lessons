<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Salopot\ImageGenerator\ImageGenerator;
use Salopot\ImageGenerator\ImageProvider;

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




        return [
            // path' => $faker->imageUrl( 80, 80, 'people')
            //'path' => basename($filePath)
        ];
    }
}
