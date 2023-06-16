<template>
  <footer>
    <v-container fluid>
      <v-card flat tile class="text-center" style="background-color: transparent; box-shadow: none;">
        <v-card-text>
          <v-btn size="x-small" href="https://www.itca.edu.sv/" target="_blank" class="ma-2" color="black"
            icon="mdi-school">
          </v-btn>
          <v-btn size="x-small" href="https://github.com/leolopez48/bank-users" target="_blank" class="ma-2" color="black"
            icon="mdi-code-tags">
          </v-btn>
        </v-card-text>
        <span class="text-subtitle-2"> {{ new Date().getFullYear() }} — Secure Bank</span>
      </v-card>

    </v-container>
  </footer>
</template>

<style scoped>
a {
  text-decoration: none;
  color: black;
}

.rounded-icon {
  border-radius: 50%;
}
</style>