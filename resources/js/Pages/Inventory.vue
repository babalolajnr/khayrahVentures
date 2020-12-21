<template>
  <layout title="Inventory">
    <div class="content-wrapper" style="min-height: 1244.06px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Inventory</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <inertia-link href="/dashboard">Home</inertia-link>
                </li>
                <li class="breadcrumb-item active">Inventory</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
  </layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import { FulfillingSquareSpinner } from "epic-spinners";
export default {
  props: {
    errors: Object,
    productCategories: Array,
    sizes: Array,
    brands: Array,
  },
  components: {
    Layout,
    FulfillingSquareSpinner,
  },
  data() {
    return {
      date: new Date().getFullYear(),
      success: false,
      form: {
        name: null,
        code: null,
        color: null,
        wholesale: null,
        retail: null,
        productCategory: null,
        size: null,
        brand: null,
        description: null,
      },
      loading: false,
      formError: false,
    };
  },
  methods: {
    submit() {
      this.loading = true;
      if (this.form.name == null) {
        this.formError = true;
      } else {
        this.formError = false;
        this.$inertia.post("/submitNewProduct", this.form);
        this.$inertia.on("success", (event) => {
          //check if the errors props is empty
          if (Object.entries(this.$props.errors).length > 0) {
            // this.clearForm()
          } else {
            this.success = true;
            this.clearForm();
            setTimeout(this.successMessageFade, 2000);
          }
        });
      }
      this.loading = false;
    },
    successMessageFade() {
      this.success = false;
    },
    clearForm() {
      this.form.name = "";
      this.form.code = "";
      this.form.color = "";
      this.form.wholesale = "";
      this.form.retail = "";
      this.form.productCategory = "";
      this.form.size = "";
      this.form.brand = "";
      this.form.description = "";
    },
  },
  computed: {
    checkIfUserIsAuthorized() {
      if (this.$page.user.can.createProduct) {
        return true;
      }
    },
  },
};
</script>

<style>
</style>