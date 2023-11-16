@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Student Listing') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="text-right">
                            <form action="/dashboard" method="POST">
                                @csrf
                                <label for="email">Email address</label>

                                <input id="email" name="email" type="email"
                                    value="@isset($email)
                                        {{ $email }}
                                    @endisset"
                                    class="@error('email') is-invalid @else is-valid @enderror">

                                <button type="submit" name="filter" class="btn-primary">Search</button>
                            </form>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="d-none d-md-table-cell">#</th>
                                    <th scope="col" class="d-none d-md-table-cell">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Course</th>
                                    <th scope="col" class="d-none d-md-table-cell">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <th scope="row" class="d-none d-md-table-cell">{{ $student->id }}</th>
                                        <td class="d-none d-md-table-cell">{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            @foreach ($student->courses as $course)
                                                <span class="badge badge-pill badge-primary px-2 py-1">
                                                    {{ $course->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="d-none d-md-table-cell">{{ $student->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
