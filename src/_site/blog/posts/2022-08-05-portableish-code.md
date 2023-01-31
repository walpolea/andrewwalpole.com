---
layout: blog_base.njk
tags: 
  - post
  - insights
title: Portable-ish Code
summary: Some words here
date: 2022-07-02
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
hide: true
featuredImage: "https://andrewwalpole.com/static/NAME.png"

---

{{page.date | readableDate}}
# {{title}}

There's a big emphasis put on reusable, drop-it-in-and-hit-go, portable code. And it's great! The amassed giant-shoulders we climb upon daily as web devs are constructed out of this pattern. It is so normalized, it's a concept that is more awkward to *not* think about, but that's what I want to do here.

Especially in front-of-the-front-end development, the landscape of work can take on one of two big dualities:

> Build it for reuse or build it bespoke.

But from my experience I don't see much of the in-between being a part of the process.

Working at an agency where 99% the code I write is in execution of a custom, ground-up website build, that in-between has become a useful place to store and reach for solutions. Most notably, codepen is what I would describe as an excellent portable-ish code repository.