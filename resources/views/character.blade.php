<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Karakter</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @if (Route::has('login'))
        @auth
            <div class=" w-full flex justify-center absolute -z-10 top-0 left-0">
                <img class="mt-8 w-[30rem] opacity-[3%]" src="{{ asset('images/swords.svg') }}" alt="swords for decoration">
            </div>
            <a class="btn btn-neutral btn-sm absolute top-2 left-2" href="/characters">Vissza</a>
            <h1 class="text-3xl text-center mt-16">Karakter részletei oldal</h1>
            <section class="flex justify-center">
                <div class="w-[20rem] mt-8">
                    <div>
                        <div class="flex justify-between mb-2">
                            <p class="inline text-xl mr-4">név: </p>
                            <p class="inline kbd px-6">{{ $character->name }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="inline text-xl mr-4">védekezés: </p>
                            <p class="inline kbd px-6">{{ $character->defence }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="inline text-xl mr-4">erő: </p>
                            <p class="inline kbd px-6">{{ $character->strength }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="inline text-xl mr-4">pontosság:</p>
                            <p class="inline kbd px-6"> {{ $character->accuracy }}</p>
                        </div>
                        <div class="flex justify-between mb-2">
                            <p class="inline text-xl mr-4">mágia: </p>
                            <p class="inline kbd px-6">{{ $character->magic }}</p>
                        </div>               
                    </div>
                </div>
            </section>
            <div class="flex justify-center mt-4">
                <a class="btn btn-neutral " href="/character/{{ $character->id }}/edit">Szerkesztés</a>
                <form method="POST" action="{{ route('characters.destroy', ['id' => $character->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="ml-4 btn" type="submit">Törlés</button>
                </form>
            </div>
            <section class="flex justify-center">
                <div class="w-[30rem] mt-8">
                    
                    @if ($character->enemy)
                        <p class="text-xl text-center">Ellenféllel nem lehet játszani</p>
                    @else
                        <h2 class="text-xl">Karakter mérkőzései</h2>
                        <div class="px-8 mt-4 w-full flex justify-between">
                            <p class="inline text-xl">helyszín</p>
                            <p class="inline text-xl">ellenfél</p>
                        </div>
                        
                        @foreach ($contests as $contest)
                        <div class="flex justify-between">
                            <div class="mr-2 mt-2 w-full flex justify-between">
                                <p class="inline kbd">{{$contest->place->name}}</p>
                                <p class="inline kbd">{{$contest->getEnemy($contest->id)->name}}</p>
                            </div>
                            {{-- {{dd($character->name)}} --}}
                            <a class="btn btn-neutral btn-sm mt-2" href="{{ route('contests.show', ['contest' => $contest, 'character' => $character]) }}">&#8594;</a>
                        </div>
                        @endforeach
                        <form class="flex justify-center mt-4 mb-12" method="POST" action="{{route('contests.store', ['character' => $character])}}" enctype="multipart/form-data">
                            @csrf
                            <button class="btn btn-neutral w-full" type="submit" class="">Új mérkőzés</button>
                        </form>
                    @endif
                </div>
            </section>
        @else
            <?php header("Location: /login"); exit(); ?>
        @endauth
    @endif
</body>
</html>