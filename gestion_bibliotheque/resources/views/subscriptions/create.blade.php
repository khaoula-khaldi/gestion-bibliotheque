
<h1>Créer un abonnement</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('subscriptions.store') }}" method="POST">
    @csrf
    <label>User:</label>
    <select name="user_id">
            <option value="{{ $user->id }}">{{ $user->name }}</option>
      
    </select>

    <label>Type:</label>
    <select name="type">
        <option value="mensuel">Mensuel</option>
        <option value="annuel">Annuel</option>
    </select>

    <button type="submit">Créer</button>
</form>
