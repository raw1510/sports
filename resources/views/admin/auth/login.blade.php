<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-gray-700">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Admin Login</h2>

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-500/20 border border-red-400 text-red-200 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200">Email Address</label>
                <input type="email" name="email" id="email" 
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-900 text-white placeholder-gray-400 border border-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                       placeholder="admin@example.com" required autofocus>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" id="password" 
                       class="w-full mt-1 px-4 py-2 rounded-lg bg-gray-900 text-white placeholder-gray-400 border border-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                       placeholder="********" required>
            </div>

            <button type="submit" 
                class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl shadow-md transition duration-200 ease-in-out">
                Login
            </button>
        </form>
    </div>
</body>
</html>
