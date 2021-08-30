@if(\App\Kelasnya::cjk($cek) === 1)
    <h3>Kelas Putra</h3>
@endif
@if(\App\Kelasnya::cjk($cek) === 2)
    <h3>Kelas Putri</h3>
@endif
