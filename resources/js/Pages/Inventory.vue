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
            <div class="col-12">
              <div class="card">
                <div class="card-header">Inventory</div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div
                    id="example2_wrapper"
                    class="dataTables_wrapper dt-bootstrap4"
                  >
                    <div class="row">
                      <div class="col-sm-12 col-md-6"></div>
                      <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <b-table
                          striped
                          responsive
                          hover
                          :items="items"
                          :fields="fields"
                        >
                          <template #cell(index)="data">
                            {{ data.index + 1 }}
                          </template>

                          <!-- sizes column -->
                          <template #cell(sizes)="data">
                            {{ data.value.name }}
                          </template>

                          <!-- product category column -->
                          <template #cell(product_category)="data">
                            {{ data.value.name }}
                          </template>

                          <!-- quantity column -->
                          <template #cell(inventory)="data">
                            {{ data.value.quantity }}
                          </template>
                        </b-table>
                      </div>
                      <b-pagination
                        class="mt-3"
                        v-model="ctx.currentPage"
                        :total-rows="ctx.total"
                        :per-page="ctx.perPage"
                        @change="handlePageChange"
                      ></b-pagination>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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
    inventory: Object,
  },
  components: {
    Layout,
    FulfillingSquareSpinner,
  },
  data() {
    return {
      date: new Date().getFullYear(),
      success: false,
      items: this.$props.inventory.data,
      ctx: {
        currentPage: this.$props.inventory.current_page,
        firstPageUrl: this.$props.inventory.first_page_url,
        from: this.$props.inventory.from,
        lastPage: this.$props.inventory.last_page,
        lastPageUrl: this.$props.inventory.last_page_url,
        nextPageUrl: this.$props.inventory.next_page_url,
        path: this.$props.inventory.path,
        perPage: this.$props.inventory.per_page,
        prevPageUrl: this.$props.inventory.prev_page_url,
        to: this.$props.inventory.to,
        total: this.$props.inventory.total,
      },

      fields: [
        {
          key: "index",
          sortable: true,
        },
        {
          key: "name",
          sortable: true,
        },
        {
          key: "code",
          sortable: true,
        },
        { key: "sizes", label: "Size", sortable: true },
        {
          key: "product_category",
          label: "Category",
          sortable: true,
        },

        { key: "inventory", label: "Quantity", sortable: true },
        {
          key: "retail_price",
          label: "Retail Price",
          sortable: true,
        },
        {
          key: "wholesale_price",
          label: "Wholesale Price",
          sortable: true,
        },
      ],
      loading: false,
    };
  },
  methods: {
    handlePageChange(value) {
      this.$inertia.visit("/inventory?page=" + value);
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
