---
tags:
  - post
  - published
  - insights
  - web
  - front-end
  - design
title: Three Design Smells Only Developers Can Sense
slug: three-design-smells-only-developers-can-sense
summary: In development, we have "code smells." Extending the metaphor, here are some design smells that devs can pick up on as well.
date: 2023-03-01 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/three-design-smells-only-developers-can-sense.mp3"
---

# Three Design Smells Only Developers Can Sense

## Using the font-size hack

Ever seen or done this?

```css
html { font-size: 62.5%; }
body { font-size: 1.6rem; }
```

It's the classic font-size hack, where instead of the default `1rem = 16px`, the equation is forced to `1rem = 10px` allowing for easier math and translation from `px` to `rem` font-sizes.

There is some debate and confusion over whether this is bad to do. Technically no: it doesn't negatively affect the user experience. Fonts can still scale with zoom.

As a deviation from web defaults though, it's arguably unnecessarily added system complexity that impacts DX over UX, which is not a super strong position to be taking.

But what's the underlying issue? Well, I think it's rooted in font sizes traditionally starting in pixels on the design side.

And so, I propose that it's a *Design Smell*, a metaphorical extension of *Code Smell* where code is a symptom of another development decision. In this case, that "other decision" is landing back a few steps in the design phase.

Teaching web designers how preferred web font size definitions work, especially as tools like Figma adopt them, would be a great way to tackle this issue at its root.

What other Design Smells might there be?

## Unoptimized media

How media is handed over for development can be fraught with odor. Dev tools and lighthouse tests can easily point out that large non-web-optimized media is present. But beyond that, things like using a `jpg` or `png` over an `svg` just because there's a gradient background offers the chance to coach back into design-land that CSS is great at gradients and there's a better solution to improve both performance and quality of that design element.


## Responsive gotchas

Another category of design smells exist around responsive design. While there are many specific instances to call out:

- Navigations not accounting for more or fewer items.
- Grids of cards designed with the same `lorem ipsum` content across all of them.
- Heights of mobile components perfectly fit into a single viewport size.
- Ambiguous resizing guidance in extra large viewports.

All of these come down to not exploring the edge cases of responsive circumstances, especially those that throw in the *wrench of real content*.

I have to say, that if these make it unscathed into development, you'll be holding your nose all the way through. Ambiguous responsive design is especially important to tackle before development starts, which is why design and development collaboration is so important.

## Follow your nose

I think *Design Smell* can be a useful term, especially in bridging the developer-designer relationship. As the capabilities of the web, especially CSS, grow, it's imperative to maintain an open, two-way avenue for knowledge transfer. Just as front-end developers can learn to exercise design skills to fill in gaps and not get tripped up, web designers too will yield better UX design because of knowing how the web works.

