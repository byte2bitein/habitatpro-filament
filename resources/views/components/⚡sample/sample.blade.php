<div>
    {{-- It is never too late to be what you might have been. - George Eliot --}}
    @if (!$name)
        {
        <h1 class="text-white">Welcome</h1>
        }
    @else
        {
        <h1 class="text-white">Welcome, {{ $name }}</h1>
        }
    @endif
</div>
