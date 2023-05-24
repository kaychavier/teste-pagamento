<script setup>
import BaseLayout from "../../layouts/BaseLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Pagination from "../../Components/Global/Pagination.vue";
import Alert from "../../Components/Global/Alert.vue";
import { swalConfirm } from "../../Assets/js/constants";

const { permissions } = usePage().props.auth.user;
const { clients } = defineProps({
  clients: Object
})
const deleteClient = (id) => {
  swalConfirm(
    ({ isConfirmed }) =>
      isConfirmed && router.delete(route("clients.destroy", id))
  );
};
</script>

<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <div class="flex-between">
          <h5>Clients list</h5>
          <Link
            v-if="permissions.includes('create client')"
            as="a"
            :href="route('clients.create')"
            class="btn btn-sm btn-primary"
          >
            <i class="fa fa-plus me-1"></i>
            Create client
          </Link>
        </div>
      </div>
      <div class="card-body table-responsive">
        <Alert color="success" :message="$page.props.session.success" />
        <table class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Created at</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-if="clients?.total > 0" v-for="client in clients?.data">
              <td>{{ client.name }}</td>
              <td>{{ client.created_at }}</td>
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
                      v-if="permissions.includes('update client')"
                      :href="route('clients.edit', client)"
                    >
                      <i class="fa fa-edit text-primary me-1"></i>
                      Edit
                    </Link>
                    <div
                      class="dropdown-item"
                      v-if="permissions.includes('delete client')" 
                      @click="deleteClient(client.id)"
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
        <Pagination :data="clients" />
      </div>
    </div>
  </BaseLayout>
</template>
