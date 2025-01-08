<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between">
                <div class="flex space-x-4">
                    <a href="{{ route('customers.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('customers.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-white' }}">
                        Customers
                    </a>
                    <a href="{{ route('products.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-white' }}">
                        Products
                    </a>
                    <a href="{{ route('bills.index') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('bills.*') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-700 hover:text-white' }}">
                        Bills
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html> 