<template>
  <layout title="AddNewCategory">
    <div class="content-wrapper" style="min-height: 1244.06px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add product category</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><inertia-link href="/dashboard">Home</inertia-link></li>
                <li class="breadcrumb-item active">Add product category</li>
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
                  <h3>New Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="submit">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="category_name"
                        placeholder=""
                        v-model="form.categoryName"
                      />
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                      Submit
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
export default {
  components: {
    Layout,
  },
  data() {
    return {
      date: new Date().getFullYear(),
      form: {
        categoryName: ''
      }
    };
  },
  methods: {
    submit() {
      this.$inertia.post('/submitNewCategory', this.form)
    }
  }
};
</script>

<style>
</style>