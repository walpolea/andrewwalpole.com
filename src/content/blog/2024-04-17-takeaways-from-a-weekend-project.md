---
tags: 
  - post
  - published
  - web
  - insights
title: Takeaways from a Weekend Project
slug: takeaways-from-a-weekend-project
summary: A few musings and insights from a short bit of work conducted over the weekend.
date: 2024-04-17 12:00:00
---


# Takeaways from a Weekend Project

This weekend I built a simple web app to configure and generate a layout breakouts CSS pattern: [Layout Breakouts Builder](https://layout-breakouts-builder.vercel.app/). Over a few coding sessions, all together, it maybe took ~4 hours of work.

This post isn't so much about the Layout Breakouts pattern, though I do think it's quite useful! Instead, I'd like to quickly reflect on doing projects like this.

So here are my takeaways:


## Starting is hard and easy

The idea of starting a project like this seems hard.

I've been wanting to build this thing for months but just couldn't overcome the idea that it would be too hard to get started. 

The act of starting was actually quite easy:

> Identify first step. Do first step.

In this case, I sat down and said, "ok, what's one thing this thing needs to do?" The answer was that it needed to output some formatted CSS code based on some variable values. So that's where I started. I built a function that took in some parameters and returned formatted text. I stuffed that text into a `<pre>` tag, and from there I was off to the races on the whole thing.


## Having a go-to web stack is useful

As a web developer, having a quick [go-to web stack](/blog/whats-your-go-to-web-stack-2024-edition/) to build projects like this is essential. So many times I've had project ideas of grandeur, only to get stalled immediately in the technical architecture because I didn't have the right tools on-hand to get started.

But not this time. My muscle memory for Astro + Vue hosted on github + vercel has become strong enough that these things faded away into the background.


## Vueuse useClipboard is great!

One of the daunting flourishes for this app was to add a "copy code" button. I've done this before, actually quite a bit, but it always leaves me feeling drained because the easy way is touted as deprecated, and the harder way has support quirks, and when you try to land on a way forward you're 12 stack-overflow questions in just wishing for a `copy( text )` function.

Well [`@vueuse/core useClipboard`](https://vueuse.org/core/useClipboard/) to the rescue! I've been using the library quite a bit, and it has a ton of useful Vue composables. But given the haunting scenario I just listed above looming over me, it was an extra *chef's kiss* moment for me.

The code looked something like this:

```js
import { useClipboard } from '@vueuse/core';
const { copy } = useClipboard();
```

and then later on my copy button:

```vue
<button @click="copy( lb.generateCSS() )">Copy CSS</button>
```
<br>

## Constructable Stylesheets are cool!

Credit given where credit is due: This project happened thanks to the crew over at the [Shop Talk Show d-d-d-discord](https://www.patreon.com/shoptalkshow). Someone talked about building a similar code-generating tool, and someone else mentioned using [Constructable Stylesheets](https://web.dev/articles/constructable-stylesheets) to make it easy and performant. Well that was it for me, I had to try it.

**Spoiler alert**: it *was easy* and *is performant*! I was able to instantiate a new `CSSStyleSheet` and apply it to the page, and then use the `replaceSync( codeAsText )` function to update the styles as the editor generated them. Worked like a charm!

The code looked something like this:

```js
const sheet = new CSSStyleSheet();
document.adoptedStyleSheets = [sheet];

watch( lb, () => {
  sheet.replaceSync( `${lb.value.generateCSS()}` );
});
```
<br>

## Do this (more) often

Lastly, a reminder to myself and suggestion to you all: *Do this more often*. Make stuff you're passionate about. The process and the result are rewarding in so many ways.