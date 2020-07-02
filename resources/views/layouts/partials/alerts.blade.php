@if (session()->has('alert'))
    @php
        $alert = session()->get('alert');
    @endphp

    <div class="alert alert-{{ $alert['type'] ?? 'default' }}" role="alert">
        {!! $alert['text'] !!}
    </div>
@endif
