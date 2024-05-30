---

title: Layout Breakouts Builder
slug: layout-breakouts-builder
summary: An interactive builder tool that streamlines setting up the popular Layout Breakouts CSS layout pattern.
tags:
  - published
  - CSS
tech:
  - Astro
  - Vue 3
  - HTML
  - CSS
  - JavaScript
  - Constructible Stylesheets
---

# Layout Breakouts Builder

<a href="https://layout-breakouts.andrewwalpole.dev/" target="_blank" rel="noreferrer noopener">View Project</a>

<a href="https://github.com/walpolea/layout-breakouts-builder" target="_blank" rel="noreferrer noopener">View Repo</a>


## Overview

This is an interactive builder tool that streamlines the ability to generate CSS for the Layout Breakouts pattern made popular by Ryan Mulligan and Kevin Powell. The pattern itself is non-trivial to manually compose, and tough to customize once you write it. This tool makes it easy to set up a custom page layout for your project that adheres to the layout breakouts pattern by plugging in your track names and sizes, as well as letting you add and remove multiple tracks to suit your needs.

The project is built in Astro and uses Vue for the main interactive builder component. One of the surprising and easy parts of the project was using Constructible Stylesheets in JavaScript to generate the CSS and apply it to the page in real-time; it all [worked like a charm](https://github.com/walpolea/layout-breakouts-builder/blob/main/src/components/LBEditor.vue#L130).

## Challenges

This project came together very quickly, though it had been on my mind for a while. I [wrote about developing it as a weekend project](/blog/takeaways-from-a-weekend-project/) and the main challenge I explain there is that I let it sit in my head for too long instead of just trying to get started. It was a great reminder that sometimes unlocking great and exciting work is just a small prototyping session away.

## Tech Stack

- Astro
- Vue 3
- Constructible Stylesheets