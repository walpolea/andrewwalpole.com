---

title: Velsera.com
slug: velsera
summary: A static landing page for a new brand built with Astro and gsap.
featuredImage: "https://andrewwalpole.com/static/work/velsera.webp"
tags:
  - published
  - Front-end Dev
tech:
  - Astro
  - Vercel
  - GSAP
  - HTML
  - CSS
  - JavaScript
---

# Velsera.com

<a href="https://velsera.com" target="_blank" rel="noreferrer noopener">View Site</a>

## Overview

Though small, this landing page packs a punch, with video and multiple interactive and animated components. My team and I brought this brand to life using GSAP ScrollSmoother, Splide.js for carousels, and vanilla JavaScript and CSS for the rest of the page. Forms were integrated via Hubspot.

This was my first client site built in Astro. Even with a new framework, the site came together in under 3 weeks and was a joy to build thanks to the `.astro` syntax.

<img src="/static/work/velsera.webp">

## Challenges

Just a few challenges worth noting here, mainly front-end focused:

- Given the tight timeline, putting together a custom video player seemed daunting. [Mux media-chrome](https://github.com/muxinc/media-chrome) to the rescue. It was an easy add-on to get up and running with a fully stylable video player.
- The animated glowing background gradients took a few iterations to optimize for performance. Turns out animating gradients is a great way to burn up your CPU. Thankfully switching to CSS transforms cleared up the issues.
- Not so much a challenge, but happy to report that the contact dialog is using `<dialog>`; a quick and easy setup.

## Tech Stack

- HTML, SCSS & JavaScript
- Astro
- GSAP
- Splide.js
- Mux media-chrome
- petite-vue
- Hubspot
- Vercel