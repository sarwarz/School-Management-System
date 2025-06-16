<?php

namespace Database\Seeders;

use App\Models\AcademicClass;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are academic classes
        if (AcademicClass::count() === 0) {
            AcademicClass::create(['name' => 'Default Class', 'status' => 1]);
        }

        $faker = \Faker\Factory::create();
        $faker->unique(true);
        // Create 50 students
        Student::factory()->count(50)->create();
    }
}
