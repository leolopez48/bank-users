<script setup>
import { computed, onMounted, ref } from 'vue';

import backendApi from "@/services/backendApi";
import useAuth from "@/composables/useAuth";
import Loader from './layouts/Loader.vue';

const history = ref([]);
const loading = ref(false);
const { user } = useAuth();

onMounted(async () => {
    loading.value = true;
    // console.log(user.value)
    try {
        const { data } = await backendApi.get('/transfer');

        history.value = data.data;
    } catch (error) {
        console.log(error.message);
    }
    loading.value = false;
});

const amount = (history) => {
    // console.log(user.value.email, history.sender.email)
    if (user.value.email == history.sender.email) {
        // console.log("Hola")
        return parseFloat(history.amount * -1).toFixed(2)
    }

    return parseFloat(history.amount).toFixed(2)
}
</script>

<template>
    <v-container>
        <h2 class="">Historial de transacciones</h2>
        <v-row v-if="!loading">
            <v-col cols="12" v-for="history in history" :key="history.id">
                <v-card class="my-card" @mouseover="hover = true" @mouseleave="hover = false">

                    <h3 v-if="user.email == history.sender.email" class="text-red text-right">
                        Egreso
                        <v-icon>mdi-transfer-down</v-icon>
                    </h3>
                    <h3 v-else class="text-green text-right">
                        Ingreso
                        <v-icon>mdi-transfer-up</v-icon>
                    </h3>

                    <v-card-title>
                        {{ history.concept }}
                    </v-card-title>

                    <v-card-text>
                        <h3>Monto: <span :class="(user.email == history.sender.email) ? 'text-red' : 'text-green'">
                                {{ amount(history) }}
                            </span>
                        </h3>

                        <h3 class="mt-4">Detalle de la transacción</h3>
                        <hr class="my-0 mb-2">
                        <p>Emisor: <b>{{ history.sender.email }}</b></p>
                        <p v-if="history.receiver">Receptor: <b>{{ history.receiver.email }}</b></p>

                        <h3 class="mt-4">Tipo de movimiento</h3>
                        <hr class="my-0 mb-2">
                        <h3 v-if="user.email == history.sender.email" class="text-red ">
                            Egreso
                            <v-icon>mdi-transfer-down</v-icon>
                        </h3>
                        <h3 v-else class="text-green ">
                            Ingreso
                            <v-icon>mdi-transfer-up</v-icon>
                        </h3>
                    </v-card-text>
                </v-card>
            </v-col>

            <v-col cols="12" md="12" class="my-3" v-if="history.length == 0" align=center>
                <p>No se encontraron transacciones para ninguna de tus cuentas.</p>
            </v-col>
        </v-row>
        <v-row v-else>
            <Loader class="p-3 mx-auto" />
        </v-row>
    </v-container>
</template>

<style>
.my-card {
    transition: box-shadow 0.3s, background-color 0.3s;
    /* Transición para la sombra y el color de fondo */
    background-color: white;
    /* Color de fondo predeterminado */
}

.my-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra al hacer hover */
    background-color: #D6DBDF;
    /* Color de fondo al hacer hover */
}
</style>