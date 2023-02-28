<template>
  <!-- Page Reader is simple homegrown analytics -->
  <div style="visibility:hidden;"></div>
</template>

<script setup>

import { ref, onMounted } from "vue";

const endpoint = 'https://pagereads.walpolea.workers.dev/';
const {title} = defineProps(['title']);
const reads = ref(0);

const postRead = async (title) => {
  if(title) {
    const response = await ( await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({title})
    })).json();

    reads.value = response.reads;
  } 
}

onMounted( () => {
  postRead( title );
});

</script>