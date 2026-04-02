
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Emprunts</h2>
</div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('emprunts.create') }}" class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                Emprunter un livre
            </a>

          

@foreach($emprunts as $emprunt)
    <p>
        Livre: {{ $emprunt->livre->titre }}

        @if(!$emprunt->date_retour)
            <form action="{{ route('emprunts.retour', $emprunt->id) }}" method="POST">
                @csrf
                <button type="submit">Retourner</button>
            </form>
        @else
            <span>Déjà retourné</span>
        @endif
    </p>
@endforeach

