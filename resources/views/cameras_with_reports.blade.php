<x-app-layout>
    @section('slot')
    <div class="container">
        <h1>Cámaras con Reportes</h1>
        
        @if($cameras->isEmpty())
            <p>No hay cámaras con reportes.</p>
        @else
            <ul>
                @foreach($cameras as $camera)
                    <li>
                        {{ $camera->name }} - {{ $camera->reports->count() }} reportes
                        <ul>
                            @foreach($camera->reports as $report)
                                <li>{{ $report->description }} - {{ $report->status }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @endif
        
        <a href="{{ route('dashboard') }}">Regresar al Dashboard</a>
    </div>
</x-app-layout>
