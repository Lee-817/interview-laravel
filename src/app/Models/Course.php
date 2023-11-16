<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = ['pivot'];

    /**
     * Get all of the students that belong to the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Student>
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }
}
