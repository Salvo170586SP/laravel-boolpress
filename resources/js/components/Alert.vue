<template>
  <div :class="`alert alert-${type || 'dark'}`" role="alert">
    <slot>
      
    </slot>
  </div>
</template>

<script>
export default {
  name: "Alert",
  props: ["type"],
};
</script>