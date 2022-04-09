<template>
  <div class="form-group" v-if="options.length">
    <label :for="id">{{ labelText }}</label>
    <select class="form-control" :id="id" v-model="selectedValue" @change="$emit('filter-change', selectedValue)">
      <option :value="defaultValue">{{ defaultOption }}</option>
      <option v-for="(option, i) in options" :key="i" :value="option[optionValue]">{{ option[optionText] }}</option>
    </select>
  </div>
</template>

<script>
export default {
  name: "SelectiorOptions",
  props: ['labelText', 'defaultOption','defaultValue', 'optionText', 'optionValue','options','id'],
  data() {
    return {
      selectedValue: this.defaultValue || "",
    };
  },
};
</script>

<style>
</style>