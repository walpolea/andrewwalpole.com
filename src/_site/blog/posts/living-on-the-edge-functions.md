---
layout: blog_base.njk
tags: 
  - published
  - post
  - backend
  - serverless
title: Living on the Edge Functions
date: Created
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
customHeader: 
---

{{page.date | readableDate}}
# {{title}}

Edge Functions are all a buzz at the moment. [Netlify just got them](https://www.netlify.com/blog/announcing-serverless-compute-with-edge-functions/), they're [in beta over at Vercel](https://vercel.com/docs/concepts/functions/edge-functions), and [Cloudflare has had them](https://developers.cloudflare.com/workers/) for a few years under the somewhat misleading name, Cloudflare Workers.

It's easy to confuse them with serverless functions, and in my mind, I think they are a type of serverless function. The main difference is in the name; edge functions run as close to the requestor as they can (on a distributed edge server), while serverless functions are deployed to a specific region where they run regardless of the initiator's origin.

Beyond that universal difference, the specific organizations offering edge functions may implement different runtimes and add a proprietary layer on top of their usage that is less consistent. Or said another way, edge functions and serverless functions could likely work exactly the same, but in an effort to provide a differentiated offering, edge functions end up being optimized for specific edge-efficient use-cases. Generally, that use-case is: Intercept a client request and `DO STUFF` before returning a response; where `DO STUFF` is a whole heaping world of possibilities.

Let's take a quick look at what Netlify, Vercel and Cloudflare offer, as well as some of the great use-cases you can explore with edge functions.

### Netlify

Netlify's edge function solution comes in one surprising flavor – Deno runtime! As a sideline-cheerleader for Deno, I was pleasantly surprised to see that Netlify went this direction. While Deno could be a whole post on its own, don't be scared off; you can write JavaScript and TypeScript in Deno, plus get access to a very cool import system, which in comparison to npm, makes bringing in external resources a breeze.

No surprise, Netlify provides a pretty great DX for edge functions. You describe the routes that should run edge functions in your `netlify.toml` and declare the functions themselves in an `edge-functions` directory at the top level of your project. Netlify handles the rest within its continuous deployment pipeline.

Finally, it's worth noting that Netlify really leans into the pitch that even if you aren't directly using them, your favorite frameworks – Next.js, Nuxt.js, Eleventy, Astro, SvelteKit, Remix – can or are taking advantage of them for you by providing middleware that use edge functions to SSR content for clients blazingly fast.

### Vercel

Unfortunately, at the moment there isn't too much to report here. Edge functions are in beta on Vercel and are only implemented for Next.js projects. However, as a fan and an avid user of Vercel serverless functions, I expect that as they do come up to speed with their competition, it will be a solid offering.

### Cloudflare Workers

One nice thing (among many) about Cloudflare, is that even if you're hosting through another platform, as a DNS manager, you can use Cloudflare in conjunction with whatever your current setup is. So in most cases, unless you are deeply tied into another DNS management system, you can add this on to any site with minimal disruption. Once you have your domain using Coudflare you're ready to use their ~~edge functions~~, err, I mean Cloudflare workers.

Using Cloudflare workers is not bad, it's also not a one-click deploy, but I think that's just fine. You create workers on your account and you can either set up their Wrangler CLI tool to write and deploy workers, or you can use an online editor, which I have found to be a really great starting path, providing you a decent-enough editor along with side-by-side testing and debugging tools.

## Edge Function Use-Cases

So what do you do with edge functions? Probably too many things to list, but we'll try anyway, which should help to also solidify the concept of them.

Remember, edge functions run after the client/user makes a request (that you have defined to intercept). The function has some sort of payload with the request information as well as what the response will be. Within the function is where the magic happens, you could do things like:

- Check the request parameters, query a database, and apply the data into the response.
- Check the country the request came from (both Netlify and Cloudflare provide GeoIP services) and return a redirection to a specific URL.
- Increment a counter in a database (or better yet, Cloudflare KV which is a whole blog post in itself) to track page visits.
- Add/modify a header value (great for Auth things).
- Read/Write/Manage cookies.
- Completely compile, render and return a page or component with injected data/content.
- Add some html or a js script into the page.
- Response with some JSON like an API endpoint.
- Enforce a block or allow-list.
- Respond with an a/b test of content.
- Respond with an image or other types of content.

You can see a bunch of these and more in action with Cloudflare workers [here](https://developers.cloudflare.com/workers/examples/).

### tl;dr

Edge functions are serverless functions, but since they're on the edge, you may want to use them for specific scenarios that make sense on the edge, like modifying the response of a request by some smallish amount before sending it back. They are playing a big role in allowing frameworks to do high-speed SSR and if you haven't tried them out yet, or haven't even stepped into the world of serverless, Netlify and Cloudflare have made getting started really easy.