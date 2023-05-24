<script setup>
import { useForm } from "@inertiajs/vue3";

const handleSubmit = () => useForm().post(route("verification.resend"));
</script>
<template>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Verify Your Email Address</div>

          <div class="card-body">
            <div
              class="alert alert-success"
              role="alert"
              v-if="$page.props.session.resent"
            >
              A fresh verification link has been sent to your email address.
            </div>
            Before proceeding, please check your email for a verification link.
            If you did not receive the email
            <form class="d-inline" @submit.prevent="handleSubmit">
              <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                click here to request another
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
