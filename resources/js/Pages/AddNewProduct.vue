<template>
  <layout title="Add New Product">
    <div class="content-wrapper" style="min-height: 1244.06px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Product</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <inertia-link href="/dashboard">Home</inertia-link>
                </li>
                <li class="breadcrumb-item active">Add Product</li>
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
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3>New Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="submit">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.name"
                        required
                      />
                      <small id="nameHelp" class="form-text text-muted"
                        >e.g Vita Grand
                      </small>
                      <div v-if="errors.name" class="text-red-600">
                        {{ errors.name }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Code">Code</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.code"
                      />
                      <small id="codeHelp" class="form-text text-muted"
                        >e.g M1VS
                      </small>
                      <div v-if="errors.code" class="text-red-600">
                        {{ errors.code }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Color">Color</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.color"
                      />
                      <div v-if="errors.color" class="text-red-600">
                        {{ errors.color }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Wholesale">Wholesale price</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.wholesale"
                        required
                      />
                      <div v-if="errors.wholesale" class="text-red-600">
                        {{ errors.wholesale }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Retail">Retail price</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.retail"
                        required
                      />
                      <div v-if="errors.retail" class="text-red-600">
                        {{ errors.retail }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select
                        class="custom-select"
                        v-model="form.productCategory"
                      >
                        <option
                          v-for="category in this.$props.productCategories"
                          :key="category.id"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                      <div v-if="errors.productCategory" class="text-red-600">
                        {{ errors.productCategory }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="size">Size</label>
                      <select class="custom-select" v-model="form.size">
                        <option
                          v-for="size in this.$props.sizes"
                          :key="size.id"
                        >
                          {{ size.name }}
                        </option>
                      </select>
                      <div v-if="errors.size" class="text-red-600">
                        {{ errors.size }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="brand">Brand</label>
                      <select class="custom-select" v-model="form.brand">
                        <option
                          v-for="brand in this.$props.brands"
                          :key="brand.id"
                        >
                          {{ brand.name }}
                        </option>
                      </select>
                      <div v-if="errors.brand" class="text-red-600">
                        {{ errors.brand }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name">Description</label>
                      <textarea
                        class="form-control"
                        rows="3"
                        v-model="form.description"
                        placeholder="Enter description of the product"
                      ></textarea>
                      <div v-if="errors.description" class="text-red-600">
                        {{ errors.description }}
                      </div>
                    </div>
                    <div v-if="formError" class="text-red-600">
                      Form is empty
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer" v-if="checkIfUserIsAuthorized">
                    <button
                      type="submit"
                      class="btn btn-primary btn-block flex"
                      :disabled="loading"
                    >
                      <fulfilling-square-spinner
                        :animation-duration="2000"
                        :size="20"
                        color="#fff"
                        class="mx-auto"
                        v-if="loading"
                      />
                      <span class="mx-auto" v-else> Submit </span>
                    </button>
                  </div>
                  <div class="card-footer" v-else>
                    <button
                      type="submit"
                      class="btn btn-danger btn-block flex"
                      disabled
                    >
                      <span class="mx-auto"> You are not authorized</span>
                    </button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
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