<script setup>
import Header from "../components/Header.vue";
</script>

<template>
  <Header title="About page" />

  <main>
    <div class="about">
      <h1>This is an about page</h1>
    </div>
  </main>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    display: flex;
    align-items: flex-start;
  }
}
</style>
