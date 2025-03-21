<div id="error-container">
    @if ($errors->any())
    @foreach ($errors->all() as $e)
        <div>
            {{ $e }}
        </div>
    @endforeach
    @endif
</div>
