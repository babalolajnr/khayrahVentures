<template>
  <layout title="Add New Size">
    <div class="content-wrapper" style="min-height: 1244.06px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add sizes</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <inertia-link href="/dashboard">Home</inertia-link>
                </li>
                <li class="breadcrumb-item active">Add sizes</li>
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
                  <h3>New Size</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="submit">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">Size</label>
                      <input
                        type="text"
                        class="form-control"
                        placeholder=""
                        v-model="form.name"
                        required
                      />
                      <small id="sizeHelp" class="form-text text-muted">e.g 75inx54inx10in </small>
                      <div v-if="errors.name" class="text-red-600">
                        {{ errors.name }}
                      </div>
                      <div v-if="formError" class="text-red-600">
                        Form is empty
                      </div>
                    </div>
                   
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
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
      categories: null,
      form: {
        name: null,
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
        this.$inertia.post("/submitNewSize", this.form);
        this.$inertia.on("success", (event) => {
          //check if the errors props is empty
          if (Object.entries(this.$props.errors).length > 0) {
            // this.clearForm();
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
    },
  },
};
</script>

<style>
</style>