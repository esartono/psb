@if(\App\Kelasnya::cjk($cek) === 0)
    &nbsp;
@endif
@if(\App\Kelasnya::cjk($cek) === 1)
    KHUSUS PUTRA
@endif
@if(\App\Kelasnya::cjk($cek) === 2)
    KHUSUS PUTRI
@endif
