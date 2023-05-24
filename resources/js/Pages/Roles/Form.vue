<script setup>
import { useForm, Link } from "@inertiajs/vue3";
import BaseLayout from "../../layouts/BaseLayout.vue";

const { role, permissions } = defineProps({
  permissions: Array,
  role: Object,
});
const form = useForm({
  name: role.name,
  permissions: role.permissions.map((p) => p.id),
});
const togglePermission = ({ id }) => {
  if (form.permissions.includes(id)) {
    form.permissions = form.permissions.filter((p) => p != id);
    return;
  }
  form.permissions.push(id);
};
const handleSubmit = () => {
  const options = {
    onBefore: () => form.clearErrors(),
  };
  if (role.id) return form.put(route("roles.update", role), options);
  form.post(route("roles.store"), options);
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <h5>{{ role?.id ? "Edit" : "Create" }} Role</h5>
      </div>
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <div class="form-floating mb-2">
            <input
              :class="`form-control ${form.errors.name && 'is-invalid'}`"
              id="name"
              placeholder="Name"
              v-model="form.name"
            />
            <label for="name">Name</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.name }}</strong>
            </span>
          </div>
          <div class="row mb-2">
            <div class="col-6 col-md-3" v-for="permission in permissions">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  :id="`permission-${permission.id}`"
                  :checked="form.permissions.includes(permission.id)"
                  @change="togglePermission(permission)"
                />
                <label
                  class="form-check-label"
                  :for="`permission-${permission.id}`"
                >
                  {{ permission.name }}
                </label>
              </div>
            </div>
          </div>
          <button class="btn btn-sm btn-primary" :disabled="form.processing">
            <template v-if="!form.processing">
              <i class="fa fa-save me-1"></i>
              Save
            </template>
            <template v-else>
              <div class="spinner-border spinner-border-sm text-light"></div>
            </template>
          </button>
          <Link
            as="a"
            class="ms-1 btn btn-sm btn-dark"
            :href="route('roles.index')"
          >
            <i class="fa fa-list me-1"></i>
            See listing
          </Link>
        </form>
      </div>
    </div>
  </BaseLayout>
</template>
