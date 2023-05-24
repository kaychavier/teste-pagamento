<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  email: "",
});
const handleSubmit = () =>
  form.post(route("password.email"), {
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
            <div
              class="alert alert-success text-white"
              role="alert"
              v-if="$page.props.session.status"
            >
              {{ $page.props.session.status }}
            </div>

            <form @submit.prevent="handleSubmit">
              <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">
                  Email Address
                </label>

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    :class="`form-control ${form.errors.email && 'is-invalid'}`"
                    required
                    v-model="form.email"
                    autocomplete="email"
                    autofocus
                  />
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ form.errors.email }}</strong>
                  </span>
                </div>
              </div>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
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
