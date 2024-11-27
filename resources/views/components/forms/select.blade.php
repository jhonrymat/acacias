<div x-data="{
    open: false,
    search: '',
    selected: null,
    options: @js($options),

    get filteredOptions() {
        if (this.search === '') {
            return this.options;
        }
        return Object.keys(this.options)
            .filter(key => this.options[key].toLowerCase().includes(this.search.toLowerCase()))
            .reduce((obj, key) => {
                obj[key] = this.options[key];
                return obj;
            }, {});
    },

    selectOption(key) {
        this.selected = key;
        this.search = this.options[key];
        this.open = false;
        $wire.set('id_poblacion', key);
    },

    toggleDropdown() {
        this.open = !this.open;
        this.adjustDropdownPosition();
    },

    adjustDropdownPosition() {
        const rect = this.$refs.searchInput.getBoundingClientRect();
        const dropdownHeight = 240; // Altura estimada del menú desplegable
        const spaceBelow = window.innerHeight - rect.bottom;

        if (spaceBelow < dropdownHeight) {
            // Si el espacio debajo es insuficiente, muestra hacia arriba
            this.$refs.optionsList.style.bottom = `${spaceBelow}px`;
            this.$refs.optionsList.style.top = 'auto';
        } else {
            // Si hay espacio suficiente, muestra hacia abajo
            this.$refs.optionsList.style.top = `${rect.bottom}px`;
            this.$refs.optionsList.style.bottom = 'auto';
        }
    }
}" class="relative">
    <!-- Input visible para buscar y seleccionar -->
    <input
        type="text"
        x-ref="searchInput"
        x-model="search"
        @click="toggleDropdown()"
        @input="open = true; adjustDropdownPosition()"
        @keydown.enter.prevent="open = false"
        placeholder="Seleccione una opción"
        class="w-full border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500"
    />

    <!-- Lista de opciones -->
    <div
        x-show="open"
        x-ref="optionsList"
        @click.away="open = false"
        class="z-50 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto absolute w-full"
        style="display: none;"
    >
        <template x-for="(value, key) in filteredOptions" :key="key">
            <div
                @click="selectOption(key)"
                class="px-4 py-2 hover:bg-blue-500 hover:text-white cursor-pointer"
            >
                <span x-text="value"></span>
            </div>
        </template>

        <!-- Mensaje cuando no hay resultados -->
        <div x-show="Object.keys(filteredOptions).length === 0" class="p-4 text-sm text-gray-500">
            No se encontraron resultados
        </div>
    </div>

    <!-- Input oculto para enviar el valor seleccionado en el formulario -->
    <input type="hidden" name="id_poblacion" :value="selected">
</div>