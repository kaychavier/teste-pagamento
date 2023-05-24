|
<script setup>
import { useForm } from "@inertiajs/vue3";

const { token, email } = defineProps({
  token: String,
  email: String,
});
const form = useForm({
  token,
  email,
  password: "",
  password_confirmation: "",
});
const handleSubmit = () =>
  form.post(route("password.update"), {
    onBefore: () => form.clearErrors(),
  });
</script>
<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Reset Password</div>

          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <input type="hidden" name="token" v-model="form.token" />

              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                  >Email Address</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    :class="`form-control ${form.errors.email && 'is-invalid'}`"
                    v-model="form.email"
                    required
                    autocomplete="email"
                    autofocus
                  />
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ form.errors.email }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-3">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-end"
                  >Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    :class="`form-control ${
                      form.errors.password && 'is-invalid'
                    }`"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                  />
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ form.errors.password }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-3">
                <label
                  for="password-confirm"
                  class="col-md-4 col-form-label text-md-end"
                  >Confirm Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password-confirm"
                    type="password"
                    class="form-control"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                  />
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Reset Password
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
