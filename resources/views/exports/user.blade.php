<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No. Handphone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
