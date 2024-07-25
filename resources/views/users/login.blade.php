<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container mx-auto p-4">
        <h1>Login</h1>
        @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('users.login') }}">
            @csrf
            <div class="mb-4">
                <label for="e-mail" class="block text-gray-700">E-mail:</label>
                <input type="email" id="e-mail" name="email" value="{{ old('e-mail') }}" required class="border border-gray-300 p-2 rounded w-full">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" required class="border border-gray-300 p-2 rounded w-full">
            </div>
            <button type="submit">Login</button>
        </form>  
    </div> 

</body>

</html>