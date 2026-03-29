<h1>Admin Dashboard</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
            <td>
                <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">
                        {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                    </button>
                </form>
            </td>
        </tr>
    @endforeach


    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Se déconnecter</button>
</form>
</table>