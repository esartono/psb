<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Unit</th>
        <th>No. Pendaftaran</th>
        <th>Nama Lengkap</th>
        <th>Panggilan</th>
        <th>JK</th>
        <th>Alamat Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($calons as $calon)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $calon->calonsnya->gelnya->unitnya->name }}</td>
            <td>{{ $calon->calonsnya->uruts }}</td>
            <td>{{ $calon->calonsnya->name }}</td>
            <td>{{ $calon->calonsnya->panggilan }}</td>
            <td>{{ $calon->calonsnya->kelamin }}</td>
            <td>{{ \App\User::email($calon->calonsnya->user_id) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
