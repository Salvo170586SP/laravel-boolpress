<template>
  <div class="form-group" v-if="options.length">
    <label :for="id">{{ labelText }}</label>
    <select class="form-control" :id="id" v-model="selectedValue">
      <option value="">{{ defaultOption }}</option>
      <option v-for="(option, i) in options" :key="i" :value="options[optionValue]">{{ option[optionText] }}</option>
    </select>
  </div>
</template>

<script>
export default {
  name: "SelectiorOptions",
  props: ['labelText', 'nameOption','defaultOption','defaultValue', 'optionText', 'optionValue','options'],
  data() {
    return {
      selectedValue: "",
    };
  },
};
</script>

<style>
</style>