<script setup>
import Sidebar from "../Components/Navigation/Sidebar.vue";
import Navbar from "../Components/Navigation/Navbar.vue";
import Footer from "../Components/Global/Footer.vue";
</script>
<template>
  <Sidebar />
  <main class="main-content position-relative border-radius-lg">
    <Navbar />
    <div class="container-fluid py-4">
      <slot></slot>
      <Footer />
    </div>
  </main>
</template>
