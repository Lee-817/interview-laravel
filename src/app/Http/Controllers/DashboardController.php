<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterStudentRequest;
use App\Models\Student;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', [
            'students' => Student::with('courses')->simplePaginate(5),
        ]);
    }

    public function postDashboard(FilterStudentRequest $request): View
    {
        $query = Student::with('courses');
        $email = request('email');

        if ($email) {
            $query->whereEmail($email);
        }

        return view('dashboard', [
            'students' => $query->simplePaginate(5),
            'email' => $email,
        ]);
    }
}
