---
layout: blog_base.njk
tags: 
  - post
  - published
title: First
summary: "Hello World! This is my first post on amy new website and blog. Like and subscribe folks!"
date: 2022-04-30
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
---

{{page.date | readableDate}}
# {{title}}

Well, I did it; after two years and three scrapped site designs – and of course I'm not even that stoked on this one – the itch to blog has been growing, so here I've settled to make a go at it.

This site is built with eleventy, with a custom esbuild setup for the small bits of sass and javascript. It's hosted on Cloudflare Pages, which is a bit of a departure from my usual choice of vercel or netlify, but I've been really happy with Cloudflare workers, so I'm giving this a go as well!

### What can you expect from this blog?

Well, probably just a decent bit of web-related punditry and maybe a bit of leadership stuff... Really whatever strikes my fancy I guess. My goal is to publish a healthy mix of useful tech-specific things along with my own views on the way the web development industry is moving, with some sprinkling in of random things I like. If that's your jam, welcome, feel free to like *(over there &searr;)* and [subscribe](/feed.xml)!

More specifically these topics have a high chance of showing up:

- Web Development
- Dev Stacks/Architecture
- Serverless non-sense
- Leading dev teams
- Business strategy
- Robust-first computation via living-systems
- 3D printing tips and processes