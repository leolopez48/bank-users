<script setup>
import { onMounted, ref } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { messages } from "@/utils/validators/i18n-validators";
import { helpers, required } from "@vuelidate/validators";

import serviceApi from "@/services/serviceApi"
import accountApi from "@/services/accountApi"

import BaseButton from "@/components/base-components/BaseButton.vue";
import BaseInput from "@/components/base-components/BaseInput.vue";
import BaseSelect from "../components/base-components/BaseSelect.vue";
import useAlert from "../composables/useAlert";

const { alert } = useAlert();

const langMessages = messages["es"].validations;
const state = ref({
    sender: null,
    service: null,
});
const accounts = ref([]);
const services = ref([]);

const rules = {
    sender: {
        required: helpers.withMessage(langMessages.required, required),
    },
    service: {
        required: helpers.withMessage(langMessages.required, required),
    },
};

onMounted(() => {
    initialize();
})

const v$ = useVuelidate(rules, state);

const initialize = async () => {
    try {
        const requests = [
            accountApi.get(null, {
                params: {
                    itemsPerPage: -1
                }
            }),
            serviceApi.get(null, {
                params: {
                    itemsPerPage: -1
                }
            })
        ];

        const responses = await Promise.all(requests);

        accounts.value = responses[0].data.data;
        services.value = responses[1].data.data;
    } catch (error) {

    }
}

const validateForm = async () => {
    console.log(state.value)
    await v$.value.$validate()

    if (v$.value.$invalid) {
        alert.error("Campos requeridos")
        return;
    }

    try {
        const { data } = await serviceApi.post('/pay', state.value)

        alert.success(data.message)
    } catch (error) {
        alert.error(error.response.data.message)
    }
};
</script>

<template>
    <v-card class="mt-5">
        <v-card-title>
            <h2 class="mt-3">Pagar servicio</h2>
        </v-card-title>
        <!-- <hr> -->

        <v-card-text>
            <v-row>
                <!-- Accounts -->
                <v-col cols="12" sm="12" md="6">
                    <base-select label="Número de cuenta del emisor" :items="accounts" item-title="title"
                        v-model="v$.sender.$model" :rules="v$.sender" return-object />
                </v-col>
                <!-- Accounts -->

                <!-- Services -->
                <v-col cols="12" sm="12" md="6">
                    <base-select label="Servicio a pagar" :items="services" item-title="name" v-model="v$.service.$model"
                        :rules="v$.service" return-object />
                </v-col>
                <!-- Services -->

                <v-card-actions class="mx-auto">
                    <BaseButton type="primary" title="Pagar" class="mt-3" @click="validateForm()" />
                </v-card-actions>
            </v-row>
        </v-card-text>
    </v-card>
</template>