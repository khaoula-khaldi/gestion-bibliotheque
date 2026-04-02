

                <a href="{{ route('subscriptions.create') }}"
                   class="inline-block mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                    S'abonner
                </a>
                <br>
                <br>
                <br>
                <br>
                <br>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
