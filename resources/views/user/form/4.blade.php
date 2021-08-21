<div class="text-center">
    <h4 class="mb-3">Data Calon Siswa</h4>
    <form role="form" method="POST" action="{{ route('add.calon') }}">
        @csrf
        <input type="hidden" name="step" value=4>
        EKO
    </form>
</div>
