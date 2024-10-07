<x-app-layout> 
    @section('content')
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 2.5rem;
            color: #495057;
            text-align: center;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 10px;
        }

        li ul {
            margin-top: 10px;
            margin-left: 20px;
            list-style-type: disc;
        }

        li ul li {
            margin-bottom: 5px;
            color: #495057;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            a {
                width: 100%;
                padding: 12px;
            }
        }
    </style>

    <div class="container">
        <h1>Cámaras con Reportes</h1>
        
        @if($cameras->isEmpty())
            <p>No hay cámaras con reportes.</p>
        @else
            <ul>
                @foreach($cameras as $camera)
                    <li>
                        <strong>{{ $camera->name }}</strong> - {{ $camera->reports->count() }} reportes
                        <ul>
                            @foreach($camera->reports as $report)
                                <li>{{ $report->description }} - <em>{{ $report->status }}</em></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        @endif
        
        <a href="{{ route('dashboard') }}">Regresar al Dashboard</a>
    </div>
</x-app-layout>