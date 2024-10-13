
@role('user')

<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="" />     {{--las clases aca no me quieren funcionar --}}

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bienvenido a Maddicert!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Nos alegra que estén aquí. En esta plataforma, podrán gestionar y obtener sus certificados de residencia de una manera rápida, sencilla y sin complicaciones. Nuestro objetivo es hacer el proceso lo más eficiente posible, para que puedan dedicar su tiempo a lo que realmente importa.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>


            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="https://laravel.com/docs">Primero que todo</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            El primer paso para obtener su certificado es realizar una solicitud. Diríjanse al encabezado de esta página, donde encontrarán el campo 'Solicitud'. Hagan clic allí para iniciar el proceso y llenar la información requerida.
        </p>

    </div>

    <div>
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>
            <h2 class="ml-3 text-xl font-semibold text-gray-900">
                <a href="https://laracasts.com">Segundo</a>
            </h2>
        </div>

        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
            Una vez que hayan completado su solicitud, podrán hacer un seguimiento del estado de todas sus solicitudes. Para ello, diríjanse nuevamente al encabezado y seleccionen el campo 'Solicitudes'. Allí verán el progreso y los detalles de cada una de sus solicitudes.
        </p>

    </div>


</div>
@endrole

@role('admin')


<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="" />     {{--las clases aca no me quieren funcionar --}}

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bienvenido a Maddicert!
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Nos alegra que estén aquí. En esta plataforma, podrán gestionar y obtener sus certificados de residencia de una manera rápida, sencilla y sin complicaciones. Nuestro objetivo es hacer el proceso lo más eficiente posible, para que puedan dedicar su tiempo a lo que realmente importa.
    </p>
</div>

<div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
    Naveguen entre las opciones de la parte superior de la página para poder modificar: cruds, solicitudes, gestión de roles, gestión por el usuario. <br> que tenga un buen dia :)



</div>
@endrole
