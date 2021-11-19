<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>
<script>
// import HeaderComponent from "../components/HeaderComponent.vue";
// import FooterComponent from "../components/FooterComponent.vue";

export default {
  name: "app",
  //   components: { HeaderComponent, FooterComponent },
  //   watch: {
  //     $route() {
  //       $("#navbarCollapse").collapse("hide");
  //     },
  //   },
  //   created(){
  //     let addScript = document.createElement('script');
  //     addScript.setAttribute('src',"https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js");
  //     document.head.appendChild(addScript);
  //   },
};
</script>

<style>
body {
  font-family: "Sarabun", sans-serif;
}
</style>
