
<h1>Liste des abonnements</h1>

<table>
    <tr>
        <th>User</th>
        <th>Type</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Statut</th>
    </tr>
    @foreach($subscriptions as $sub)
    <tr>
        <td>{{ $sub->user->name }}</td>
        <td>{{ $sub->type }}</td>
        <td>{{ $sub->date_debut->format('d/m/Y') }}</td>
        <td>{{ $sub->date_fin->format('d/m/Y') }}</td>
        <td>{{ $sub->statut }}</td>
    </tr>
    @endforeach
</table>
