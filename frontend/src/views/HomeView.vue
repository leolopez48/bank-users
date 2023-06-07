<script setup>
// import Database from "../components/Database.vue";
</script>

<template>
  <main>
    <!-- <Database /> -->
    <v-container>
      <v-row>
        <!-- Accounts -->
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title><v-icon icon="mdi-account-box" /> Cuentas</v-card-title>
            <v-card-text>
              Aquí encontrarás todas las cuentas que te pertenecen.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- @click="$router.push('/cuentas')" -->
              <v-btn color="primary">
                Ver cuentas
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <!-- Account -->

        <!-- Tranfers -->
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title><v-icon icon="mdi-transfer" /> Transferencia</v-card-title>
            <v-card-text>
              Aquí podrás realizar transferencias desde tu cuenta.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- @click="$router.push('/cuentas')" -->
              <v-btn color="primary">
                Realizar transferencia
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <!-- Tranfers -->

        <!-- Accounts -->
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title><v-icon icon="mdi-history" /> Historial</v-card-title>
            <v-card-text>
              Aquí podrás consultar tu historial de transferencias.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- @click="$router.push('/cuentas')" -->
              <v-btn color="primary">
                Ver historial
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <!-- Accounts -->

        <!-- Accounts -->
        <v-col cols="12" md="6">
          <v-card>
            <v-card-title><v-icon icon="mdi-toolbox-outline" /> Servicios</v-card-title>
            <v-card-text>
              Aquí podrás cancelar servicios de una forma fácil y rápida.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <!-- @click="$router.push('/cuentas')" -->
              <v-btn color="primary">
                Pagar cuentas
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
        <!-- Accounts -->

      </v-row>
    </v-container>
  </main>
</template>
