
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouvel emprunt</h2>
    </div>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('emprunts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="livre_id" class="block text-gray-700">Choisir un livre :</label>
                    <select name="livre_id" id="livre_id" class="w-full border-gray-300 rounded mt-1">
                        @foreach($livres as $livre)
                            <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                        @endforeach
                    </select>
                    @error('livre_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Emprunter</button>
            </form>
        </div>
    </div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouvel emprunt</h2>
    </div>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('emprunts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="livre_id" class="block text-gray-700">Choisir un livre :</label>
                    <select name="livre_id" id="livre_id" class="w-full border-gray-300 rounded mt-1">
                        @foreach($livres as $livre)
                            <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                        @endforeach
                    </select>
                    @error('livre_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Emprunter</button>
            </form>
        </div>
    </div>
