@extends('pdf.template_kartuTesAdmin')

@section('isi')
<table class="kartuAdmin"><tr>
@php
    $i = 0;
@endphp
@foreach ($calons as $calonsnya)
    @if($i%2==0 && $i!=0)
    </tr><tr><td width="48%" align="center">
        @include('pdf.kartuTes')
    </td>
    @else
    <td width="48%" align="center">
        @include('pdf.kartuTes')
    </td>
    @endif
    @php $i++; @endphp
@endforeach
</tr></table>
@endsection
