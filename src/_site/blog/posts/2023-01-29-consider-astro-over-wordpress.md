---
layout: blog_base.njk
tags: 
  - post
  - insights
  - web architecture
  - web
  - jamstack
  - front-end
  - back-end
  - published
title: Consider Astro over Wordpress for your Brand's Website
summary: Are you a company looking to build a new website? As someone who built company websites for many years, I think you should consider not going with another Wordpress site.
date: 2023-01-29
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
featuredImage: "https://andrewwalpole.com/static/consider-astro-over-wordpress-for-your-brands-website.png"

---

{{page.date | readableDate}}
# {{title}}

I've spent the last handful of years building lots of websites for company brands big and small. As the lead architect and stack decision-maker for those projects, I've come to one major conclusion: `Wordpress is great if you get it right, but if you get it right, it's quite expensive.`

## How is Wordpress so expensive?

You might be thinking, "But Wordpress is free!"

Sure, the software and often some of the most critical plugins and themes are free or even quite affordable. If you're content is your main focus for your new site, go ahead and grab a nice theme and have fun. I'm specifically talking about you, dear future-someone's-client, about your future-new custom website that showcases your brand and products/services, setting your business apart form your competition.

Wordpress ends up being expensive in three ways:

- **Development**: Getting it right means building a robust, highly-composable set of componentry to fit your brand. This can be a large up-front investment into the development of your site that will help fight against [Digital Entropy](https://andrewwalpole.com/blog/digital-entropy/).

- **Maintenance**: Someone needs to learn and know how to keep your site humming, both on the technical back-end and on the content-focused front-end.

- **Platform Dependence**: Wordpress is a great CMS, but some of the shortcuts that make things easy sacrifice separation of concerns. And so while content is manageable it is often tightly coupled to context, and thus as your site's content grows so does your dependence on Wordpress and your specific theme. You will invest more in evolving it and keeping it going rather than having the option to clearly pivot as your business might demand.

## Astro is a great Wordpress alternative

There are lots of alternative technologies to build your website in these days. Some are entire platforms that offer as much as Wordpress might, often with the same issues listed above. Some are more rigid, trading in customizability for simplicity. And some are a bit more barebones, where it takes a much more technical hand to pieces together functionalities to cover all the facets of building and managing a website.

I'm here to recommend [Astro](https://astro.build). Astro lets you build static or server-rendered websites. It's specifically built to handle major front-end frameworks developers like to build sites in and provides a developer experience that keeps dev focused on building the site itself and not just the inter-workings of it.

There are four main reasons I think Astro is worth a long look:

- You can get a custom site built, and while it may not be cheaper, front-end development can be done very efficiently and most of that cost will go into bringing the site to life and not the underlying stack.

- Coupling Astro with a headless CMS is really easy, but also not required. This could let you take things in phases, starting without a CMS and then quickly integrating one as content is needed to be managed quickly. This also solves the separation of concerns issue mentioned above. A headless CMS provides a clear opportunity to build your content in a way that is reusable even as your business needs require you to make drastic changes to your website.

- Continuing off of the last point, Astro's ability to adapt to many popular web frameworks also puts you in a prime position to grow into a Design System of componentry. Even building new websites, or adjacent campaign sites with the same underlying Astro stack would be easy to do.

- Fighting digital entropy is, in most cases, not worth it. Instead, *embrace it*. Websites are more effective as they closely align to your business. But business evolves, knocking that synchronicity out of step. To remain highly effective, redoing some or all of your website every few years is a normal thing these days, and Astro makes that easy.

- Lastly, what sets Astro apart from all the other Wordpress alternatives? For me, it's their server-rendering and hybrid-rendering offering. Astro is the best of static site generation: fast, performant sites *and* the best of server-rendered sites: dynamic, realtime content and functionality. They've cracked a long-avoided nut that opens up a huge amount of potential for building great sites.

## Wordpress is still a contender, but keep an open mind

If you have the budget and the need to manage a site very deeply and often with non-technical folks, I think Wordpress is really hard to look away from. The block editor and the experience you can have in building and maintaining sites with the right componentry is great.

But if those things aren't all true, I encourage you to take a look at Astro. Even as young of a framework that it is, it has the capabilities you need to build a beautiful, functional and scalable site.