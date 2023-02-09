<template>
  <div class="blog-list-item">
    <p v-if="entry?.data.date" class="date">{{formattedPublishDate}}</p>
    <a class="title-link" :href="url">{{entry.data.title}}</a>
    <p v-if="entry?.data.summary" class="summary">{{entry.data.summary}}</p>
  </div>
</template>

<script setup>

import { formatDate } from "../js/formatters";

const {entry} = defineProps(['entry']);

const url = `/${entry.collection}/${entry.data.slug}`;
const formattedPublishDate = formatDate( entry.data.date );

</script>

<style lang="scss" scoped>

.blog-list-item {

  a {
    text-decoration: none;

    &:hover, &:active, &:focus {
      background-color:var(--bg-alt);
    }
  }

  .date {
    font-size: var(--fs--1);
    font-family: var(--ff-serif);
    font-style:italic;
    margin-bottom: var(--sp-1);
  }

  .title-link {
    font-size: var(--fs-2);
    line-height: 1.1;
    align-self: start;
  }

  .summary {
    font-size: var(--fs--2);
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 4; /* number of lines to show */
    -webkit-box-orient: vertical;
    line-clamp: 4; 
  }
}

</style>