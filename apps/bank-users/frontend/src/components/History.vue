<template>
  <div data-app>
    <v-card class="p-3 mt-3">
      <v-container>
        <span class="text-h5 font-weight-black">{{ title }}</span>
        <div class="options-table">
          <base-button type="primary" title="Nueva" @click="addRecord()" />
        </div>
        <!-- <v-col cols="12" sm="12" md="4" lg="4" xl="4" class="pl-0 pb-0 pr-0">
          <v-text-field class="mt-3" variant="outlined" label="Buscar" type="text" v-model="search"></v-text-field>
        </v-col> -->
      </v-container>
      <v-data-table-server :headers="headers" :items-length="total" :items="records" :loading="loading" item-title="id"
        item-value="id" @update:options="getDataFromApi">
        <!-- <template v-slot:[`item.actions`]="{ item }">
          <v-icon size="20" class="mr-2" @click="editItem(item.raw)" icon="mdi-pencil" />
          <v-icon size="20" class="mr-2" @click="deleteItem(item.raw)" icon="mdi-delete" />
        </template> -->
        <template v-slot:no-data>
          <v-icon @click="initialize" icon="mdi-refresh" />
        </template>
      </v-data-table-server>
    </v-card>

    <v-dialog v-model="dialog" max-width="800px" persistent>
      <v-card>
        <v-card-title>
          <h2 class="mx-auto pt-3 mb-3 text-center black-secondary">
            {{ formTitle }}
          </h2>
        </v-card-title>

        <v-card-text>
          <v-container>
            <!-- Form -->
            <v-row class="pt-3">

              <!-- Receiver -->
              <v-col cols="12" sm="12" md="12">
                <base-select label="Número de cuenta del emisor" :items="accounts" item-title="title"
                  v-model="v$.editedItem.sender.$model" :rules="v$.editedItem.sender" return-object />
              </v-col>
              <!-- Receiver -->

              <!-- Receiver -->
              <v-col cols="12" sm="12" md="12">
                <base-input label="Número de cuenta del receptor" v-model="v$.editedItem.receiver.$model"
                  :rules="v$.editedItem.receiver" />
              </v-col>
              <!-- Receiver -->

              <!-- amount -->
              <v-col cols="12" sm="12" md="6">
                <base-input type="number" label="Monto de la transferencia" v-model="v$.editedItem.amount.$model"
                  :rules="v$.editedItem.amount" />
              </v-col>
              <!-- amount -->

              <!-- concept -->
              <v-col cols="12" sm="12" md="6">
                <base-input label="Concepto" v-model="v$.editedItem.concept.$model" :rules="v$.editedItem.concept" />
              </v-col>
              <!-- concept -->

            </v-row>
            <!-- Form -->
            <v-row>
              <v-col align="center">
                <base-button type="primary" title="Guardar" @click="save" />
                <base-button class="ms-1" type="info" title="Cancelar" @click="close" />
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialogDelete" max-width="400px">
      <v-card class="h-100">
        <v-container>
          <h1 class="black-secondary text-center mt-3 mb-3">
            Eliminar registro
          </h1>
          <v-row>
            <v-col align="center">
              <base-button type="primary" title="Confirmar" @click="deleteItemConfirm" />
              <base-button class="ms-1" type="secondary" title="Cancelar" @click="closeDelete" />
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </div>
</template>
  
<script>
import { useVuelidate } from "@vuelidate/core";
import { messages } from "@/utils/validators/i18n-validators";
import { helpers, minLength, required, email } from "@vuelidate/validators";

import historyApi from "@/services/historyApi";
import accountApi from "@/services/accountApi";
import userApi from "@/services/userApi";

import BaseButton from "../components/base-components/BaseButton.vue";
import BaseInput from "../components/base-components/BaseInput.vue";
import BaseSelect from "../components/base-components/BaseSelect.vue";
import useAlert from "../composables/useAlert";

const { alert } = useAlert();
const langMessages = messages["es"].validations;

