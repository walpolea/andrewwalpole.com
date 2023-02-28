---
tags: 
  - post
  - published
  - back-end
  - serverless
  - web
title: Audit Content Reads with Cloudflare KV
slug: audit-content-reads-with-cloudflare-kv
summary: Let's look at how expectations can be used as an explicit device to improve work and working relationships.
date: 2023-02-27 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/audit-content-reads-with-cloudflare-kv.mp3"
---

# Audit Content Reads with Cloudflare KV

Back when I built my current site in Eleventy, I [talked about how to use petite-vue and Cloudflare KV](/blog/building-a-like-button-with-cloudflare-workers) to create a like button for your webpage. *Look! There it is over on the bottom right of this page (sorry RSS folks), maybe you should click it to make sure it works!*

To this day, that post is quite popular and holds up well if you want to follow along with the KV and edge function setup.

Recently, I used the same concept to track page reads on my site. What's a page read? Well, for me it's just that you've scrolled to the end of the page. This will let me audit, very generally, how many folks are engaging with my posts and getting to the end.

The new part of this setup was no longer creating something waiting for user interaction. Instead, I needed something to trigger when it came into view at the end of the page. While rolling your own `IntersectionObserver` isn't too painful, there was an even better solution at hand.

## Astro Islands and client:visible

Astro's islands architecture treats your UI components as build-time rendered by default. When you want to make a client-side component interactive with JavaScript, you need to explicitly add a directive to it to tell Astro to hydrate it. One of the directives is `client:visible` which handles all the `IntersectionObserver` setup automatically.

So all I needed to do was build a Vue component that `onMounted()` pings my edge function read counter, and that's it! Here's a look at that Vue component:


```vue
<template>
  <div style="visibility:hidden;"></div>
</template>

<script setup>

import { ref, onMounted } from "vue";

const endpoint = 'https://pagereader.walpolea.workers.dev/';
const {title} = defineProps(['title']);
const reads = ref(undefined);

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
```

The component is comprised of a hidden empty `<div>` and takes a title prop, which `onMounted()`, is used to ping the `pagereader` service.

And here is how it's used with the `client:visible` directive:

```jsx
<PageReader title={Astro.url.pathname} client:visible />
```

In my Cloudflare dashboard I can view the KV store to see my current counts.

There's nothing too ground-breaking here, but analytics platforms these days are often heavy and intrusive. On the flip side, server-based analytics have a terrible time distinguishing between bot and meat traffic. So I quite like this as a simple middle-ground solution that, thanks to Astro, was very easy to put in place.
