<template>
  <div id="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Attendi...</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "Loader",
};
</script>

<style lang="scss" scoped>
#loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(0, 0, 0, 0.507);
    z-index: 1;
}
</style>