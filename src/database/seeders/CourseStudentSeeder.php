<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // give each student some courses
        foreach (Student::all() as $student) {
            foreach (Course::all() as $course) {
                if (rand(1, 100) > 70) {
                    $student->courses()->attach($course->id);
                }
            }
            $student->save();
        }
    }
}
