<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Helyszínek listázása</title>

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
        @if (Auth::User()->admin)
        <h1 class="text-3xl text-center my-4">Helyszínek listázása</h1>
        <a class="btn btn-neutral btn-sm absolute top-2 left-2" href="/characters">Vissza</a>
                <div class="flex justify-center">
                    <div class="w-[30rem] m-2">
                        <div class="grid grid-cols-2 gap-6">
                            @foreach ($places as $place)
                                <div class="relative">
                                    <button class="absolute top-9 left-2 btn btn-sm bg-green-800 text-green-100 border-2 border-gray-500">szerkesztés</button>
                                    <a class="absolute top-9 left-2 btn btn-sm bg-green-800 text-green-100 border-2 border-gray-500" href="/place/{{ $place->id }}/edit">Szerkesztés</a>
                                    <form action="{{ route('places.destroy', $place->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="absolute top-9 right-2 btn btn-sm bg-red-800 text-red-100 border-2 border-gray-500">törlés</button>
                                    </form>
                                    <p class="text-xl">{{ $place->name }}</p>
                                    <img class="rounded-md border-4 border-gray-500" src="{{ asset('images/' . $place->image . '.jpg') }}" alt="image of place">
                                </div>
                            @endforeach

                        </div>
                        <div>
                            <p class="text-xl text-left mt-6">Új helyszín</p>
                            {{-- <form method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data"> --}}
                            <form method="POST" action="{{ route('upload.image') }}" enctype="multipart/form-data">
                                @csrf
                                <input class="mt-2 @error('image') text-red-500 @enderror " type="file" name="image" accept="image/*">
                                <input
                                    type="text"
                                    placeholder="Helyszín neve"
                                    class="my-2 input input-bordered w-full @error('name') input-error @enderror"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', '') }}"
                                />
                                <div class="flex justify-center">
                                    <button class="my-4 btn btn-neutral" type="submit">Fájl feltöltése</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            @else
                <p class="text-center mt-32">bocsika :( nem vagy admin</p>
            @endif
        @endif
    </header>
</body>
</html>