
<x-app-layout>
    <!-- Enlazar la hoja de estilo personalizada -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente Roboto -->
 
      

    <div class="sidebar">
        <h3 class="menu-title">
            <i class="fas fa-bars"></i> Menu
        </h3>
        
        <div class="user-welcome">
            <i class="fas fa-user-circle"></i> <!-- Icono de usuario -->
            <span>Bienvenido: {{ auth()->user()->name }}</span> <!-- Nombre del usuario -->
        </div>
    
        <ul>
            <li><a href="#"> <i class="fa-solid fa-triangle-exclamation"></i> Reportes </a></li>
            <li><a href="#"> <i class="fa-solid fa-location-dot"></i> Añadir Camara</a></li>
            <li><a href="#"><i class="fa-regular fa-circle-check"></i> Tickets</a></li>
            <li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion</a></li>
            <!-- Aquí podrás añadir más opciones más adelante -->
        </ul>
    </div>
    
    <x-slot name="header">
        <div class="header-container">
            <i class="fa-solid fa-fingerprint" id="header-icon"></i> <!-- Ícono de videovigilancia -->
            <h2 class="header-title">{{ __('Sistema') }}</h2> 
        </div>
    </x-slot>
    
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
                <!-- Mensaje de éxito como modal -->
                @if(session('success'))
                    <div id="success-modal" class="fixed inset-0 flex items-center justify-center z-50">
                        <div class="bg-green-500 text-white p-4 rounded-md shadow-lg">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
    
    
                 <!-- Barra de búsqueda para buscar cámaras -->
    
                
                <input type="text" id="search-input" class="search-bar" style="height: 40px; width: 300px;" placeholder=" Buscar cámara...">
                
    
                <!-- Contenedor del mapa -->

                <div class="p-4">
                    <i class="fa-solid fa-map-location-dot map-icon"></i> <!-- Ícono de verificación -->
                    <h3 class="map-title">Mapa</h3> <!-- Título del mapa -->
                    <div id="map" style="height: 700px; width: 1400px;" class="rounded"></div>
                </div>
                
    
                <!-- Contenedor de formularios para añadir reporte y nueva cámara -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    
                    <!-- Sección para añadir reporte de cámara -->
                    <div class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-lg p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ __('Añadir Reporte de Cámara') }}</h3>
                        <form method="POST" action="{{ route('reports.store') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="camera_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Seleccionar Cámara') }}</label>
                                <select name="camera_id" id="camera_id" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                                    @foreach ($cameras as $camera)
                                        <option value="{{ $camera->id }}">{{ $camera->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Descripción del problema') }}</label>
                                <textarea name="description" id="description" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2"></textarea>
                            </div>
                            <div class="mb-2">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Estado del problema') }}</label>
                                <select name="status" id="status" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                                    <option value="Pendiente">{{ __('Pendiente') }}</option>
                                    <option value="Solucionado">{{ __('Solucionado') }}</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="reported_at" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Fecha del reporte') }}</label>
                                <input type="date" name="reported_at" id="reported_at" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-md">{{ __('Añadir Reporte') }}</button>
                        </form>
                    </div>
    
                    <!-- Sección para añadir nueva cámara -->
                    <div class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-lg p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ __('Añadir Nueva Cámara') }}</h3>
                        <form method="POST" action="{{ route('cameras.store') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Nombre de la cámara') }}</label>
                                <input type="text" name="name" id="name" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mb-2">
                                <label for="latitude" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Latitud') }}</label>
                                <input type="text" name="latitude" id="latitude" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mb-2">
                                <label for="longitude" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Longitud') }}</label>
                                <input type="text" name="longitude" id="longitude" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                            </div>
                            <div class="mb-2">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Estatus') }}</label>
                                <select name="status" id="status" class="block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2">
                                    <option value="Operativa">{{ __('Operativa') }}</option>
                                    <option value="Fuera de Servicio">{{ __('Fuera de Servicio') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-md">{{ __('Añadir Cámara') }}</button>
                        </form>
                    </div>
    
                </div>
            </div>
        </div>
    
        <script>
            // Cargar el mapa de OpenStreetMap en el contenedor 'map'
            var map = L.map('map').setView([19.3139, -98.2404], 13); // Coordenadas de Tlaxcala, México
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
    
            // Añadir las cámaras al mapa
            var cameras = @json($cameras);
            cameras.forEach(function(camera) {
                L.marker([camera.latitude, camera.longitude]).addTo(map)
                    .bindPopup(camera.name + ' - ' + camera.status);
            });
    
            // Función para buscar y resaltar una cámara en el mapa
            document.getElementById('search-input').addEventListener('input', function() {
                var searchQuery = this.value.toLowerCase();
                
                cameras.forEach(function(camera) {
                    var marker = L.marker([camera.latitude, camera.longitude]);
                    if (camera.name.toLowerCase().includes(searchQuery)) {
                        // Resaltar el marcador encontrado
                        map.setView([camera.latitude, camera.longitude], 15); // Zoom al marcador
                        marker.addTo(map).bindPopup(camera.name + ' - ' + camera.status).openPopup();
                    }
                });
            });
    
            // Hacer desaparecer el modal después de 3 segundos
            window.onload = function() {
                var modal = document.getElementById('success-modal');
                if (modal) {
                    setTimeout(function() {
                        modal.style.opacity = '0';
                        setTimeout(function() {
                            modal.style.display = 'none';
                        }, 500); // Esperar que se desvanezca antes de ocultarlo
                    }, 3000); // Tiempo en milisegundos antes de que desaparezca
                }
            }
        </script>
    </x-app-layout>
    