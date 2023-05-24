<script setup>
const toggleSidebar = () =>
  document.querySelector("body").classList.toggle("g-sidenav-pinned");
const search = new URLSearchParams(location.search).get("search");
</script>
<template>
  <nav
    class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
    id="navbarBlur"
    data-scroll="false"
  >
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li
            v-for="item in $page.props.currentRoute.split('.')"
            class="breadcrumb-item text-sm text-white active"
          >
            {{ item == "index" ? "LIST" : item.toUpperCase() }}
          </li>
        </ol>
      </nav>
      <div
        class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
        id="navbar"
      >
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group">
            <form>
              <input
                type="search"
                class="form-control"
                placeholder="Pesquisar..."
                name="search"
                :value="search"
              />
            </form>
          </div>
        </div>
        <ul class="navbar-nav justify-content-end">
          <li
            class="nav-item d-xl-none d-flex align-items-center"
            @click="toggleSidebar"
          >
            <a class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
