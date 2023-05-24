<script setup>
import BaseLayout from "../../layouts/BaseLayout.vue";
import { defineProps, ref } from "vue";
import { useForm, Link } from "@inertiajs/vue3";

const { purchase, clients, products } = defineProps({
  purchase: Object,
  clients: Array,
  products: Array,
});

const form = useForm({
  id: purchase.id,
  client_id: purchase.client_id,
  products: purchase.products.map((p) => ({
    ...p,
    product_id: p.id,
    quantity: p.pivot?.quantity,
  })),
  price: purchase.price || 0,
  payment_method: purchase.payment_method,
  installments: purchase.installments,
  installments_qty: purchase.installments.length,
});
const handleSubmit = () => {
  const options = {
    onBefore: () => form.clearErrors(),
  };
  if (purchase.id)
    return form.put(route("purchases.update", purchase), options);
  form.post(route("purchases.store"), options);
};

const setPrice = () => {
  form.price = 0;
  form.products.forEach((product) => {
    const { price } = products.find((p) => p.id == product.product_id);
    form.price += price * (product.quantity || 1);
  });
};

const setInstallments = () => {
  form.installments = [];
  for (let i = 0; i < form.installments_qty; i++) {
    form.installments[i] = {
      price: form.price / form.installments_qty,
      observation: null,
      expiration_date: null,
    };
  }
};
</script>
<template>
  <BaseLayout>
    <div class="card">
      <div class="card-header border-bottom pb-0">
        <h5>
          {{ purchase?.id ? "Edit" : "Create" }}
        </h5>
      </div>
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <div class="form-floating mb-2">
            <select
              :class="`form-control ${form.errors.client_id && 'is-invalid'}`"
              id="client_id"
              v-model="form.client_id"
            >
              <option v-for="client in clients" :value="client.id">
                {{ client.name }}
              </option>
            </select>
            <label for="client_id">Client</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.client_id }}</strong>
            </span>
          </div>
          <div class="form-floating mb-2">
            <select
              :class="`form-control ${
                form.errors.payment_method && 'is-invalid'
              }`"
              id="payment_method"
              v-model="form.payment_method"
            >
              <option
                v-for="method in ['Boleto', 'Cartão de crédito', 'Pix']"
                :value="method"
              >
                {{ method }}
              </option>
            </select>
            <label for="payment_method">Payment Method</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.payment_method }}</strong>
            </span>
          </div>
          <div class="row g-2" v-for="product in form.products">
            <div class="col-5">
              <div class="form-floating mb-2">
                <select
                  :class="`form-control`"
                  v-model="product.product_id"
                  required
                  @change="setPrice()"
                >
                  <option v-for="pr in products" :value="pr.id">
                    {{ pr.name }}
                  </option>
                </select>
                <label>Product</label>
              </div>
            </div>
            <div class="col-5">
              <div class="form-floating mb-2">
                <input
                  :class="`form-control`"
                  placeholder="Price"
                  v-model="product.quantity"
                  type="number"
                  min="1"
                  required
                  @input="setPrice()"
                />
                <label>Quantity</label>
              </div>
            </div>
            <div class="col-2">
              <button
                class="btn btn-sm btn-danger d-block"
                type="button"
                @click="
                  form.products = form.products.filter((p) => p != product);
                  setPrice();
                "
              >
                <span class="material-icons"> delete </span>
              </button>
            </div>
          </div>
          <button
            class="btn btn-sm btn-success d-block"
            type="button"
            @click="form.products.push({ product_id: null, quantity: 1 })"
          >
            Add Product
          </button>
          <p>Price: R$ {{ form.price }}</p>
          <div class="form-floating mb-2" v-if="form.price > 0">
            <input
              @input="setInstallments()"
              :class="`form-control ${
                form.errors.installments_qty && 'is-invalid'
              }`"
              id="installments_qty"
              placeholder="Installments"
              v-model="form.installments_qty"
              type="number"
              min="1"
            />
            <label for="installments_qty">Installments</label>
            <span class="invalid-feedback" role="alert">
              <strong>{{ form.errors.installments_qty }}</strong>
            </span>
          </div>
          <div
            class="row g-2"
            v-for="installment in form.installments"
            v-if="form.price > 0"
          >
            <div class="col-4">
              <div class="form-floating mb-2">
                <input
                  :class="`form-control `"
                  placeholder="Price"
                  v-model="installment.price"
                  type="number"
                  min="1"
                  disabled
                />
                <label>Price</label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-2">
                <input
                  :class="`form-control `"
                  placeholder="Expiration Date"
                  v-model="installment.expiration_date"
                  type="date"
                  required
                />
                <label>Expiration Date</label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-floating mb-2">
                <input
                  :class="`form-control `"
                  placeholder="Observation"
                  v-model="installment.observation"
                />
                <label>Observation</label>
              </div>
            </div>
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
            :href="route('purchases.index')"
          >
            <i class="fa fa-list me-1"></i>
            See listing
          </Link>
        </form>
      </div>
    </div>
  </BaseLayout>
</template>
