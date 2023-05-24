<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  password: "",
});
const handleSubmit = () =>
  form.post(route("password.confirm"), {
    onBefore: () => form.clearErrors(),
  });
</script>
<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Confirm Password</div>

          <div class="card-body">
            Please confirm your password before continuing.
            <form @submit.prevent="handleSubmit">
              <div class="row mb-3">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-end"
                  >Password"</label
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
                    autocomplete="current-password"
                  />
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ form.errors.password }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Confirm Password
                  </button>
                  <a class="btn btn-link" :href="route('password.request')">
                    Forgot Your Password?
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
