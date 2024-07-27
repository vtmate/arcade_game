<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Karakter</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if (Route::has('login'))
        @auth
            <h1 class="text-5xl text-center font-bold my-4">Mérkőzés oldal</h1>
            <div class="flex justify-center">
                <div>
                    <ul>
                        <li class="text-3xl font-bold text-green-700">{{$character->name}}</li>
                        <li class="flex justify-between">
                            <p>Védekezés:</p>
                            <p>{{$character->defence}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Erő:</p>
                            <p>{{$character->strength}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Pontosság:</p>
                            <p>{{$character->accuracy}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Mágia:</p>
                            <p>{{$character->id}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Életpont:</p>
                            <p>{{$contest->getCharacterHp($contest->id)}}/20</p>
                        </li>
                    </ul>
                    @if($contest->getCharacterHp($contest->id) == 0)
                        <p class="z-10 text-9xl absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 text-red-600">Vége</p>
                        <div class="absolute top-0 left-0 w-full h-full bg-zinc-900/75"></div>
                    @elseif ($contest->getEnemyHp($contest->id) == 0)
                        <p class="z-10 text-9xl absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 text-green-600">Vége</p>
                        <div class="absolute top-0 left-0 w-full h-full bg-zinc-900/75"></div>
                    @else
                    <div class="mt-8">
                        <a class="block btn btn-sm mt-4 h-4 pt-1 bg-yellow-800 border-[4px] border-yellow-600" href="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'melee', 'character' => $character]) }}">Melee</a>
                        <a class="block btn btn-sm mt-4 h-4 pt-1 bg-slate-700 border-[4px] border-slate-500" href="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'ranged', 'character' => $character]) }}">Range</a>
                        <a class="block btn btn-sm mt-4 h-4 pt-1 bg-purple-950 border-[4px] border-purple-700" href="{{ route('contest.attack', ['contest' => $contest, 'attackType' => 'special', 'character' => $character]) }}">Special</a>
                    </div>
                    @endif
                    <a class="btn btn-neutral btn-sm absolute top-2 left-2 z-20" href="/character/{{$character->id}}">Vissza</a>
                </div>
                <img class="mx-8 w-[25rem] rounded-xl" src="{{ asset('images/' . $contest->place->image . '.jpg') }}" alt="image of place">
                <div>
                    <ul>
                        <li class="text-3xl font-bold text-red-700">{{$enemy->name}}</li>
                        <li class="flex justify-between">
                            <p>Védekezés:</p>
                            <p>{{$enemy->defence}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Erő:</p>
                            <p>{{$enemy->strength}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Pontosság:</p>
                            <p>{{$enemy->accuracy}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Mágia:</p>
                            <p>{{$enemy->magic}}</p>
                        </li>
                        <li class="flex justify-between">
                            <p>Életpont:</p>
                            <p>{{$contest->getEnemyHp($contest->id)}}/20</p>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <?php header("Location: /login"); exit(); ?>
        @endauth
    @endif
</body>
</html>