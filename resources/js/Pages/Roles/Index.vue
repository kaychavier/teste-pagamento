<script setup>
import Pagination from "../../Components/Global/Pagination.vue";
import BaseLayout from "../../layouts/BaseLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Alert from "../../Components/Global/Alert.vue";
import { swalConfirm } from "../../Assets/js/constants";

const { permissions } = usePage().props.auth.user;
defineProps({
  roles: Object,
});
const deleteRole = (id) => {
  swalConfirm(
    ({ isConfirmed }) =>
      isConfirmed && router.delete(route("roles.destroy", id))
  );
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <div class="flex-between">
          <h5>Roles list</h5>
          <Link
            v-if="permissions.includes('create role')"
            as="a"
            :href="route('roles.create')"
            class="btn btn-sm btn-primary"
          >
            <i class="fa fa-plus me-1"></i>
            Create role
          </Link>
        </div>
      </div>
      <div class="card-body table-responsive">
        <Alert color="success" :message="$page.props.session.success" />
        <table class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Created At</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-if="roles?.total > 0" v-for="role in roles?.data">
              <td>{{ role.name }}</td>
              <td>{{ role.created_at }}</td>
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
                      v-if="permissions.includes('update role')"
                      :href="route('roles.edit', role)"
                    >
                      <i class="fa fa-edit text-primary me-1"></i>
                      Edit
                    </Link>
                    <div
                      class="dropdown-item"
                      @click="deleteRole(role.id)"
                      v-if="permissions.includes('delete role')"
                    >
                      <i class="fa fa-trash-alt text-danger me-1"></i>
                      Delete
                    </div>
                  </ul>
                </div>
              </td>
            </tr>
            <tr v-else>
              <td colspan="5">Nenhum usuário encontrado...</td>
            </tr>
          </tbody>
        </table>
        <Pagination :data="roles" />
      </div>
    </div>
  </BaseLayout>
</template>
