<template>
  <label class="color-toggle">
    <input  type="checkbox" v-model="colorMode">
  </label>
</template>

<script setup>

import { ref, watch, onMounted } from "vue"

const colorMode = ref(false);

onMounted( () => {
  colorMode.value = window.colorTheme === "dark";
});

watch(colorMode, (newValue) => {
  window.setDarkMode( newValue ? "dark" : "light");
});

</script>

<style lang='scss'>

.color-toggle {

  position:absolute;
  top:0;
  right:0;
  cursor:pointer;

  margin:var(--sp-2);

  input {
    display:none;
  }

  &::before, &::after {
    content:"";
    display:block;
    position:relative;
    top:0;
    right:0;

    width:30px;
    height:30px;
    background-color: var(--fg-color);
    border-radius:100%;
    transition: top .2s, right .2s, background-color 0.2s;
  }

  &::after {
    position:absolute;
    top:0;
    right:0;
  }

  &:has(input:not(:checked)) {
    &::after {
      top:-30%;
      right:-40%;

      background-color: var(--bg-color);
    }
  }

}

</style>