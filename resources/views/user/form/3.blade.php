<div class="text-center">
    <h4 class="mb-3">Asal Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=3>
        @foreach ($kategories as $k)
            <button type="submit" name="ck_id" value="{{ $k->id }}" class="btn btn-app btn-lg white
                {{ $k->id == 1 ? 'bg-blue' : '' }}
                {{ $k->id == 2 ? 'bg-orange' : '' }}
                {{ $k->id == 3 ? 'bg-teal' : '' }}
                ">
                @if($k->id == 1) <i class="fas fa-users"></i>@endif
                @if($k->id == 2) <i class="fas fa-address-card"></i>@endif
                @if($k->id == 3) <img src="/img/logo.png" alt="Logo" class="mb-1" width="60%" height="70%">@endif
                {{ $k->name }}
            </button>
        @endforeach
    </form>
</div>
