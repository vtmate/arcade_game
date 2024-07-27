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
<body class="p-4">
    @if (Route::has('login'))
        @auth
            <div class="w-full flex justify-center absolute -z-10 top-0 left-0">
                <img class="mt-8 w-[30rem]  opacity-[3%]" src="{{ asset('images/swords.svg') }}" alt="swords for decoration">
            </div>
            <a class="btn btn-neutral btn-sm absolute top-2 left-2" href="/characters">Vissza</a>
            <h1 class="text-3xl text-center">Új karakter létrehozása</h1>
            <div class="flex justify-center">
                <form class="w-[40rem]" method="POST" action="{{route('characters.store')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <label class="text-xl" for="name">Név</label>
                    <input
                        type="text"
                        placeholder="Név"
                        class="mb-2 input input-bordered w-full @error('name') input-error @enderror"
                        name="name"
                        id="name"
                        value="{{ old('name', '') }}"
                    />
                    @error('name')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                        @enderror

                    <label class="text-xl" for="defence">Védekezés</label>
                    <input
                        type="number"
                        placeholder="Védekezés"
                        class="mb-2 input input-bordered w-full @error('defence') input-error @enderror"
                        name="defence"
                        id="defence"
                        value="{{ old('defence', '') }}"
                    />
                    @error('defence')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                    @enderror

                    <label class="text-xl" for="strength">Erő</label>
                    <input
                        type="number"
                        placeholder="Erő"
                        class="mb-2 input input-bordered w-full @error('strength') input-error @enderror"
                        name="strength"
                        id="strength"
                        value="{{ old('strength', '') }}"
                    />
                    @error('strength')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                    @enderror

                    <label class="text-xl" for="accuracy">Pontosság</label>
                    <input
                    type="number"
                        placeholder="Pontosság"
                        class="mb-2 input input-bordered w-full @error('accuracy') input-error @enderror"
                        name="accuracy"
                        id="accuracy"
                        value="{{ old('accuracy', '') }}"
                    />
                    @error('accuracy')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                    @enderror
                    
                    <label class="text-xl" for="magic">Mágia</label>
                    <input
                        type="number"
                        placeholder="Mágia"
                        class="mb-2 input input-bordered w-full @error('magic') input-error @enderror"
                        name="magic"
                        id="magic"
                        value="{{ old('magic', '') }}"
                    />
                    @error('magic')
                        <div class="">
                            <span class="">{{ $message }}</span>
                        </div>
                    @enderror
                    
                    @if (Auth::user()->admin)
                    <div class="w-full flex justify-center">
                        <label class="text-xl mr-8" for="enemy">Ellenfél</label>
                        <input
                            type="checkbox"
                            class="mb-2 toggle w-12"
                            name="enemy"
                            id="enemy"
                            {{ old('enemy') ? 'checked' : '' }}
                        >
                    </div>
                    @endif
                    @error('sum')
                        <div class="mb-2">
                            <span class="text-red-400">{{ $message }}</span>
                        </div>
                    @enderror
                <button class="btn" type="submit" class="">Mentés</button>
            </form>
        </div>
        @else
            <?php header("Location: /login"); exit(); ?>
        @endauth
    @endif
</body>
</html>