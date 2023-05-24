<script setup>
import BaseLayout from "../../layouts/BaseLayout.vue";
import { defineProps, ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

const { product } = defineProps({
  product: Object,
});

const form = useForm({
  id: product.id,
  name: product.name,
  price: product.price,
  description: product.description,
  image: null,
  _method: product.id ? "PUT" : undefined,
});
const image = ref(product.image_path);
const setImage = (event) => {
  form.image = event.target.files[0];
  image.value = URL.createObjectURL(form.image);
};
const handleSubmit = () => {
  const options = {
    onBefore: () => form.clearErrors(),
  };
  const formOptions = {
    forceFormData: true,
  };
  if (product.id) {
    return form.post(route("products.update", product), options, formOptions);
  }
  form.post(route("products.store"), options, formOptions);
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <h5>
          {{ product?.id ? "Edit" : "Create" }}
        </h5>
      </div>
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <div class="row mb-2">
            <div class="col-12">
              <img :src="image" class="w-100" v-if="image" />
            </div>
          </div>
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
              :class="`form-control ${form.errors.price && 'is-invalid'}`"
              id="price"
              placeholder="Price"
              v-model="form.price"
              type="number"
              step="0.01"
            />
            <label for="price">Price</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.price }}</strong>
            </span>
          </div>
          <div class="form-floating mb-2">
            <textarea
              :class="`form-control ${form.errors.description && 'is-invalid'}`"
              id="description"
              placeholder="Description"
              v-model="form.description"
              style="resize: none; height: 150px"
            ></textarea>
            <label for="description">Description</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.description }}</strong>
            </span>
          </div>
          <div class="mb-2">
            <input
              :class="`form-control ${form.errors.image && 'is-invalid'}`"
              id="description"
              placeholder="Description"
              type="file"
              accept="image/*"
              @input="setImage"
            />
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.image }}</strong>
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
            :href="route('products.index')"
          >
            <i class="fa fa-list me-1"></i>
            See listing
          </Link>
        </form>
      </div>
    </div>
  </BaseLayout>
</template>
