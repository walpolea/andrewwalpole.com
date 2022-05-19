---
layout: blog_base.njk
tags: 
  - post
  - published
  - front-end
  - petite-vue
title: Sprinkling Interaction with Petite-Vue
summary: How do you sprinkle in interactive elements? For many of us it used to be jQuery, and now maybe it's vanilla JS or you've graduated up to a larger framework like React, Vue or Svelte. Here's my case for why you ought to take a look at petite-vue.
date: 2022-05-17
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
---

{{page.date | readableDate}}
# {{title}}

How do you sprinkle on a little bit of interactivity to a website? For many of us, jQuery was the definitive answer; from simple to complex, jQuery fit the bill for a long time. With many of those core DOM APIs getting back-filled into vanilla JavaScript, we have long-since moved away from jQuery.

But even years later, I can't help but still see a gap left in its wake.

## The Gap

Vanilla JS is better than ever, don't get me wrong, but the work to get things hooked-up tends to inflate pretty quickly as your features grow. What you thought would be a sprinkling turns into a dousing. It's too easy to step too far and find yourself nearly writing your own framework.

On the other side, many of us have gone full hog-wild into a framework. React, Svelte, or Vue are great places to have all the interactivity you want at your finger-tips. But with them, comes an almost entirely new workflow to creating a website than just standing up a few `.html`, `.css`, and `.js` files.

So that's the gap: *Vanilla JS is not structured enough, and the big frameworks are too structured*. Isn't there something in the middle?

## Something in the middle: Petite-vue

I've been itching to write this post for a few reasons:

1. *I love [petite-vue](https://github.com/vuejs/petite-vue)*, so I'll share the love, and
2. when it landed people were super excited by the novelty of it – *a mini-Vue, how cute!* – but I don't think it got the full appreciation it deserved.

Petite-vue fills the gap perfectly for me. It's easily added to a site or just a single page, can be written portably and reused, is quite small (`6kb`), and provides you with a declarative approach to interactivity that makes it quick and easy to super-charge your front-end without entirely taking it over.

And the bonus, for Vue-inclined folks, it is a sub-set of Vue syntax, so the learning curve is almost nonexistent.

## Getting Started

There are a few ways you can [get started with petite-vue](https://github.com/vuejs/petite-vue#usage). And certainly, the docs will get you up to speed with the technical basics faster than this post will, but I want to peek into some of the ways I find the library most useful.

### Managing global page state

Petite-vue is great when you want your entire page to react and communicate with itself. Here's a few lines of JavaScript to get us going:

```html
<script type="module">
  import { createApp } from 'https://unpkg.com/petite-vue?module'
  createApp({
    //SOME GLOBAL STATE PROPERTIES & FUNCTIONS
    isDarkMode:false
  }).mount();
</script>

```

This will mount petite-vue to the entire document, allowing you to immediately start using the declarative syntax of it within your html. If you just want to toggle some state and update some classes or css variables based on user interaction, this might be the route for you!

In your HTML you can now access, modify and read your state object to react to the page accordingly:

```html
<label>
  <input type="checkbox" v-model="isDarkMode"> Dark Mode
</label>
<div :class="{darkmode: isDarkMode}">
  Hello World
</div>
```

`isDarkMode` gets assigned to the checked state of the checkbox via the `v-model` directive. And on the div, the class, `darkmode` is present only when `isDarkMode` is `true`.

<p class="codepen" data-height="450" data-default-tab="html,result" data-slug-hash="abqpjGy" data-user="walpolea" style="height: 450px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/abqpjGy">
  Getting Started with Petite-vue</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

<hr>

### Functional components

My next favorite use of petite-vue is to build little functional components. Let's build a simple content accordion. The big difference here is we are no longer attaching petite-vue to the entire page. Instead we're going to surgically inject it into the markup that we want to imbue with super powers.

I have to point out that this is very much a middle-ground between full-page interaction and traditional component frameworks. The goal isn't to fully encapsulate the component into a single function call (though *petite-vue can do that*). Instead, it serves as a way to inject functionality into your markup, allowing the markup and css to stay bespoke while the functionality is consistent.

<p class="codepen" data-height="450" data-default-tab="js,result" data-slug-hash="ExQWyMv" data-user="walpolea" style="height: 450px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/ExQWyMv">
  Getting Started with Petite-vue 2</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

In the JavaScript, we create a function called, `accordion`. That function returns the scope object, which can contain properties and functions that the petite-vue component uses. All we need is an `isOpen` state and a function to calculate the height of the toggleable content when it's opened or closed.

In the html, the `v-scope` attribute is what sets the whole thing in motion. Petite-vue binds that object to this element, and all children now have access. You can see we're using `isOpen` a bunch to set attributes and make the whole accordion work. Even modifying CSS variables, though a bit ugly to look at:

`:style="{ '--height': calculateHeight($el) }"`

is super powerful here, allowing our CSS to play a hand in how this works. Because `isOpen` is referenced inside of `calculateHeight()` petite-vue knows to call it when that property changes 🤯!

The last point is that we can reuse this `accordion` scope across multiple elements, they act as completely independent instances of petite-vue.

<hr>

### Micro-web-apps

I absolutely will cover more use-cases in the future, but I want to leave you with this one.

Not only does petite-vue fill the gap of website interaction for me, it's comfortable playing in web-app territory without completely taking over your build process. You can even scope your micro-web-app right into your site.

Here's a small deck of cards micro-web-app in petite-vue:

<p class="codepen" data-height="450" data-default-tab="result" data-slug-hash="QWgORQN" data-user="walpolea" style="height: 450px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/QWgORQN">
  Petite-vue Deck of Cards</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>

The app is comprised of two scopes, one for the outer shell of the app (`DeckOfCards`), setting up the deck and interface. The second is for each `Card` allowing me to easily componentize how it is built and rendered. It's incredibly powerful that you can compose multiple scopes together this way, allowing you to manage multiple parts of the app separately.

Certainly there would come a point at which it might make more sense to switch this into a larger framework, but the biggest point I want to illustrate is that through all of these demos, petite-vue allows you to stay as simple or go as complex as you need to, very much to akin to what we had with jQuery; it fills the gap. It's an amazing tool for sprinkling functionality into sites, or prototyping a larger app idea. I hope you'll give it a try!