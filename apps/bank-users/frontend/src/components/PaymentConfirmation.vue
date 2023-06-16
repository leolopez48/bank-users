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
    <v-container class="text-center">
        <v-icon size="100" color="success">mdi-check-circle</v-icon>
        <h1 class="">Pago Completado</h1>
        <p>Muchas gracias , Tu pago ha sido completado exitosamente.</p>
    </v-container>
</template>
