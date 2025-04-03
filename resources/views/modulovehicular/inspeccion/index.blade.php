<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="bg-white dark:bg-gray-800 leading-tight">Inspección Vehicular</h2>
            <a href="{{ route('vehicular.index') }}" class="bg-[#D5AC5B] text-black font-bold py-2 px-4 rounded">
                ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4">Lista de Inspecciones</h2>
                <p class="text-gray-600">Aquí podrás registrar y visualizar inspecciones realizadas a los vehículos.</p>

                <!-- Botón para abrir el modal -->
                <button id="openModal" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-md shadow-md">
                    Nueva Inspección
                </button>
            </div>
        </div>
    </div>

    <!-- Modal con Scroll Interno -->
    <div id="inspectionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white dark:bg-gray-700 p-6 rounded-md w-1/2 max-h-[80vh] overflow-y-auto">
            <h3 class="text-2xl font-bold mb-4">Registrar Inspección Vehicular</h3>
            <form action="{{ route('inspeccion.store') }}" method="POST">
                @csrf


                 <!-- Datos Generales -->
                 <div class="mb-4">
                    <label class="block font-semibold">Fecha</label>
                    <input type="date" name="fecha" class="mt-2 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Folio</label>
                    <input type="text" id="folio" name="folio" class="mt-2 w-full border-gray-300 rounded-md" readonly required>
                </div>

                <script>
                    document.getElementById('openModal').addEventListener('click', function() {
                    document.getElementById('inspectionModal').classList.remove('hidden');
        
                     // Generar un folio automático (ejemplo: "FOLIO-20250403-1234")
                    let fecha = new Date();
                    let folio = `FOLIO-${fecha.getFullYear()}${(fecha.getMonth()+1).toString().padStart(2, '0')}${fecha.getDate().toString().padStart(2, '0')}-${Math.floor(1000 + Math.random() * 9000)}`;
        
                     document.getElementById('folio').value = folio;
                 });
                </script>


                <div class="mb-4">
                    <label class="block font-semibold">Placas</label>
                    <input type="text" name="placas" class="mt-2 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Kilometraje</label>
                    <input type="number" name="kilometraje" class="mt-2 w-full border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                <label class="block">Sede</label>
                    <select name="luces_faro" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Cerdis">Cedis</option>
                        <option value="Hielo">Hielo</option>
                        <option value="C21">C21</option>
                        <option value="M12">M12</option>
                        <option value="AXXa">AXXA</option>
                        <option value="42Bermon">42Bermon</option>
                        <option value="Bermon">Bermon</option>

                    </select>
                
                </div>

                <!-- Luces -->
                <div class="mb-4">
                    <h4 class="font-semibold">Luces</h4>
                    <label class="block">Faro principal delantero (alta y baja)</label>
                    <select name="luces_faro" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Faros de niebla</label>
                    <select name="luces_niebla" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Luces Traseras</label>
                    <select name="luces_traseras" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Intermitentes</label>
                    <select name="luces_intermitentes" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Direccionales</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <h4 class="font-semibold">Interiores</h4>
                    <label class="block">Portavasos</label>
                    <select name="llanta_refaccion" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Encendedor</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Tapetes</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Estero</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Antena</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Claxon Operando</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Luces Interiores</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Clima Funcional</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <!-- Estado de llantas -->
                <div class="mb-4">
                    <h4 class="font-semibold">Estado de llantas</h4>
                    <label class="block">Llanta de refacción</label>
                    <select name="llanta_refaccion" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block">Llantas</label>
                    <select name="luces_direccionales" class="mt-2 w-full border-gray-300 rounded-md">
                        <option value="Sin detección">Sin detección</option>
                        <option value="Con detección">Con detección</option>
                        <option value="N/A">N/A</option>
                    </select>
                </div>

                <!-- Agregar más campos aquí -->

                <div class="mb-4">
                     <h4 class="text-lg font-semibold">Seguridad Vial</h4>
                     <div class="grid grid-cols-2 gap-4">
                     <label class="flex items-center">
                        <input type="checkbox" name="dado_birlo_seguridad" class="mr-2">
                         Dado de birlo de seguridad
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="birlos_seguridad" class="mr-2">
                        Birlos de seguridad
                        </label>
        <label class="flex items-center">
            <input type="checkbox" name="gato_mecanico" class="mr-2">
            Gato mecánico
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="kit_inflado" class="mr-2">
            Kit de inflado
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="compresor_auxiliar" class="mr-2">
            Compresor auxiliar
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="triangulo_seguridad" class="mr-2">
            Triángulo de seguridad plegable
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="extintor" class="mr-2">
            Extintor verificado
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="llave_L" class="mr-2">
            Llave L
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="cables_auxiliares" class="mr-2">
            Cables auxiliares
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="estuche_herramientas" class="mr-2">
            Estuche de herramientas
        </label>
    </div>
