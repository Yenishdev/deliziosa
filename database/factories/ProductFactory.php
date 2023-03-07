<?php

namespace Database\Factories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

            $category = DB::table('categories')->inRandomOrder()->first();
            $hasDiscount = fake()->boolean(70);
            $stock = fake()->boolean(30);
            $nameTm = fake()->streetSuffix();
            $nameEn = null;

        return [
            'category_id' => $category->id,
            'name_tm' => $nameTm,
            'name_en' => $nameEn,
            'prep_duration' => $stock ? 0 : rand(2, 15),
            'price' => fake()->randomFloat($nbMaxDecimals = 1, $min = 10, $max = 100),
            'stock' => $stock
                ? rand(1, 5) : 0,
            'discount_percent' => $hasDiscount
                ? rand(10, 20) : 0,
            'discount_start' => $hasDiscount
                ? Carbon::today()
                    ->subDays(rand(1, 7))
                    ->subHours(rand(1, 24))
                    ->subMinutes(rand(1, 60))
                    ->toDateTimeString()
                : Carbon::today()
                    ->startOfMonth()
                    ->toDateTimeString(),
            'discount_end' => $hasDiscount
                ? Carbon::today()
                    ->addDays(rand(1, 7))
                    ->addHours(rand(1, 24))
                    ->addMinutes(rand(1, 60))
                    ->toDateTimeString()
                : Carbon::today()
                    ->startOfMonth()
                    ->toDateTimeString(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),

        ];
    }
}
