<!DOCTYPE html>
<html>

<head>
    <title>Create Employee</title>
</head>

<body>
    <h1>Create Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form
data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
        <br>
        <button type="submit">Create</button>
    </form>
</body>

</html>