export default {
  components: { BaseButton, BaseInput, BaseSelect },
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      search: "",
      selected: [],
      dialog: false,
      dialogDelete: false,
      headers: [

        { title: "Concepto", key: "concept" },
        { title: "Monto", key: "amount" },
        // { title: "ACCIONES", key: "actions", sortable: false },
      ],
      records: [],
      editedIndex: -1,
      title: "Transferencias",
      total: 0,
      options: {},
      editedItem: {
        concept: "", email: "", email: "", amount: "",
      },
      defaultItem: {
        concept: "", email: "", email: "", amount: "",
      },
      loading: false,
      debounce: 0,
      users: [],
      accounts: [],

    };
  },

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  // Validations
  validations() {
    return {
      editedItem: {
        concept: {
          required,
          minLength: minLength(1),
        },
        sender: {
          required,
          minLength: minLength(1),
        },
        receiver: {
          required,
          minLength: minLength(1),
        },
        amount: {
          required,
          minLength: minLength(1),
        },
      },
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nueva transferencia" : "Editar transferencia";
    },
  },

  watch: {
    search(val) {
      this.getDataFromApi();
    },
    dialog(val) {
      val || this.close();
    },
    dialogBlock(val) {
      val || this.closeBlock();
    },
  },

  created() {
    this.initialize();
  },

  beforeMount() {
    this.getDataFromApi({ page: 1, itemsPerPage: 10, sortBy: [], search: "" });
  },

  methods: {
    async initialize() {
      this.loading = true;
      this.records = [];

      let requests = [
        this.getDataFromApi(),
        accountApi.get(null, {
          params: { itemsPerPage: -1 },
        }),
        // userApi.get(null, {
        //   params: { itemsPerPage: -1 },
        // }),
      ];

      const responses = await Promise.all(requests).catch((error) => {
        alert.error("No fue posible obtener el registro.");
      });

      if (responses) {
        this.accounts = responses[1].data.data;
        // this.users = responses[2].data.data;

      }

      this.loading = false;
    },

    editItem(item) {
      this.editedIndex = this.records.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async save() {
      this.v$.$validate();
      if (this.v$.$invalid) {
        alert.error("Campos obligatorios");
        return;
      }

      // Updating record
      if (this.editedIndex > -1) {
        const edited = Object.assign(
          this.records[this.editedIndex],
          this.editedItem
        );

        try {
          const { data } = await historyApi.put(`/${edited.id}`, edited);

          alert.success(data.message);
        } catch (error) {
          console.log(error)
          alert.error("No fue posible actualizar el registro.");
        }

        this.close();
        this.initialize();
        return;
      }

      //Creating record
      try {
        // console.log(this.editedItem)
        const { data } = await historyApi.post(null, this.editedItem);

        alert.success(data.message);
      } catch (error) {
        alert.error("No fue posible crear el registro.");
      }

      this.close();
      this.initialize();
      return;
    },

    deleteItem(item) {
      this.editedIndex = this.records.indexOf(item);
      this.editedItem = Object.assign({}, item);

      this.dialogDelete = true;
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async deleteItemConfirm() {
      try {
        const { data } = await historyApi.delete(`/${this.editedItem.id}`, {
          params: {
            id: this.editedItem.id,
          },
        });

        alert.success(data.message);
      } catch (error) {
        this.close();
      }

      this.initialize();
      this.closeDelete();
    },

    getDataFromApi(options) {
      this.loading = true;
      this.records = [];

      //debounce
      clearTimeout(this.debounce);
      this.debounce = setTimeout(async () => {
        try {
          const { data } = await historyApi.get(null, {
            params: { ...options, search: this.search },
          });

          this.records = data.data;
          console.log(this.records)
          this.total = data.total;
          this.loading = false;
        } catch (error) {
          alert.error("No fue posible obtener los registros.");
        }
      }, 500);
    },

    addRecord() {
      this.dialog = true;
      this.editedIndex = -1;
      this.editedItem = Object.assign({}, this.defaultItem);
      this.v$.$reset();
    },
  },
};
</script>