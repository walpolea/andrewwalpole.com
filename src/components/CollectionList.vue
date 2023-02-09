<template>
    <div v-if="interactive" class="filter">
      <ul class="filter-list">
        <li class="filterbox" v-for="cat in allCategories">
          <label   :class="{checked:chosenCategories.includes(cat)}">
            <input  type="checkbox" v-model="chosenCategories" :value="cat">{{cat}}
          </label>
        </li>
      </ul>
    </div>
    <ul class="collection-list">
      <li v-for="post in filteredPosts" key="post.id">
        <CollectionListItem :entry="post" />
      </li>
    </ul>
</template>

<script setup>
  import { ref, computed, onMounted } from "vue";
  import CollectionListItem from "./CollectionListItem.vue";

  const {posts} = defineProps(['posts']);
  const chosenCategories = ref([]);
  const interactive = ref(false);

  onMounted( () => {
    interactive.value = true;
  });

  const allCategories = Array.from( new Set( posts.map( p=>p.data.tags).flat().filter( c => c && c !== "post" && c !== "published") ) );
  
  const filteredPosts = computed( () => {
    if(chosenCategories.value.length === 0) {
      return posts;
    }

    return posts.filter( p => p.data.tags?.some( t => chosenCategories.value.includes(t) ) );
  });

</script>

<style lang="scss">

.collection-list {

  margin-top:var(--sp-12);
  display:grid;

  grid-template-columns: repeat( auto-fill, minmax( 300px, 1fr) );
  gap: var(--sp-5);

  list-style:none;

}

ul {
  padding:0;
}

.filterbox {

  border:2px solid var(--fg-color);
  border-radius:20px;
  padding:6px 15px;
  margin:4px;

  display:inline-block;
  user-select: none;
  text-align: center;
  font-size: var(--fs--2);

  input {
    display:none;
  }

  &:has(label.checked) {
    background: var(--accent-color);
  }
}

</style>