<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linkup Feed</title>
    {{-- Load Tailwind & Icons --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/559afa4763.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    {{-- Google Font (Poppins/Inter lookalike) --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F0F2F5] text-slate-800">

    {{-- Main Container --}}
    <div class="max-w-[1600px] mx-auto min-h-screen flex justify-center p-6 gap-8">

        {{-- 1. SIDEBAR SECTION (Fixed width) --}}
        <aside class="w-64 hidden lg:block shrink-0 sticky top-6 h-screen overflow-y-auto">
            @include('components.sidebar')
        </aside>

        {{-- 2. MAIN FEED SECTION (Grow to fill space) --}}
        <main class="w-full max-w-2xl">
            @include('components.navbar')

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- 3. RIGHT WIDGETS (Placeholder for now) --}}
        <aside class="w-80 hidden xl:block shrink-0 sticky top-6">
        </aside>

    </div>

</body>

</html>
