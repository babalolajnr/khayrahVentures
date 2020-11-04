<template>
  <layout title="AddNewCategory">
      <h1>Hello</h1>
  </layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
export default {
  components: {
    Layout
  },
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>

<style>

</style>