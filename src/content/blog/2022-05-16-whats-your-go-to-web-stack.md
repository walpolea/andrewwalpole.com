---
tags: 
  - post
  - published
  - web
  - insights
title: What's Your Go-To Web Stack?
slug: whats-your-go-to-web-stack
summary: If you had to build a website right now, get started right away, what web technologies are you reaching for?
date: 2022-05-16
---


# What's Your Go-To Web Stack?

One of the best parts of my job is figuring out what technologies a client's website should be built in. *I love the challenge of it*; there are so many different external variables to consider and every client has its own set of opportunities and constraints to align a solution to.

Out of doing that work, I've made it a habit to present the following question to folks, not as any sort of test – though it's one of my favorite interview questions – but much more so as wanting to fill a genuine curiosity I have.

> What's your go-to web stack, right now?
 
### Here's the set-up:

I need you to build me a website right away (of course)! Content on the site will have to be updated at least once a week, but for the most part, the structure won't change much or at all. I'd love to post a few short, simple blog posts every now and then and I have a contact form I'd like people to reach me through. It's all designed up, sorry, a templated theme won't do.

So what do you do? How do you build this site? What technologies will comprise your stack and workflow? Maybe most importantly, if you aren't quite sure, what else do you need to know?

### My Go-To Web Stack

For the last year or so, [Eleventy](https://11ty.dev) is most likely what I would reach for, though I'm equally familiar with either [Vue](https://vuejs.org/) + [Vite](https://vitejs.dev/) or [Nuxt](https://nuxtjs.org/). I'm at a place where I can get up and building very quickly with Eleventy, and I love that it's so easy to reach for plugins to add on features, but also introspect those plugins and know quickly that there isn't too much magic going on behind the scenes. I've also gotten accustomed to adding on Vite or [esbuild](https://esbuild.github.io/) as well to bundle JavaScript and SASS.

The toughest part would be satisfying the need to regularly update content and post blogs. While Eleventy is great for developers out of the box, not so much for the less tech-inclined. And even though [previews are hard](/blog/previews-are-hard-also-web-mullets), I would likely reach for a headless CMS. I'm torn a bit here, I love [Contentful](https://contentful.com), I used it for years and think it provides a great experience. But the pricing tiers are rough, they're not positioned for small professional sites that may exceed the free tier. My other option would be [Prismic](https://prismic.io), which really does fit the bill. My only hesitancy there is that I've only played with it, and so I have trouble saying it's part of my go-to stack if I haven't gone-to it for real yet, but I do think I'm ready to reach for it.

As for hosting, probably [Cloudflare pages](https://pages.cloudflare.com/), actually, as it has been a great experience with this site and I really love having so many site administration tools at my disposal. Though, it's just as much of a toss-up to also choose [Netlify](https://netlify.com) or [Vercel](https://vercel.com). Netlify especially might win-out because of their easy [forms options](https://www.netlify.com/products/forms/), but I wouldn't be afraid to custom-roll a simple contact form with a serverless function either.

### tl;dr

I think it's fascinating to run through this exercise of figuring out what technologies you would actually pick to build a site right at this moment. It's a bit different from "what do you like?" or "what is ideal?" or "what's cool?" because it's much more about understanding where your current comfort zone in web development is, especially because [what you've done is what you'll do](/blog/what-youve-done-is-what-youll-do). Over time, your answer will likely change, so it's also fun to see what sticks and for how long.

For me, at this moment, it's:

- Eleventy
- SASS and vanilla JS + [petite-vue](https://github.com/vuejs/petite-vue)
- esbuild
- Prismic
- Cloudflare Pages