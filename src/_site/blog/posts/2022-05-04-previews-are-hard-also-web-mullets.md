---
layout: blog_base.njk
tags: 
  - post
  - published
  - web
  - jamstack
title: Previews Are Hard! Also, Web Mullets
summary: "A quick take on one of Jamstack's biggest hurdles it has yet to fully overcome: previewing content."
date: 2022-05-04
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
featuredImage: "https://andrewwalpole.com/static/spiderman-points-for-previews.jpg"
---

{{page.date | readableDate}}
# {{title}}

I love the Jamstack revolution that has been going on for the last few years. Statics sites, yes please! SSR, yes please! Headless CMS, let's freaking go! Netlify, Vercel, AWS Amplify, Cloudflare pages, tears, folks, tears. of. joy. But this soup of delicious tech, like all the others, has its souring points. The one I'm most particularly interested in calling out here is content previewing.

Living that agency life, most of the time we're just building websites for less technical folks to manage. Sure we're going to give them a great-looking, fast, functional website, but they also need to change that content, swap those images and relabel all the CTAs. Unfortunately, my findings are: *Jamstack stacks have poor implementations of preview workflows*, and in many cases, implement them as afterthoughts, if at all.

## The Problem

<img class="half" src="/static/spiderman-points-for-previews.jpg" alt="Three-way spiderman pointing meme with Headless CMS and Framework pointing at each other and Host pointing at both of them">

The problem seems to be in the decoupled nature of the parts. It's **nice** that Jamstack makes it easy to pick and choose your CMS and your framework and your host almost fully independent of each other. The problem is that it likely takes at least two of those to work together non-trivially to achieve good previews. And, well, shoot. Now your stack is coupled, you're bought-in, on the hook, you've become... *opinionated*.

> Opinions get things done, but they absolutely subdivide your target audience.

It's not the worst thing for you, lovely developer-reader-friend, but it seems like very few of these stack-players are actually willing to get opinionated themselves and work together to create that great previewing experience. Instead, they try to go after universalized solutions, which lead to so much hoop-jumping for us. I will call out [Prismic](https://prismic.io) though; I think they really gave it a go, but even their framework-specific preview SDKs have spun my head around a bit; they haven't quite cracked it.

## The Solution We Desperately Need

Wordpress... sorta! The block editor, that thing freaking rules, except, well it runs on React and I like Vue. But that aside, clients *love* building pages with blocks and editing content in blocks. Even ACF blocks, which I use most, are a great experience: Content inputs on the right, instant previews on the left. But this all falls apart when you want to use Wordpress in a Jamstacky way. Your block content is just walled-off enough from the Wordpress API that I can't easily just query data into my component and instantly render it to you as a preview.

Chris Coyier tweeted it perfectly just a few weeks ago:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">Sure, I could do WordPress-as-content-API-only thing, but ughgk, I don&#39;t love it. It&#39;s twice the technical debt and doesn&#39;t really provide a best-of-both-worlds thing. <br><br>I just want a single product that is WordPress in the back and Astro in the front. <br><br>Ship it people.</p>&mdash; Chris Coyier (@chriscoyier) <a href="https://twitter.com/chriscoyier/status/1513593685925056514?ref_src=twsrc%5Etfw">April 11, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

Wordpress in the back and Astro in the front – seamless previews transitioning into beautiful static builds.

> A metaphorical web mullet to stun the masses, if you will.

This is what we need.

### P.S. 👀

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">okay :)</p>&mdash; fred (@FredKSchott) <a href="https://twitter.com/FredKSchott/status/1513593963457880066?ref_src=twsrc%5Etfw">April 11, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

Save us Fred!