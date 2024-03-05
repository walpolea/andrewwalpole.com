---
tags: 
  - post
  - published
  - web
  - insights
title: What's Your Go-To Web Stack? (2024 Edition)
slug: whats-your-go-to-web-stack-2024-edition
summary: If you had to build a website right now, get started right away, what web technologies are you reaching for in 2024?
date: 2024-03-05 12:00:00
---


# What's Your Go-To Web Stack? (2024 Edition)

In 2022 I wrote the first, [What's Your Go-To Web Stack?](/blog/whats-your-go-to-web-stack) post. Now I'm back a few years later to reflect on any changes to my own answer and to challenge you once again to answer the question as well. Minimally it's an amusing exercise, but I think done over time it's an interesting introspection take a quick snapshot and compare it to those of the past.

> What's your go-to web stack, right now?
 
### Here's the set-up:

I need you to build me a website right away (of course)! Content on the site will have to be updated at least once a week, but for the most part, the structure won't change much or at all. I'd love to post a few short, simple blog posts every now and then and I have a contact form I'd like people to reach me through. It's all designed up, sorry, a templated theme won't do.

So what do you do? How do you build this site? What technologies will comprise your stack and workflow? Maybe most importantly, if you aren't quite sure, what else do you need to know?

### My Go-To Web Stack

At this very moment, it's a really easy answer for me. [**Astro**](https://astro.build) has won me over in the last few years. It's a joy to use, both in bringing me back personally to the simple focus of building websites (and not building projects that turn into websites), and also in seeing the successful role it can play in building custom production sites for clients competitively. It keeps you close to the front end, while providing the luxuries of any modern build-step framework.

The static-first nature provides excellent performance, but SSR being just a toggle away gives me the flexibility and confidence to build any sort of site or even app that might get thrown at me.

On top of Astro, its ability to nearly seamlessly integrate interactivity via [Vue](https://vuejs.org/) yields clean and performant *interactive and functional* sites. I've also become a steady user of [`vueuse`](https://vueuse.org) and its large library of functionality-I-always-reinvent-but-dont-need-to-now-because-of-vueuse.

In the CSS realm, while nesting has now arrived, I just can't quite bring myself to quit some of the niceties, or maybe just having the possibility of niceties, of `SCSS` yet. Though I've fully forsaken SCSS variables in favor of custom properties. I'll also give a shoutout to [Ryan Mulligan's Layout Breakouts](https://ryanmulligan.dev/blog/layout-breakouts/) concepts which has been doing good work for my work lately.

For the dynamic content component for this project, it's tough to argue from the built-in content collections feature of Astro; if I were building the site for myself it's an easy choice. But let's say we need some sort of simpler online UI to publish content from. I would probably reach for [Contentful](https://www.contentful.com/) or [Prismic](https://prismic.io/). Both systems are robust and capable, and each offers a more than decent free tier. This used to not be the case for Contentful, but I'm now quite happy that they've remodeled their offering to something that a lot of folks can jump into for small projects. Coming in third actually might be [AirTable](https://airtable.com) which I've picked up over the last few years for some projects and it's quite good for small projects.

For the form, I think my serverless game has grown to the level that I would likely just roll it myself over attempting to pay, integrate and style a 3rd-party service. Let's just parse out that data and send it on over to our CMS or maybe even right to email.

As for hosting, I think my conviction for one host over another has waned a bit. I am still mostly positive about the offerings and capabilities of [Cloudflare](https://www.cloudflare.com/) and [Vercel](https://vercel.com/) and would likely choose one of those, but I'm less stoked about their in-flux reputations. For sure Netlify has just gone and fallen off my radar, are they even still around? Maybe a new old player is AWS Amplify, which just launched SSR support after being static-only for so many years; but it's a bit early to tell how that will play out. Lastly, while I haven't done much with them, I keep a longing gaze turned toward [Deno Deploy](https://deno.com/deploy). All the things Deno is doing are cool and good, and I want to support that.

### tl;dr

Once again this exercise was a lot of fun to reflect on. Many of my answers changed. A few years ago I was slinging [Eleventy](https://www.11ty.dev/) and [Nuxt](https://nuxt.com/) sites like nobody's business, and while I am still fond of what they can do, the layered-on happy-defaults simplicity of Astro quickly won me over. In that time I've also switched jobs, but I think it's interesting how that transition only supported the continued trajectory I was on with the web and did not cause any major disruption to it.

For me, at this moment, my go-to web stack is:

- Astro
- Vue + vueuse
- SCSS
- Contentful / Custom Serverless Forms
- Vercel