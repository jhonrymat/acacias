<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información del perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualice la información del perfil de su cuenta y su dirección de correo electrónico.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>
        {{-- nombre_2 --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="nombre_2" value="{{ __('Nombre 2') }}" />
            <x-input id="nombre_2" type="text" class="mt-1 block w-full" wire:model.defer="state.nombre_2"
                autocomplete="nombre_2" />
            <x-input-error for="nombre_2" class="mt-2" />
        </div>
        {{-- apellido_1 --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido_1" value="{{ __('Apellido 1') }}" />
            <x-input id="apellido_1" type="text" class="mt-1 block w-full" wire:model.defer="state.apellido_1"
                autocomplete="apellido_1" />
            <x-input-error for="apellido_1" class="mt-2" />
        </div>
        {{-- apellido_2 --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="apellido_2" value="{{ __('Apellido 2') }}" />
            <x-input id="apellido_2" type="text" class="mt-1 block w-full" wire:model.defer="state.apellido_2"
                autocomplete="apellido_2" />
            <x-input-error for="apellido_2" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
        {{-- {{ dd($this->user) }} --}}
        {{-- telefonoContacto --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="telefonoContacto" value="{{ __('Telefono de Contacto') }}" />
            <x-input id="telefonoContacto" type="text" class="mt-1 block w-full"
                wire:model.defer="state.telefonoContacto" autocomplete="telefonoContacto" />
            <x-input-error for="telefonoContacto" class="mt-2" />
        </div>
        {{-- fechaNacimiento --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="fechaNacimiento" value="{{ __('Fecha de Nacimiento') }}" />
            <x-input id="fechaNacimiento" type="date" class="mt-1 block w-full"
                wire:model.defer="state.fechaNacimiento" autocomplete="fechaNacimiento" />
            <x-input-error for="fechaNacimiento" class="mt-2" />
        </div>

        {{-- id_tipoSolicitante --}}
        <div class="col-span-6 sm:col-span-4">
            <label for="id_tipoSolicitante" class="block text-sm font-medium text-gray-700">Tipo de
                Solicitante</label>
            <select id="id_tipoSolicitante" name="id_tipoSolicitante" class="mt-1 block w-full"
                wire:model.defer="state.id_tipoSolicitante">
                <option value="">-- Selecciona un solicitante --</option>
                @foreach (\App\Models\Tsolicitante::all() as $solicitante)
                    <option value="{{ $solicitante->id }}"
                        {{ old('id_tipoSolicitante', $this->user->id_tipoSolicitante) == $solicitante->id ? 'selected' : '' }}>
                        {{ $solicitante->tipoSolicitante }}
                    </option>
                @endforeach
            </select>
            @error('id_tipoSolicitante')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        {{-- id_tipoDocumento --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id_tipoDocumento" value="{{ __('Tipo de Documento') }}" />
            <select wire:model="state.id_tipoDocumento" id="id_tipoDocumento" class="mt-1 block w-full">
                <option value="">Selecciona un tipo de documento</option>
                @foreach (\App\Models\Tdocumento::all() as $tipoDocumento)
                    <option value="{{ $tipoDocumento->id }}"
                        {{ old('id_tipoDocumento', $this->user->id_tipoDocumento) == $tipoDocumento->id ? 'selected' : '' }}>
                        {{ $tipoDocumento->tipoDocumento }}
                    </option>
                @endforeach
            </select>
            @error('id_tipoDocumento')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- numeroIdentificacion --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="numeroIdentificacion" value="{{ __('Numero de Identificación') }}" />
            <x-input id="numeroIdentificacion" type="text" class="mt-1 block w-full"
                wire:model.defer="state.numeroIdentificacion" autocomplete="numeroIdentificacion" />
            <x-input-error for="numeroIdentificacion" class="mt-2" />
        </div>
        {{-- ciudadExpedicion --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="ciudadExpedicion" value="{{ __('Ciudad de Expedición') }}" />
            <x-input id="ciudadExpedicion" type="text" class="mt-1 block w-full"
                wire:model.defer="state.ciudadExpedicion" autocomplete="ciudadExpedicion" />
            <x-input-error for="ciudadExpedicion" class="mt-2" />
        </div>
        {{-- id_nivelEstudio --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id_nivelEstudio" value="{{ __('Nivel de Estudio') }}" />
            <select wire:model="state.id_nivelEstudio" id="id_nivelEstudio" class="mt-1 block w-full">
                <option value="">Selecciona un nivel de estudio</option>
                @foreach (\App\Models\Nestudio::all() as $nivelEstudio)
                    <option value="{{ $nivelEstudio->id }}"
                        {{ old('id_nivelEstudio', $this->user->id_nivelEstudio) == $nivelEstudio->id ? 'selected' : '' }}>
                        {{ $nivelEstudio->nivelEstudio }}
                    </option>
                @endforeach
            </select>
            @error('id_nivelEstudio')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- id_genero --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id_genero" value="{{ __('Género') }}" />
            <select wire:model="state.id_genero" id="id_genero" class="mt-1 block w-full">
                <option value="">Selecciona un género</option>
                @foreach (\App\Models\Genero::all() as $genero)
                    <option value="{{ $genero->id }}"
                        {{ old('id_genero', $this->user->id_genero) == $genero->id ? 'selected' : '' }}>
                        {{ $genero->nombreGenero }}
                    </option>
                @endforeach
            </select>
            @error('id_genero')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- id_ocupacion --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id_ocupacion" value="{{ __('Ocupación') }}" />
            <select wire:model="state.id_ocupacion" id="id_ocupacion" class="mt-1 block w-full">
                <option value="">Selecciona una ocupación</option>
                @foreach (\App\Models\Ocupacion::all() as $ocupacion)
                    <option value="{{ $ocupacion->id }}"
                        {{ old('id_ocupacion', $this->user->id_ocupacion) == $ocupacion->id ? 'selected' : '' }}>
                        {{ $ocupacion->nombreOcupacion }}
                    </option>
                @endforeach
            </select>
            @error('id_ocupacion')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- id_poblacion --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="id_poblacion" value="{{ __('Población') }}" />
            <select wire:model="state.id_poblacion" id="id_poblacion" class="mt-1 block w-full">
                <option value="">Selecciona una población</option>
                @foreach (\App\Models\Poblacion::all() as $poblacion)
                    <option value="{{ $poblacion->id }}"
                        {{ old('id_poblacion', $this->user->id_poblacion) == $poblacion->id ? 'selected' : '' }}>
                        {{ $poblacion->nombrePoblacion }}
                    </option>
                @endforeach
            </select>
            @error('id_poblacion')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
