<script setup>
// import Database from "../components/Database.vue";
</script>

<template>
  <main>
    <v-container>
      <v-row>
        <!-- Accounts -->
        <v-col cols="12" sm="6" lg="6">
          <v-card class="text-center my-card" @mouseover="hover = true" @mouseleave="hover = false">
            <v-card-Text class="d-flex flex-column justify-center align-center">
              <v-avatar color="primary" variant="tonal" size="50" class="mb-4">
                <v-icon size="2rem" icon="mdi-account-box" />
              </v-avatar>
              <h6 class="text-h6 font-weight-bold text-primary">
                Cuentas
              </h6>
            </v-card-Text>
            <v-card-Text>
              <p>
                Aquí encontrarás todas las cuentas que te pertenecen.
              </p>
            </v-card-Text>
            <v-card-actions class="justify-center">
              <v-btn color="primary" @click="$router.push('/account')">
                Ver cuentas
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>

        <!-- Transferencia -->
        <v-col cols="12" sm="6" lg="6">
          <v-card class="text-center my-card" @mouseover="hover = true" @mouseleave="hover = false">
            <v-card-Text class="d-flex flex-column justify-center align-center">
              <v-avatar color="primary" variant="tonal" size="50" class="mb-4">
                <VIcon size="2rem" icon="mdi-transfer" />
              </v-avatar>
              <h6 class="text-h6 font-weight-bold text-primary">
                Transferencia
              </h6>
            </v-card-Text>
            <v-card-Text>
              <p>
                Aquí podrás realizar transferencias con tus cuentas.
              </p>
            </v-card-Text>
            <v-card-actions class="justify-center">
              <v-btn color="primary" @click="$router.push('/history')">
                Realizar transferencia
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>

        <!-- History -->
        <v-col cols="12" sm="6" lg="6">
          <v-card class="text-center my-card" @mouseover="hover = true" @mouseleave="hover = false">
            <v-card-Text class="d-flex flex-column justify-center align-center">
              <v-avatar color="primary" variant="tonal" size="50" class="mb-4">
                <VIcon size="2rem" icon="mdi-history" />
              </v-avatar>
              <h6 class="text-h6 font-weight-bold text-primary">
                Historial
              </h6>
            </v-card-Text>
            <v-card-Text>
              <p>
                Aquí podrás consultar tu historial de transferencias.
              </p>
            </v-card-Text>
            <v-card-actions class="justify-center">
              <v-btn color="primary" @click="$router.push('/historyTransfer')">
                Ver historial
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>

        <!-- Services -->
        <v-col cols="12" sm="6" lg="6">
          <v-card class="text-center my-card" @mouseover="hover = true" @mouseleave="hover = false">
            <v-card-Text class="d-flex flex-column justify-center align-center">
              <v-avatar color="primary" variant="tonal" size="50" class="mb-4">
                <VIcon size="2rem" icon="mdi-toolbox-outline" />
              </v-avatar>

              <h6 class="text-h6 font-weight-bold text-primary">
                Servicios
              </h6>
            </v-card-Text>
            <v-card-Text>
              <p>
                Aquí podrás cancelar servicios de una forma fácil y rápida.
              </p>
            </v-card-Text>
            <v-card-actions class="justify-center">
              <v-btn color="primary" @click="$router.push('/service')">
                Administrar cuentas
              </v-btn>
              <v-btn class="ms-5" color="primary" @click="$router.push('/payService')">
                Pagar
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </main>
</template>

<style>
.my-card {
  transition: box-shadow 0.3s, background-color 0.3s;
  /* Transición para la sombra y el color de fondo */

  /* Sombra predeterminada */
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