</div>

<div class="mb-4">
    <h4 class="text-lg font-semibold">Botiquín</h4>
    <label class="flex items-center">
        <input type="checkbox" name="botiquin" class="mr-2">
        Botiquín de primeros auxilios
    </label>
</div>

<div class="mb-4">
    <h4 class="text-lg font-semibold">Documentos</h4>
    <div class="grid grid-cols-2 gap-4">
        <label class="flex items-center">
            <input type="checkbox" name="estuche_manual" class="mr-2">
            Estuche de manual
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="tarjeta_circulacion" class="mr-2">
            Tarjeta o permiso de circulación
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="fumigacion_vigente" class="mr-2">
            Fumigación vigente
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="tarjeta_gasolina" class="mr-2">
            Tarjeta de gasolina
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="tag_telepeaje" class="mr-2">
            TAG Telepeaje
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="poliza_seguro" class="mr-2">
            Póliza de seguro
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="licencia_chofer" class="mr-2">
            Licencia vigente del chofer
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="ine_chofer" class="mr-2">
            INE del chofer
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="credencial_chofer" class="mr-2">
            Credencial del chofer
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="placas" class="mr-2">
            Placas
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="talon_verificacion" class="mr-2">
            Talón de verificación
        </label>
        <label class="flex items-center">
            <input type="checkbox" name="engomado_placas" class="mr-2">
            Engomado de placas
        </label>
    </div>
</div>

<div class="mb-4">
    <h4 class="text-lg font-semibold">Estado de Rines</h4>
    <label class="flex items-center">
        <input type="checkbox" name="rines" class="mr-2">
        Rines en buen estado
    </label>
    <label class="flex items-center">
        <input type="checkbox" name="rin_refaccion" class="mr-2">
        Rin de refacción disponible
    </label>
</div>

<div class="mb-4">
    <h4 class="text-lg font-semibold">Detección de Factores</h4>
    <label class="block">Se detectó algún factor:</label>
    <input type="text" name="factor_detectado" class="mt-2 w-full border-gray-300 rounded-md">
</div>

<!-- Firmas -->
<div class="mb-4">
    <h4 class="text-lg font-semibold">Firmas</h4>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block">Nombre y firma del chofer</label>
            <input type="text" name="firma_chofer" class="mt-2 w-full border-gray-300 rounded-md">
        </div>
        <div>
            <label class="block">Nombre y firma del supervisor</label>
            <input type="text" name="firma_supervisor" class="mt-2 w-full border-gray-300 rounded-md">
        </div>
    </div>
</div>

<div class="mb-4">
    <h4 class="text-lg font-semibold">Estado del Tanque de Gas</h4>
    <label class="block">Seleccione el nivel actual:</label>
    <select name="estado_tanque_gas" class="mt-2 w-full border-gray-300 rounded-md">
        <option value="lleno">Lleno</option>
        <option value="3_4">3/4</option>
        <option value="1_2">1/2</option>
        <option value="1_4">1/4</option>
        <option value="vacio">Vacío</option>
    </select>
</div>


                <!-- Botones de acción -->
                <div class="mt-4 flex justify-end">
                    <button type="button" id="closeModal" class="bg-gray-400 text-white px-6 py-2 rounded-md mr-2">Cancelar</button>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar el modal
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('inspectionModal').classList.remove('hidden');
        });

        // Cerrar el modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('inspectionModal').classList.add('hidden');
        });
    </script>
</x-app-layout>
