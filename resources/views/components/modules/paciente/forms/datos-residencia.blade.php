
<div class="bg-white my-2 border shadow-sm rounded-md">
    <div class="px-2 w-full py-2">
        <span class="text-gray-400 p-2">
            Datos de Residencia
        </span>
    </div>
    <div class="p-2 md:grid md:grid-cols-5 items-center gap-3 w-full">
        <div class="p-2">
            <x-components.label for="provincia">Provincia</x-components.label>
            <x-components.input id="provincia" name="provincia" placeholder="Provincia" />
        </div>
        <div class="p-2">
            <x-components.label for="canton">Cantón</x-components.label>
            <x-components.input id="canton" name="canton" placeholder="Cantón" />
        </div>
        <div class="p-2">
            <x-components.label for="parroquia">Parroquia</x-components.label>
            <x-components.input id="parroquia" name="parroquia" placeholder="Parroquia" />
        </div>
        <div class="p-2">
            <x-components.label for="direccion">Dirección</x-components.label>
            <x-components.input id="direccion" name="direccion" placeholder="Dirección" />
        </div>
    </div>
</div>
