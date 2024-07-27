<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Helyszín szerkesztése</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4">
    @if (Route::has('login'))
        @auth
        <div class="w-full flex justify-center absolute -z-10 top-0 left-0">
            <img class="mt-8 w-[30rem]  opacity-[3%]" src="{{ asset('images/swords.svg') }}" alt="swords for decoration">
        </div>
        @if (Auth::User()->admin)
            <a class="btn btn-neutral btn-sm absolute top-2 left-2" href="/places">Vissza</a>
            <h1 class="text-3xl text-center">Helyszín szerkesztése</h1>
            <div class="flex justify-center">
                <form class="w-[40rem]" method="POST" action="{{route('places.update', ['id' => $place->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mt-4 mb-8">
                        <div>
                            <label class="text-xl" for="image">Új kép megadása(nem kötelező)</label>
                        </div>
                        <input class="mt-2 @error('image') text-red-500 @enderror " type="file" id="image" name="image" accept="image/*">
                    </div>
                    <label class="text-xl" for="name">Név</label>
                    <input
                        type="text"
                        placeholder="Név"
                        class="mb-2 input input-bordered w-full @error('name') input-error @enderror"
                        name="name"
                        id="name"
                        value="{{ old('name', $place->name ?? '') }}"
                    />
                    @error('name')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                        @enderror
                    <button class="btn" type="submit" class="">Mentés</button>
                </form>
            </div>
            @else
                <p class="text-center mt-32">bocsika :( nem vagy admin</p>
            @endif
        @else
            <?php header("Location: /login"); exit(); ?>
        @endauth
    @endif
</body>
</html>