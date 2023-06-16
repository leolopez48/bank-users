<template>
  <!-- <div class="d-flex justify-center">
    <v-progress-circular color="#2D52A8" indeterminate />
  </div> -->
  <div class="loading-overlay">
    <v-progress-circular indeterminate color="primary" size="64"></v-progress-circular>
    <div class="callback text-primary"> Cargando...</div>
  </div>
</template>

<style>
.loading-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(255, 255, 255, 0.8);
  z-index: 9999;
}
</style>