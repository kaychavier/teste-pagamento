<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Pagination from "../../Components/Global/Pagination.vue";
import Alert from "../../Components/Global/Alert.vue";
import { swalConfirm } from "../../Assets/js/constants";

const { permissions } = usePage().props.auth.user;
const { products } = defineProps({
  products: Object,
});
const deleteProduct = (id) => {
  swalConfirm(
    ({ isConfirmed }) =>
      isConfirmed && router.delete(route("products.destroy", id))
  );
};
</script>

<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <div class="flex-between">
          <h5>Products list</h5>
          <Link
            v-if="permissions.includes('create product')"
            as="a"
            :href="route('products.create')"
            class="btn btn-sm btn-primary"
          >
            <i class="fa fa-plus me-1"></i>
            Create product
          </Link>
        </div>
      </div>
      <div class="card-body table-responsive">
        <Alert color="success" :message="$page.props.session.success" />
        <table class="table table-hover">
          <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Created at</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-if="products?.total > 0" v-for="product in products?.data">
              <td><img :src="product.image_path" width="50" height="50" /></td>
              <td>{{ product.name }}</td>
              <td>{{ product.formated_price }}</td>
              <td>{{ product.created_at }}</td>
              <td>
                <div class="dropdown">
                  <button
                    class="btn btn-link"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i class="fas fa-ellipsis-v"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <Link
                      class="dropdown-item"
                      v-if="permissions.includes('update product')"
                      :href="route('products.edit', product)"
                    >
                      <i class="fa fa-edit text-primary me-1"></i>
                      Edit
                    </Link>
                    <div
                      class="dropdown-item"
                      v-if="permissions.includes('delete product')"
                      @click="deleteProduct(product.id)"
                    >
                      <i class="fa fa-trash-alt text-danger me-1"></i>
                      Delete
                    </div>
                  </ul>
                </div>
              </td>
            </tr>
            <tr v-else>
              <td colspan="5">No clients found...</td>
            </tr>
          </tbody>
        </table>
        <Pagination :data="products" />
      </div>
    </div>
  </BaseLayout>
</template>
