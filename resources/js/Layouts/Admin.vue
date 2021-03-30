<template>
  <div>
    <sidebar />
    <div class="relative md:ml-64 bg-blueGray-100">
      <admin-navbar />
      <header-stats />
      <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <!-- <router-view /> -->
        <main>
            <slot />
        </main>
        <footer-admin />
      </div>
    </div>
  </div>
</template>
<script>
import AdminNavbar from "@/Layouts/Components/Navbars/Navbar.vue";
import Sidebar from "@/Layouts/Components/Sidebar/Sidebar.vue";
import HeaderStats from "@/Layouts/Components/Headers/Header.vue";
import FooterAdmin from "@/Layouts/Components/Footers/Footer.vue";
export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
    HeaderStats,
    FooterAdmin,
  },
};
</script>
