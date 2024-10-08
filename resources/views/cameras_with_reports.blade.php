<x-app-layout>
    @section('content')
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f0f2f5;
            color: #343a40;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 40px;
            color: #212529;
        }

        .card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #495057;
        }

        .report-list {
            list-style: none;
            padding: 0;
        }

        .report-item {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .report-info {
            font-size: 1rem;
            color: #495057;
        }

        .report-status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .btn-solution {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-solution:hover {
            background-color: #218838;
        }

        .solution-form {
            margin-top: 10px;
            padding: 15px;
            background-color: #f1f3f5;
            border-radius: 5px;
            display: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .solution-form textarea, .solution-form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .btn-solution {
                width: 100%;
                padding: 10px;
            }
        }

    </style>

    <div class="container">
        <h1>Cámaras con Reportes</h1>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="message error">
                {{ session('error') }}
            </div>
        @endif

        @if($cameras->isEmpty())
            <p>No hay cámaras con reportes pendientes.</p>
        @else
            @foreach($cameras as $camera)
                <div class="card">
                    <div class="card-header">{{ $camera->name }} - {{ $camera->reports->count() }} Reportes</div>
                    
                    <ul class="report-list">
                        @foreach($camera->reports as $report)
                            <li class="report-item">
                                <div class="report-info">
                                    <p><strong>Descripción:</strong> {{ $report->description }}</p>
                                    <p><strong>Estatus:</strong> <span class="report-status">{{ $report->status }}</span></p>
                                </div>

                                @if($report->status === 'pendiente')
                                    <button class="btn-solution" onclick="toggleForm('form-{{ $report->id }}')">Marcar como Solucionado</button>
                                    <!-- Formulario de actualización -->
                                    <form id="form-{{ $report->id }}" class="solution-form" action="{{ route('reports.update', $report->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <label for="solution">Descripción de la Solución:</label>
                                        <textarea name="solution" id="solution" required></textarea>

                                        <label for="solution_date">Fecha de la Solución:</label>
                                        <input type="date" name="solution_date" id="solution_date" required>

                                        <button type="submit" class="btn-solution">Guardar Solución</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        @endif

    </div>

    <script>
        function toggleForm(formId) {
            const form = document.getElementById(formId);
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
    @endsection
</x-app-layout>
