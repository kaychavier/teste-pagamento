<script setup>
import BaseLayout from "../../Layouts/BaseLayout.vue";
import { defineProps, ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

const { client } = defineProps({
  client: Object,
});

const form = useForm({
  id: client.id,
  name: client.name,
});
const handleSubmit = () => {
  const options = {
    onBefore: () => form.clearErrors(),
  };
  if (client.id) return form.put(route("clients.update", client), options);
  form.post(route("clients.store"), options);
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <h5>
          {{ client?.id ? "Edit" : "Create" }}
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
            :href="route('clients.index')"
          >
            <i class="fa fa-list me-1"></i>
            See listing
          </Link>
        </form>
      </div>
    </div>
  </BaseLayout>
</template>
