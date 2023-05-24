<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import { defineProps, ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

const { user, roles } = defineProps({
  user: Object,
  roles: Array,
});
const form = useForm({
  id: user.id,
  name: user.name,
  email: user.email,
  role_id: user.role_id || null,
  password: undefined,
  password_confirmation: undefined,
});
const handleSubmit = () => {
  const options = {
    onBefore: () => form.clearErrors(),
  };
  if (user.id) return form.put(route("users.update", user), options);
  form.post(route("users.store"), options);
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <h5>
          {{ user?.id ? "Edit" : "Create" }}
          {{ $page.props.auth.id == user.id ? "Profile" : "User" }}
        </h5>
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
          <div class="form-floating mb-2">
            <input
              :class="`form-control ${form.errors.email && 'is-invalid'}`"
              id="email"
              type="email"
              placeholder="Email"
              v-model="form.email"
            />
            <label for="email">Email</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.email }}</strong>
            </span>
          </div>
          <div class="form-floating mb-2" v-if="$page.props.auth.id != user.id">
            <select
              v-model="form.role_id"
              :class="`form-select ${form.errors.role_id && 'is-invalid'}`"
              id="role_id"
            >
              <option :value="null">Select the role</option>
              <option v-for="role in roles" :value="role.id">
                {{ role.name }}
              </option>
            </select>
            <label for="role_id">Perfil</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.role_id }}</strong>
            </span>
          </div>
          <div class="form-floating mb-2">
            <input
              :class="`form-control ${form.errors.password && 'is-invalid'}`"
              id="password"
              type="password"
              placeholder="Password"
              v-model="form.password"
            />
            <label for="password">Password</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.password }}</strong>
            </span>
          </div>
          <div class="form-floating mb-2">
            <input
              :class="`form-control ${
                form.errors.password_confirmation && 'is-invalid'
              }`"
              id="password_confirmation"
              type="password"
              placeholder="Confirm Password"
              v-model="form.password_confirmation"
            />
            <label for="password_confirmation">Confirm Password</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.password_confirmation }}</strong>
            </span>
          </div>
          <button class="btn btn-sm btn-primary" :disabled="form.processing">
            <template v-if="!form.processing">
              <i class="fa fa-save me-1"></i>
              Salve
            </template>
            <template v-else>
              <div class="spinner-border spinner-border-sm text-light"></div>
            </template>
          </button>
          <Link
            as="a"
            class="ms-1 btn btn-sm btn-dark"
            :href="route('users.index')"
          >
            <i class="fa fa-list me-1"></i>
            See listing
          </Link>
        </form>
      </div>
    </div>
  </BaseLayout>
</template>
