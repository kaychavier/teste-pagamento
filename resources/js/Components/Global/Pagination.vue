<template>
  <div>
    <ul class="pagination">
      <template v-for="link in data.links">
        <li class="page-item" v-if="verifyLink(link)">
          <Link
            class="page-link"
            :href="link.url"
            as="a"
            v-html="link.label.replace('Previous', '').replace('Next', '')"
          ></Link>
        </li>
      </template>
    </ul>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const { data } = defineProps({
  data: Object,
});
const verifyLink = ({ label, url }) => {
  const { current_page, last_page } = data;
  const minPage = current_page - 2 >= 1 ? current_page - 2 : 1;
  const maxPage = current_page + 2 <= last_page ? current_page + 2 : last_page;
  return (isNaN(label) || (label >= minPage && label <= maxPage)) && url;
};
</script>
