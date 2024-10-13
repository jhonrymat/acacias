<div x-data="{ showModal: @entangle('showForm') }">
    <!-- Botón para abrir el modal -->
    <button @click="showModal = true" class="px-4 py-2 bg-blue-500 text-white rounded">Agregar Dirección</button>

    <!-- Modal de Direcciones -->
    <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" x-cloak>
        <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
            <div class="modal-header">
                <h5 class="text-lg font-bold">Seleccione su dirección</h5>
                <button @click="showModal = false" class="btn-close">✖</button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Tipo de vía -->
                        <select wire:model="tipoViaPrimaria" class="form-select">
                            <option value="">Tipo de vía</option>
                            <option value="AC">Avenida calle</option>
                            <option value="AK">Avenida carrera</option>
                            <option value="CL">Calle</option>
                            <option value="KR">Carrera</option>
                            <option value="DG">Diagonal</option>
                            <option value="TV">Transversal</option>
                        </select>

                        <!-- Número de vía principal -->
                        <input wire:model="numeroViaPrincipal" type="text" class="form-control" placeholder="Número">

                        <!-- Letra de vía principal -->
                        <select wire:model="letraViaPrincipal" class="form-select">
                            <option value="">Letra</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>

                        <!-- BIS y letra BIS -->
                        <select wire:model="bis" class="form-select">
                            <option value="">Bis</option>
                            <option value="BIS">BIS</option>
                        </select>
                        <select wire:model="letraBis" class="form-select">
                            <option value="">Letra Bis</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>

                        <!-- Cuadrante -->
                        <select wire:model="cuadranteViaPrincipal" class="form-select">
                            <option value="">Cuadrante</option>
                            <option value="SUR">SUR</option>
                            <option value="ESTE">ESTE</option>
                        </select>

                        <!-- Número de vía generadora -->
                        <input wire:model="numeroViaGeneradora" type="text" class="form-control" placeholder="No.">

                        <!-- Letra de vía generadora -->
                        <select wire:model="letraViaGeneradora" class="form-select">
                            <option value="">Letra</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>

                        <!-- Número de placa -->
                        <input wire:model="numeroPlaca" type="text" class="form-control" placeholder="Número placa">

                        <!-- Cuadrante de vía generadora -->
                        <select wire:model="cuadranteViaGeneradora" class="form-select">
                            <option value="">Cuadrante</option>
                            <option value="SUR">SUR</option>
                            <option value="ESTE">ESTE</option>
                        </select>

                        <!-- Selección de barrio -->
                        <div class="col-span-3">
                            <label for="barrio_id" class="block text-sm font-medium">Barrio</label>
                            <select wire:model="barrio_id" class="form-select w-full">
                                <option value="">Selecciona un barrio</option>
                                @foreach ($barrios as $barrio)
                                    <option value="{{ $barrio->id }}">{{ $barrio->nombreBarrio }}</option>
                                @endforeach
                            </select>
                            @error('barrio_id')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Dirección generada -->
                    <div class="mt-4">
                        <label for="direccionCompleta" class="block text-sm font-medium">Dirección Generada:</label>
                        <input type="text" wire:model="direccionCompleta" class="form-control" readonly>
                    </div>

                    <div class="flex justify-end space-x-2 mt-4">
                        <!-- Botón para cerrar el modal -->
                        <button type="button" @click="showModal = false"
                            class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
                        <!-- Botón para guardar el formulario -->
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Aceptar</button>
                        <!-- Botón para limpiar el formulario -->
                        <button type="button" wire:click="resetForm"
                            class="px-4 py-2 bg-yellow-500 text-white rounded">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
