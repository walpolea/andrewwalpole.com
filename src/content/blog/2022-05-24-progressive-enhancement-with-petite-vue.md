---
tags: 
  - post
  - published
  - petite-vue
  - front-end
title: Progressive Enhancement with Petite-vue
slug: progressive-enhancement-with-petite-vue
summary: Rather than having to completely rely on the client to render your content when you want to make it interactive or functional, progressively enhance it with petite-vue.
date: 2022-05-24
featuredImage: "https://andrewwalpole.com/static/blog/progressive-enhancement-with-petite-vue.png"

---


# Progressive Enhancement with Petite-vue

I recently wrote about how petite-vue is a great way to [sprinkle in interactivity](/blog/sprinkling-interactivity-with-petite-vue). There's a downside to putting all your eggs in the JavaScript basket though, especially when it involves rendering content. There's a whole fuzzy world of, *just because you can, doesn't mean you should* web dev things, and this is definitely one of them.

Similar to Single-Page Applications (SPAs), you'll have a rougher time with SEO, because the content isn't there when the page loads, it's being added at runtime. Also, if JavaScript is turned off, your users will get served up a whole lot of nothin'. [You can debate](https://css-tricks.com/should-a-website-work-without-javascript/) that we're beyond a world that needs the web to work without JavaScript, but I like the idea of approaching JavaScript as a tool for progressive enhancement; the concept has too many benefits to out-right ignore.

## The Problem

To illustrate the problem, here's a pen showing a searchable list of grocery items being rendered to the page using petite-vue. Why not just write HTML? Because we want to enhance this list by making it searchable, and petite-vue makes that elegantly easy.

We use the `v-for` directive to create `<li>`'s from a `filteredList` getter that filters the original list with the `<input>` value. As the search term in the input updates, the `filteredList` getter reruns, causing the `v-for` to rerender the list all in real-time.

<p class="codepen" data-height="450" data-default-tab="html,result" data-slug-hash="QWQqNKj" data-user="walpolea" style="height: 450px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/QWQqNKj">
  Progressively Enhanced Petite-Vue</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

<aside>
As an aside, it's a shame that we have to take full control of rendering the content away from HTML to make this work easily. This would be one of the possible scenarios that could be fixed by <a href="/blog/the-fourth-language">a fourth language</a> centered around keeping track of interactive page state.
</aside>
<br>


## The Solution

Let's fix the problem with a progressive enhancement pattern in petite-vue.

Effectively, we're going to provide the list (without search functionality) as static markup, and then use petite-vue to rerender that content with its own markup. It's essentially a bait-and-switch of static content with interactive content. As long as your markup matches, the user won't notice any large content shifting, except for where there are added functional pieces, like the search box.

Hit `Rerun` down in the bottom right to see the progressive enhancement happen. For dramatic effect, there's a 2 second `setTimeout` delay to give you time to see the original static content, and then watch the content become enhanced. In reality, with a quick loading site, users likely won't even notice the transition happen.

<p class="codepen" data-height="450" data-default-tab="js,result" data-slug-hash="qBxPqmY" data-user="walpolea" style="height: 450px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/qBxPqmY">
  Progressively Enhanced Petite-Vue</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>
<br>

## The Progressive Enhancement Pattern

Let's pull apart the example and break down the pattern, because that's the bit that can be applied to a whole host of situations where you want to use petite-vue to progressively enhance your content.

### Javascript

First let's get the JavaScript out of the way, because it's important that I don't leave you in the dark, but it really has little bearing on the pattern:

```js
import { createApp } from 'https://unpkg.com/petite-vue?module';

const searchableList = ({list}) => {
  return {
    list,
    initialized:false,
    search:'',
    //when the scope mounts, set initialized to true
    async mounted() {
      await new Promise(resolve => setTimeout(resolve, 2000)); //artificial delay
      this.initialized = true;
    },
    //return a filtered version of the full list based on the search term
    get filteredList() {
      if( this.search ) {
        return this.list.filter( g => g.toLowerCase().includes(this.search.toLowerCase()) )
      }
      //otherwise, no search term, return the full list
      return this.list;
    }
  };
}

//this tells petite-vue to look for v-scope directives on the page,
//and we register the ability to use the searchableList scope we built
createApp({
  searchableList
}).mount()
```
<br>

### HTML 

The HTML is really where we can call out the progressive enhancement pattern. We separate the block into two main parts:

```html
<div class="container" v-scope="searchableList({list:groceries})" @vue:mounted="mounted">
  <template v-if="initialized">
    <!--   This only shows when petite-vue runs and sets initialized to true  -->
    <h1>Enhanced with Petite-vue</h1>
    <input type="text" v-model="search" placeholder="search groceries">
    <ul>
      <li v-for="item in filteredList">{{item}}</li>
    </ul>
  </template>
  ...
  ```

The first block, within a `<template>` tag will be the petite-vue enhancement. we will add the `v-if="initialized"` directive so that this tag will not render unless initialize is evaluated by petite-vue as true. The beauty here is that HTML won't render a `<template>` tag into the page either, so if JavaScript hasn't run, we never see this content. Inside is all the stuff from the earlier demo, using `v-for` and such.


```html
  ...
  <div v-else>
    <!--   This content would be statically or server generated and hide when petite-vue runs  -->
    <h1>Statically Rendered Content</h1>
    <ul>
      <li>Milk</li>
      <li>Eggs</li>
      <li>Bread</li>
      <li>Jam</li>
      <li>Cheese</li>
      <li>Butter</li>
      <li>Mustard</li>
    </ul>
    <script>
      //this could also be server-generated, which is why I put it up here in the html block
      const groceries = ['Milk', 'Eggs', 'Bread', 'Jam', 'Cheese', 'Butter', 'Mustard'];
    </script>
  </div>
</div>
```

The second part is your statically generated content contained in `<div v-else>`. Once again being tricky, without JavaScript running, the `v-else` gets ignored and the page will render this content as normal. Here you might actually be using something like php or nunjucks or liquid to dynamically generate this markup. Whatever it is, *it's just HTML*, either static or server-generated.

The last added trick is that we need to pass the list of things into petite-vue as JavaScript, so you'll also see a `<script>` tag where we can generate the array petite-vue needs to recreate the list itself. Again, something that can be generated with a templating language.

That's it! When JavaScript is disabled, the static content is displayed by default. But when petite-vue mounts, `initialized` becomes `true` and the static content hides and the enhanced petite-vue content shows.

## tl;dr

It's a little more work, but in a lot of production cases, I find this pattern to be very approachable as a way to provide static content that is then progressively enhanced by JavaScript. I've shipped this pattern on a few sites already with great success (including [this blog's](/blog) tag filtering functionality). The pattern can be broken down as follows:

- Put your enhanced petite-vue markup in a `<template v-if="initialized">`
- Put your static content in a sibling `<div v-else>` tag
- Also render out a `<script>` tag that defines the data petite-vue needs to render its own version of the content.
- Set initialized to `true` when petite-vue mounts, this will hide the static content and show the enhanced content.
