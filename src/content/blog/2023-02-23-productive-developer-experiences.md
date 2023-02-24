---
tags: 
  - post
  - published
  - insights
title: Productive Developer Experiences
slug: productive-developer-experiences
summary: Developer experience has ramped up in focus over the last few years as a way to increase platform adoption and developer productivity. Here are the features I think make for a good DX.
date: 2023-02-24 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/productive-developer-experiences.mp3"
---

# Productive Developer Experiences

Early in my career, I remember watching the software and web industry shift from being functionally-focused to user-focused. It was a main driving reason why I decided to switch from a software engineering degree to one that incorporated web development and UX design. Today, functionality is often the baseline, and competitive advantage is pursued through the user experience lens.

There has been another shift in the last few years, though not as overtaking; more complementary. Developer Experience, or DX, is growing as yet another focus point for software to consider as a primary driver of adoption and platform longevity.

Here are my top features that I think drive productive developer experiences:

### A well-groomed happy-path

The experience to get up and running with anything is a make-or-break moment for new users. Too difficult and we'll "nope!" right out of there. Lesser-considered though, too magical or left unexplained, and the smarter users might also begin to build a case for being skeptical. Your happy path should be well-groomed, like an upkept hiking trail. It should have bridges in the rough spots and not wind to and fro too much.

What makes a good happy path?

- No walls or fences. Providing [escape hatches](/blog/escape-hatches) and even calling out where someone might want to deviate from the path later is key.
- If your tech is really flexible, divide it up by use-cases. It's more paths to maintain, but worth it in the end that you aren't actually curating a hedge maze.
- Call out the scenery. Don't just tell us how to do something; why does it work this way? What are some gotchas or limitations worth knowing about?
- Make all of the bells and whistles opt-in. Show me the base experience and the points at which common functionality can be plugged in, but don't overwhelm me with a "luxury experience" because it quickly leads to cognitive overload.

### Docs are the map to your product landscape

Your docs need to be great. They need to be updated thoroughly as your product changes and should be split at minimum into three categories: use-cases, features and reference. Your use-cases show me how someone might use your entire product to accomplish a common use-case. Your features need to deep-dive into each special ability your tech has, and all the ways it can be configured and used. And your reference needs to give me an even closer, raw look at the exposed consumer API. What are the expected inputs and outputs of any given thing I'm working with?

### Features as baby steps

I mentioned making optional features as opt-in as possible. Going hand-in-hand with that, features should feel like small steps. Being overwhelmed by the effort of enabling or configuring a feature is one of the biggest reasons developer tech can be abandoned. Small, easy steps lessen that load. I shouldn't have to do 15 steps to accomplish something, and even worse, if I get intimidated or change my mind on step 7, things shouldn't be in a broken state.

### Useful error messages

If you've focused on the prior two points you're probably in a good place. But the cherry on top is having great error messages. Letting me know at build or runtime what might be wrong will keep me in the development flow as much as possible. Don't make me hunt for bugs that are rooted in your own proprietary conventions.

### Good names make for good mental models

Finally, zooming out a bit, I think it's important to track the mental model that your DX paints in developers' minds. One key factor in how that model takes shape is in naming features and conventions in your product. Names will elicit specific contextual connections, and so your product gains to get a leg-up on explaining features by leveraging common developer contexts. Bad names on the other hand do quite the opposite; potentially introducing confusion via mismatched contexts.

## DX will grow

These are just a few stand-out features I find in a good developer experience. But specific focus on DX is fairly new, which will cause the baseline bar to be raised more and more as new techniques emerge. If you're building a product or service that developers use, it is critical that you adopt and invest in the DX focus.

