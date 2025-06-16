<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $class = AcademicClass::inRandomOrder()->first();

        return [
            'student_id' => 'SID-' . strtoupper(Str::random(6)),
            'roll_no' => $this->faker->unique()->numberBetween(1, 999),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'father_name' => $this->faker->name('male'),
            'mother_name' => $this->faker->name('female'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'religion' => $this->faker->randomElement(['Islam', 'Hindu', 'Other']),
            'date_of_birth' => $this->faker->date('Y-m-d', '-10 years'),
            'department_id' => null, // You can modify if needed
            'class_id' => $class ? $class->id : 1, // fallback to 1 if no class
            'image' => null,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
