<template>
  <v-theme-provider theme="light" with-background>
    <header class="m-0">
      <v-container fluid>
        <div class="d-flex justify-space-between mt-2">
          <div class="ms-2 me-2 my-auto d-flex">
            <!-- <div>
            <a href="#" class="menu" @click="stateSideBar = 'active'"><v-icon icon="mdi-menu" size="39" /></a>
          </div> -->
            <div class="brand-icon-container ms-5 ps-3 me-2 d-flex d-xs-flex d-sm-flex ">
              <v-icon size="x-large" class="" dark>mdi-bank</v-icon>

              <span class="brand-text d-none d-xs-flex d-sm-flex font-weight-black ">Secure
                Bank</span>
            </div>
          </div>
          <div class="ms-2 me-5 my-auto d-flex flex-column text-right" v-if="isLoggedIn">
            <v-row justify="center">
              <v-menu min-width="200px" rounded>
                <template v-slot:activator="{ props }">
                  <v-btn icon v-bind="props">
                    <v-avatar color="dark" size="48">
                      <v-icon color="light">mdi-account</v-icon>
                    </v-avatar>
                  </v-btn>
                </template>
                <v-card>
                  <v-card-text>
                    <div class="mx-auto text-center">
                      <v-avatar color="blue-grey" size="48">
                        <v-icon dark>mdi-account</v-icon>
                      </v-avatar>
                      <h3>{{ user.name }}</h3>
                      <p class="text-caption mt-1">
                        {{ user.email }}
                      </p>
                      <v-divider class="my-3"></v-divider>
                      <v-btn rounded color="danger" variant="outlined" @click="logout()">
                        Cerrar Sesión
                      </v-btn>
                    </div>
                  </v-card-text>
                </v-card>
              </v-menu>
            </v-row>
          </div>

        </div>
      </v-container>
    </header>
  </v-theme-provider>
</template>

<script setup>
import useAuth from "@/composables/useAuth";
import useMenu from "@/composables/useMenu";
import { ref } from 'vue';

const fav = ref(true);
const menu = ref(false);
const message = ref(false);
const hints = ref(true);

const { isLoggedIn, user, logout } = useAuth();

const { stateSideBar } = useMenu();
</script>

<style scoped>
a.menu {
  color: black;
}

.brand-icon-container {
  display: flex;
  align-items: center;
  /* Alineación vertical al centro */
}

.brand-text {
  margin-left: 8px;
  font-size: 30px;
  font-weight: bold;
  font-family: '', sans-serif;
}
</style>