<script setup>
import BaseLayout from "../../layouts/BaseLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Pagination from "../../Components/Global/Pagination.vue";
import Alert from "../../Components/Global/Alert.vue";
import { swalConfirm } from "../../Assets/js/constants";

const { permissions } = usePage().props.auth.user;
const { purchases, data } = defineProps({
  purchases: Object,
  data: Object,
});
const deletePurchase = (id) => {
  swalConfirm(
    ({ isConfirmed }) =>
      isConfirmed && router.delete(route("purchases.destroy", id))
  );
};
</script>

<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <div class="flex-between">
          <h5>Purchases list</h5>
          <Link
            v-if="permissions.includes('create purchase')"
            as="a"
            :href="route('purchases.create')"
            class="btn btn-sm btn-primary"
          >
            <i class="fa fa-plus me-1"></i>
            Create purchase
          </Link>
        </div>
      </div>
      <div class="card-body table-responsive">
        <Alert color="success" :message="$page.props.session.success" />
        <form class="mb-3">
          <div class="row g-2">
            <div class="col-4">
              <input
                type="text"
                class="form-control"
                placeholder="User"
                name="user"
                :value="data.user"
              />
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control"
                placeholder="Client"
                name="client"
                :value="data.client"
              />
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control"
                placeholder="Product"
                name="product"
                :value="data.product"
              />
            </div>
            <div class="col-1">
              <button class="btn btn-sm btn-primary">Search</button>
            </div>
          </div>
        </form>
        <table class="table table-hover">
          <thead>
            <th v-if="permissions.includes('admin resource')">User</th>
            <th>Client</th>
            <th>Products</th>
            <th>Price</th>
            <th>Installments</th>
            <th>Created at</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-if="purchases?.total > 0" v-for="purchase in purchases?.data">
              <td v-if="permissions.includes('admin resource')">
                {{ purchase.user?.name }}
              </td>
              <td>{{ purchase.client.name }}</td>
              <td>
                <p v-for="product in purchase.products">
                  {{ product.pivot.quantity }}x - {{ product.name }}
                </p>
              </td>
              <td>R$ {{ purchase.price }}</td>
              <td>
                {{ purchase.installments.length }}X - R$
                {{ purchase.installments[0].price }}
              </td>
              <td>{{ purchase.created_at }}</td>
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
                    <a
                      target="_blank"
                      class="dropdown-item"
                      v-if="permissions.includes('show purchase')"
                      :href="route('purchases.show', purchase)"
                    >
                      <i class="fa fa-file-pdf text-primary me-1"></i>
                      PDF
                    </a>
                    <Link
                      class="dropdown-item"
                      v-if="permissions.includes('update purchase')"
                      :href="route('purchases.edit', purchase)"
                    >
                      <i class="fa fa-edit text-primary me-1"></i>
                      Edit
                    </Link>
                    <div
                      class="dropdown-item"
                      v-if="permissions.includes('delete purchase')"
                      @click="deletePurchase(purchase.id)"
                    >
                      <i class="fa fa-trash-alt text-danger me-1"></i>
                      Delete
                    </div>
                  </ul>
                </div>
              </td>
            </tr>
            <tr v-else>
              <td colspan="5">No purchases found...</td>
            </tr>
          </tbody>
        </table>
        <Pagination :data="purchases" />
      </div>
    </div>
  </BaseLayout>
</template>
