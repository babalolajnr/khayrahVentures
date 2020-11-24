<template>
  <layout title="AddNewBrand">
    <div class="content-wrapper" style="min-height: 1244.06px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Brand</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <inertia-link href="/dashboard">Home</inertia-link>
                </li>
                <li class="breadcrumb-item active">Add Brand</li>
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
                  <h3>New Brand</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="submit">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="Brand-name">Brand Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="e.g Vitafoam Nigeria PLC"
                        v-model="form.name"
                        required
                      />
                      <div v-if="errors.name" class="text-red-600">
                        {{ errors.name }}
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Brand short name">Brand Short Name</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="e.g Vitafoam"
                        v-model="form.short_name"
                        required
                      />
                      <div v-if="errors.short_name" class="text-red-600">
                        {{ errors.short_name }}
                      </div>
                      <div v-if="formError" class="text-red-600">
                        Form is empty
                      </div>
                      <strong
                        v-if="success"
                        class="text-green-500 transition duration-500 ease-in"
                        >Brand Created!</strong
                      >
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button
                      type="submit"
                      class="btn btn-primary btn-block flex"
                      :disabled = "loading"
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
        short_name: null,
      },
      formError: false,
      loading: false,
    };
  },
  methods: {
    submit() {
      this.loading = true
      if (this.form.name == null) {
        this.formError = true;
      } else {
        this.formError = false;
        this.$inertia.post("/submitNewBrand", this.form);
        this.$inertia.on("success", (event) => {
          //check if the errors props is empty
          if (Object.entries(this.$props.errors).length > 0) {
            this.form.name = "";
            this.form.short_name = "";
          } else {
            this.success = true;
            this.form.name = "";
            this.form.short_name = "";
            setTimeout(this.successMessageFade, 2000);
          }
        });
      }
      this.loading = false
    },
    successMessageFade() {
      this.success = false;
    },
  },
};
</script>

<style>
</style>