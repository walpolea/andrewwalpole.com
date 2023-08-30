---
tags:
  - post
  - published
  - front-end
  - web
title: CSS Grid Systems with CSS Grid
slug: css-grid-is-too-good
summary: Let's talk about why there aren't any.
date: 2023-08-30 12:00:00
# blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/remote-leadership-takes-a-concerted-effort.mp3"
---

# CSS Grid Systems with CSS Grid

It's funny. If you google around for a modern CSS Grid framework that uses CSS Grid, you won't find much. You will see very few new frameworks at all, but you will find many that have thrived over the last decade or more, a lot of which are bundled together with larger component libraries or web scaffolding systems.

Most of those frameworks use a traditional `n-columns` (usually defaulting to 12) grid layout system made popular by Bootstrap or Foundation. And for good reason: these patterns were web development staples for a long time. Even with the advent of Flexbox and it not being a 1-to-1 replacement of those, these grid systems required a hefty layer of CSS on top to make them go `brrrrrr`.

## Enter CSS Grid

But then in 2017, all the major modern browsers (excluding IE) got support for CSS Grid. I remember it coming out of the gate with a pretty big bang, especially with [Jen Simmons](https://front-end.social/@jensimmons) and Mozilla pouring time and resources into evangelizing Grid's capabilities and Firefox's novel and superior devtools support of it.

The early Grid days were good; buzz about it lingered, and it seemed like a lot of folks adopted it. But eventually, like all new shiny features, Grid became just another thing to reach for.

It's at this point that I will fast-forward to six years later of hindsight to look back on: *A lot of folks missed CSS Grid!* I've talked with dozens of devs over the last few years who don't reach for it at all or don't even know it is something to be reached for.

And I get it. Similarly, I missed Flexbox, having shirked a lot of front-end learning in place of doing Flash and Actionscript during that time. It wasn't until only a few years ago that I really started building up my muscle memory for Flexbox.

So now it makes sense why these older style grid frameworks are still thriving. People learned the API, they work well; the patterns are comfortable and well-established.

## Exit CSS Grid

But here's my big insight: **People missed CSS Grid a little extra because it's so good and capable on its own, you don't need to build a framework around it.**

And so all that hot new software that we saw with wrapping Flexbox or float layouts over many years; all that hype and buzz the communities would be full of at regular intervals wasn't there for Grid. Only now that browsers are finally rallying to get us subgrid is there a little resurgence in buzz.

## Grid Doesn't need a Framework

So here's my buzz, and my testimony as a CSS Grid addict: *Grid makes building for the web very unscary, or dare I say, easy.* I reach for it daily. And I've even [tried to build a framework around it](https://codepen.io/walpolea/pen/ExOKZVZ?editors=0100). But you don't really need it. Its syntax is lightweight and immensely capable on its own, for both simple straight-forward web development up through highly componentized modular systems.

I encourage anyone who has not given it a decent go to put in the time to make it a tool in your tool belt.