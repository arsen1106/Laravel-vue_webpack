<template>
  <div>
    <AsideComponent></AsideComponent>
    <div class="page-container">
      <HeaderComponent></HeaderComponent>
      <MainComponent></MainComponent>
      <FooterComponent></FooterComponent>
    </div>
  </div>
</template>

<script>

  import AsideComponent from "./AsideComponent";
  import HeaderComponent from "./HeaderComponent";
  import MainComponent from "./MainComponent";
  import FooterComponent from "./FooterComponent";

  export default {
    name: "MenuComponent",
    components: {FooterComponent, MainComponent, HeaderComponent, AsideComponent},
  }
</script>

<style scoped>

</style>
