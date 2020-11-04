<template>
  <div>
    <template>
      <div>
        <sidebar-component></sidebar-component>
        <div class="relative md:ml-64 bg-gray-200">
          <navbar-component></navbar-component>
          <!-- Header -->
          <slot />
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import NavbarComponent from "@/Components/Navbar.vue";
import SidebarComponent from "@/Components/Sidebar.vue";
export default {
  components: {
    NavbarComponent,
    SidebarComponent
  },
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
  props: {
    title: String,
  },
  watch: {
    title: {
      immediate: true,
      handler(title) {
        document.title = title;
      },
    },
  },
};
</script>

<style>
</style>