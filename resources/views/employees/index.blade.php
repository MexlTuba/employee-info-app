<!DOCTYPE html>
<html>

<head>
    <title>Employees</title>
</head>

<body>
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}">Create New Employee</a>
    @if(session('success'))
    <p>{{ session('success') }}</p>
    @endif
    <ul>
        @foreach($employees as $employee)
        <li>
            <p>Name: {{ $employee->name }}</p>
            <p>Email: {{ $employee->email }}</p>
            @if($employee->photo)
            <img src="{{ Storage::disk('employee_photos')->url($employee->photo) }}" alt="{{ $employee->name }}" width="100">
            @endif
            <br>
            <a href="{{ route('employees.show', $employee->id) }}">View Details</a>
        </li>
        @endforeach
    </ul>
</body>

</html>