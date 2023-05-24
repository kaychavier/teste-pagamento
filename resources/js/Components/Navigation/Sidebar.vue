<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const { currentRoute, auth } = usePage().props;
const hasPermission = (p) => auth.user.permissions.includes(p);
const getClassLink = (name) => `nav-link ${name == currentRoute && "active"}`;
const currentUrl = ref(window.location.href);
</script>
<template>
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main"
  >
    <div class="sidenav-header">
      <i
        class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true"
        id="iconSidenav"
      ></i>
      <a
        class="navbar-brand m-0"
        href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
        target="_blank"
      >
        <img
          src="../../assets/img/logo-ct-dark.png"
          class="navbar-brand-img h-100"
          alt="main_logo"
        />
        <span class="ms-1 font-weight-bold">Argon Dashboard 2</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0" />
    <div
      class="collapse navbar-collapse w-auto h-auto"
      id="sidenav-collapse-main"
    >
      <ul class="navbar-nav">
        <li class="nav-item" v-if="hasPermission('ver dashboard')">
          <Link as="a" :href="route('home')" :class="getClassLink('home')">
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">dashboard</span>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </Link>
        </li>
        <li class="nav-item" v-if="hasPermission('list user')">
          <Link
            as="a"
            :href="route('users.index')"
            :class="getClassLink('users.index')"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">people_outline</span>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </Link>
        </li>
        <li class="nav-item" v-if="hasPermission('list role')">
          <Link
            as="a"
            :href="route('roles.index')"
            :class="getClassLink('roles.index')"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">admin_panel_settings</span>
            </div>
            <span class="nav-link-text ms-1">Roles</span>
          </Link>
        </li>
        <li class="nav-item" v-if="hasPermission('list client')">
          <Link
            as="a"
            :href="route('clients.index')"
            :class="getClassLink('clients.index')"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">person_add</span>
            </div>
            <span class="nav-link-text ms-1">Clients</span>
          </Link>
        </li>
        <li class="nav-item" v-if="hasPermission('list product')">
          <Link
            as="a"
            :href="route('products.index')"
            :class="getClassLink('products.index')"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">shopping_cart</span>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </Link>
        </li>
         <li class="nav-item" v-if="hasPermission('list purchase')">
          <Link
            as="a"
            :href="route('purchases.index')"
            :class="getClassLink('purchases.index')"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">payments</span>
            </div>
            <span class="nav-link-text ms-1">Purchases</span>
          </Link>
        </li>
        <li class="nav-item mt-3">
          <h6
            class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6"
          >
            Account pages
          </h6>
        </li>
        <li class="nav-item">
          <Link
            as="a"
            :href="route('users.edit', $page.props.auth.user)"
            :class="`nav-link ${
              currentUrl == route('users.edit', $page.props.auth.id) && 'active'
            }`"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">portrait</span>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </Link>
        </li>
        <li class="nav-item">
          <Link
            as="a"
            :href="route('logout')"
            method="POST"
            class="nav-link text-danger cursor-pointer"
          >
            <div
              class="icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
            >
              <span class="material-icons">logout</span>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </Link>
        </li>
      </ul>
    </div>
  </aside>
</template>
