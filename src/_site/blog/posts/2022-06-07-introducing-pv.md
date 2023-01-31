---
layout: blog_base.njk
tags: 
  - post
title: Introducing PV
summary: A quick introduction to a petite-vue wrapper I wrote called PV.
date: 2022-06-07
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
hide: true
featuredImage: "https://andrewwalpole.com/static/NAME.png"

---

{{page.date | readableDate}}
# {{title}}

It's no secret that I'm a fan of using [petite-vue](https://github.com/vuejs/petite-vue) to sprinkle in interactive components among static web content. After using it regularly for some time and also getting a spark of inspiration from my co-worker [Alex](https://alex.party) I published [a small but mighty wrapper library, called PV](https://github.com/walpolea/PV), that helps you to organize your petite-vue islands into reusable **"scopes"**. Not only does it help with making multiple petite-vue components available to your site, it also leans on `@vue/reactive` to provide a global reactive state store object that bridges your islands of interactivity if you need.

## PV Usage

If you've used petite-vue before, the idea of a scope function is not new. Beyond that, PV has a simple API to register and hydrate your scopes:

```js
import PV from 'pv.es.js';

//create a petite-vue scope
const counter = (store) => {
  
  return {
    localCount:0,
    get count() {
      return store.count
    },
    inc() {
      this.localCount++;
      store.count++;
    }
  }
}

//register your scope with PV, you can do this anywhere, across files even
PV.registerScope( "counter", counter );

//Optionally, you can initialize the global store if you like:
PV.initializeStore( {
  count:0
});

//when you're ready, hydrate your islands on the page:
const app = PV.mount();
```


On the HTML side you might have something like this:
{% raw %}
```html
<!-- globalStore is the name of the provided global store,
     pass it in to any scope for use -->
<div v-scope="counter(globalStore)">
  <h2>Counter:</h2>
  <p>Local Count: {{localCount}}</p>
  <p>Global Count: {{count}}</p>

  <button @click="inc">increment</button>
</div>

<!-- You can also create a scope on the fly with just globalStore -->
<div v-scope="{ globalStore }">
  <p>Count: {{globalStore.count}}</p>
  <pre>
    {{ globalStore }}
  </pre>
</div>
```
{% endraw %}
In this case, our counter takes in the `globalStore` and modifies the count. While our on-the-fly scope also references the `globalStore` and is also able to update when the counter does.

You can see a slightly more expanded [demo here](https://codepen.io/walpolea/pen/xxYzeyj).

While there are some great frameworks out there that are enabling this islands architecture, consider petite-vue for smaller, simpler projects, or also as an add-on to things like wordpress.