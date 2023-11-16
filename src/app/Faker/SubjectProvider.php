<?php

namespace App\Faker;

use Faker\Provider\Base;

class SubjectProvider extends Base
{
    /**
     * static subject name list
     *
     * @var array<string>
     */
    protected static $names = [
        'Art',
        'Citizenship',
        'Civics/Politics',
        'Computer Science',
        'Design and Technology',
        'Drama/Theater',
        'English Language',
        'Environmental Studies',
        'Geography',
        'Health Education',
        'History',
        'Home Economics/Cooking',
        'Languages',
        'Mathematics',
        'Music',
        'Personal Development',
        'Physical Education',
        'Religious Education',
        'Science',
        'Social Studies',
    ];

    public function subject(): string
    {
        return static::randomElement(static::$names);
    }
}
