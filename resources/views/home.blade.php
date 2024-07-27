<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        @if (Route::has('login'))
            <div class="w-full flex justify-center absolute -z-10 top-0 left-0">
                <img class="mt-8 w-[30rem]  opacity-[3%]" src="{{ asset('images/swords.svg') }}" alt="swords for decoration">
            </div>
            <nav class="flex justify-between my-6 mx-12">
                <h1 class="text-xl md:text-3xl">Arcade Game</h1>
                <div>
                    @auth
                    <?php header("Location: /characters"); exit(); ?>
                    @else
                    <a class="btn btn-neutral" href="{{ route('login') }}"> Log in </a>
                    
                    @if (Route::has('register'))
                    <a class="btn btn-neutral ml-2" href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
                </div>
            </nav>
            <div class="flex justify-center">
                <div class="w-[30rem] m-2">
                    <div class="bg-gray-700 p-3 rounded-md mb-2">
                        <p>Az eddigi mérkőzések száma: <b>{{$contestCount}}</b></p>
                        <p>A játékban létrehozott karakterek száma: <b>{{$characterCount}}</b></p>
                    </div>
                    <div class="bg-gray-700 p-3 rounded-md">
                        <p>
                            A "Arcade Game" egy egy játékos módú, körökre osztott, arcade típusú harcolós játék lenne, csak nem sikerült befejezni
                        </p>
                    </div>

                </div>
            </div>
        @endif
    </header>
</body>
</html>