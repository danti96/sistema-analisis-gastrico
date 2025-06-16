    <div class=" flex items-center justify-center px-6 py-12">
        <div class="max-w-3xl w-full bg-white rounded-2xl shadow-lg p-10 space-y-6">
            <h1 class="text-3xl md:text-4xl font-bold text-center text-blue-500">
                Bienvenido a nuestro sistema de detección gástrica con IA
            </h1>

            <div class="text-center">
                <p class="text-lg text-gray-700 leading-relaxed">
                    Nuestro sistema usa <span class="font-semibold text-blue-500">inteligencia artificial</span> y el
                    algoritmo <span class="font-semibold text-blue-500">YOLOv8</span> para detectar posibles indicios de
                    <span class="font-semibold">cáncer gástrico</span> en imágenes médicas.
                </p>
                <p class="mt-4 text-lg text-gray-700 leading-relaxed">
                    Este análisis automático facilita una <span class="font-semibold">detección temprana y
                        precisa</span>, apoyando al diagnóstico clínico y mejorando las oportunidades de tratamiento.
                </p>
            </div>

            <div class="flex  gap-2 justify-center">
                <a href="{{ route('paciente.index') }}"
                    class="mt-6 px-6 py-3 bg-blue-500 text-white text-lg font-semibold rounded-xl shadow hover:bg-blue-600 transition">
                    Paciente
                </a>
                <a href="{{ route('atencionpaciente.index') }}"
                    class="mt-6 px-6 py-3 bg-blue-500 text-white text-lg font-semibold rounded-xl shadow hover:bg-blue-600 transition">
                    Atención Paciente
                </a>
            </div>
        </div>
    </div>
