<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{Auth::user()->name}} karakterei</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if ($characters && Route::has('login'))
        @auth
        <div class="w-full flex justify-center absolute -z-10 top-0 left-0">
            <img class="mt-8 w-[30rem]  opacity-[3%]" src="{{ asset('images/swords.svg') }}" alt="swords for decoration">
        </div>
        <div class="flex justify-between my-6 mx-12">
            <h1 class="text-3xl">{{Auth::user()->name}} karakterei</h1>
            
            <div class="flex">
                @if (Auth::user()->admin)
                    <a class="mr-4 btn btn-neutral btn-sm" href="/places">helyszínek</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-neutral btn-sm" type="submit">Kijelentkezés</button>
                </form>
            </div>
        </div>
            <div class="ml-24 flex justify-center">
                <div>
                    <p class="inline kbd">védelem</p>
                    <p class="inline kbd">erő</p>
                    <p class="inline kbd">pontosság</p>
                    <p class="inline kbd">mágia</p>
                    @if (Auth::user()->admin)
                        <p class="inline kbd px-6">ellenfél</p>
                    @endif
                </div>
            </div>
            <ul>
                @foreach ($characters as $character)
                    <li class="my-4 flex justify-between mx-48">
                        <p class="inline kbd px-6 p-1">{{ $character->name }}</p>
                        <div>
                            <p class="inline kbd px-6">{{ $character->defence }}</p>
                            <p class="inline kbd px-6">{{ $character->strength }}</p>
                            <p class="inline kbd px-6">{{ $character->accuracy }}</p>
                            <p class="inline kbd px-6">{{ $character->magic }}</p>
                            @if (Auth::user()->admin)
                                @if ($character->enemy)
                                    <p class="inline kbd px-6">igen</p>
                                    @else
                                    <p class="inline kbd px-6">nem</p>
                                @endif
                            @endif
                        </div>
                        <a class="btn btn-neutral btn-sm" href="/character/{{ $character->id }}">megtekint</a>
                    </li>
                @endforeach
            </ul>
            <a class="btn btn-neutral btn-sm ml-48" href="/create">új karakter</a>
        @else
            <?php header("Location: /login"); exit(); ?>
        @endauth
    @endif
</body>
</html>