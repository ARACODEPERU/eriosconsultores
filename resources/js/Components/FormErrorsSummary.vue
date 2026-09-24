<script setup>
import { computed } from 'vue';

/**
 * Resumen de los errores de validacion que devuelve el servidor.
 *
 * Existe porque un error de un campo que la vista no muestra (oculto por un
 * parametro o por permisos) deja el formulario sin ningun aviso visible: la
 * peticion se redirige de vuelta y "no pasa nada". Con este bloque, el motivo
 * siempre se ve.
 */
const props = defineProps({
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const messages = computed(() =>
    Object.values(props.errors || {}).filter(
        (message) => typeof message === 'string' && message.trim() !== ''
    )
);
</script>

<template>
    <div
        v-if="messages.length"
        class="col-span-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 dark:border-red-800/60 dark:bg-red-900/20"
    >
        <div class="flex items-start gap-2">
            <svg class="mt-0.5 h-4 w-4 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <p class="text-sm font-semibold text-red-700 dark:text-red-300">
                    No se pudo guardar: revisa estos datos
                </p>
                <ul class="mt-1 list-inside list-disc space-y-0.5 text-xs text-red-600 dark:text-red-300">
                    <li v-for="(message, index) in messages" :key="index">{{ message }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>
