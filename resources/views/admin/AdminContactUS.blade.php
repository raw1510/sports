<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Inquiries - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brown: {
                            50: '#faf6f2',
                            100: '#f3ebe3',
                            200: '#e4d3c3',
                            300: '#d3b79d',
                            400: '#b98e6c',
                            500: '#8b5e34',
                            600: '#734a27',
                            700: '#5a3a20',
                            800: '#422a19',
                            900: '#2d1d12',
                        }
                    }
                }
            }
        }
    </script>
    
</head>
<body class="min-h-screen bg-brown-50 text-brown-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('components.admin.navbar') 

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
                @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
            <div class="max-w-7xl mx-auto">
                <!-- Page Header -->
                <div class="mb-6 flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-brown-800">📬 Contact Inquiries</h1>
                </div>

                <!-- Pending Inquiries Section -->
                <div class="mb-8">
    <h2 class="text-xl font-semibold text-brown-700 mb-4">Pending Inquiries</h2>
    <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-brown-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-brown-200">
                <thead class="bg-brown-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Full Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Age</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Disability Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Contact Number</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Information Request</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Submitted At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-100">
                    @forelse($pendingInquiries as $inquiry)
    <tr class="hover:bg-brown-50 transition">
        <td class="px-4 py-3 text-sm">{{ $inquiry->id }}</td>
        <td class="px-4 py-3 text-sm font-medium text-brown-900">{{ $inquiry->full_name }}</td>
        <td class="px-4 py-3 text-sm">{{ $inquiry->age }}</td>
        <td class="px-4 py-3 text-sm">{{ $inquiry->disability_type }}</td>
        <td class="px-4 py-3 text-sm">{{ $inquiry->contact_number }}</td>
        <td class="px-4 py-3 text-sm">{{ Str::limit($inquiry->information_request, 50) }}</td>
        <td class="px-4 py-3 text-sm text-brown-600">{{ $inquiry->created_at->format('d M Y, h:i A') }}</td>
        <td class="px-4 py-3 text-sm">
            <form action="{{ route('admin.contact.close', $inquiry->id) }}" method="POST">
                @csrf
                <button type="submit" class="text-sm bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition">Close</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="px-4 py-6 text-center text-brown-600">
            No pending inquiries found.
        </td>
    </tr>
@endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination for Pending -->
        <div class="p-4 border-t border-brown-200 bg-brown-50">
            {{ $pendingInquiries->links() }}
        </div>
    </div>
</div>

                <!-- Closed Inquiries Section -->
                <div>
    <h2 class="text-xl font-semibold text-brown-700 mb-4">Closed Inquiries</h2>
    <div class="bg-white shadow-md rounded-2xl overflow-hidden border border-brown-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-brown-200">
                <thead class="bg-brown-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Full Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Age</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Disability Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Contact Number</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Information Request</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Submitted At</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-brown-700">Closed At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-100">
                    @forelse($closedInquiries as $inquiry)
                        <tr class="hover:bg-brown-50 transition">
                            <td class="px-4 py-3 text-sm">{{ $inquiry->id }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-brown-900">{{ $inquiry->full_name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $inquiry->age }}</td>
                            <td class="px-4 py-3 text-sm">{{ $inquiry->disability_type }}</td>
                            <td class="px-4 py-3 text-sm">{{ $inquiry->contact_number }}</td>
                            <td class="px-4 py-3 text-sm">{{ Str::limit($inquiry->information_request, 50) }}</td>
                            <td class="px-4 py-3 text-sm text-brown-600">{{ $inquiry->created_at->format('d M Y, h:i A') }}</td>
                            <td class="px-4 py-3 text-sm text-brown-600">{{ $inquiry->updated_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-brown-600">
                                No closed inquiries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
<div class="p-4 border-t border-brown-200 bg-brown-50">
            {{ $closedInquiries->links() }}
        </div>
            </div>
        </main>
    </div>
</body>
</html>