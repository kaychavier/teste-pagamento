<script setup>
import BaseLayout from "../../layouts/BaseLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Pagination from "../../Components/Global/Pagination.vue";
import Alert from "../../Components/Global/Alert.vue";
import { swalConfirm } from "../../Assets/js/constants";

const { permissions } = usePage().props.auth.user;
defineProps({
  users: Object,
});
const deleteUser = (id) => {
  swalConfirm(
    ({ isConfirmed }) =>
      isConfirmed && router.delete(route("users.destroy", id))
  );
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <div class="flex-between">
          <h5>Users list</h5>
          <Link
            v-if="permissions.includes('create user')"
            as="a"
            :href="route('users.create')"
            class="btn btn-sm btn-primary"
          >
            <i class="fa fa-plus me-1"></i>
            Create user
          </Link>
        </div>
      </div>
      <div class="card-body table-responsive">
        <Alert color="success" :message="$page.props.session.success" />
        <table class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created at</th>
            <th></th>
          </thead>
          <tbody>
            <tr v-if="users?.total > 0" v-for="user in users?.data">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role?.name }}</td>
              <td>{{ user.created_at }}</td>
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
                      v-if="permissions.includes('update user')"
                      :href="route('users.edit', user)"
                    >
                      <i class="fa fa-edit text-primary me-1"></i>
                      Edit
                    </Link>
                    <div
                      class="dropdown-item"
                      @click="deleteUser(user.id)"
                      v-if="permissions.includes('delete user')"
                    >
                      <i class="fa fa-trash-alt text-danger me-1"></i>
                      Delete
                    </div>
                  </ul>
                </div>
              </td>
            </tr>
            <tr v-else>
              <td colspan="5">No users found...</td>
            </tr>
          </tbody>
        </table>
        <Pagination :data="users" />
      </div>
    </div>
  </BaseLayout>
</template>
<style>
.table-responsive {
  overflow-x: hidden;
}
</style>
