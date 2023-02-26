---

title: Secretrad.com
slug: secretrad
summary: An interactive map of secret San Diego establishments
featuredImage: "https://andrewwalpole.com/static/work/secretrad.jpg"
tags:
  - published
  - Front-end Dev
tech:
  - Vite
  - Petite-vue
  - HTML
  - CSS
  - JavaScript
  - Airtable
  - Vercel
---

# Secretrad.com

<a href="https://secretrad.com" target="_blank" rel="noreferrer noopener">View Site</a>

## Overview

Building this interactive site was an exercise in agility. With two weeks to design and launch, I led the development charge on this project. I leaned heavily on petite-vue to manage the interaction of the page, from map moving to loading and populating menus and content areas. The content was hosted and pulled from Airtable using their API. To minimize API calls, the content loading was proxied via Vercel serverless functions and cached for an hour at a time.

<img src="/static/work/secretrad.jpg">

## Challenges

Aside from the limited time to build, there were some fun technical challenges.

- Getting the map interactions feeling good, especially across desktop and mobile experiences, was very tough. Lots of rectangle math, position-based animations and dialing easing values to get it just right.
- Individually loading the gif overlays also presented an interesting challenge. Positioning had to be calculated via percentages to account for scaling. To make that easy, I built a debug mode into the page that would allow me to drag overlays around and report out the percentage positioning. Since final art was not delivered until the end, this was vital in not wasting time.
- Finally, because multiple overlays on the map were tightly packed together, I had to devise a custom link masking system that was also responsive. By default, CSS can mask out elements using a custom path, but the formatting of that path is not responsive. So I had to create some JavaScript that would reprocess the path size based on the map size. This allowed for scalable masks for the overlay buttons.

<iframe height="600" style="width: 100%; resize:both;" scrolling="no" title="custom clip-path hit-area over image - with scaling" src="https://codepen.io/walpolea/embed/OJgyMjJ?default-tab=result" frameborder="no" loading="lazy" allowtransparency="true" allowfullscreen="true">
  See the Pen <a href="https://codepen.io/walpolea/pen/OJgyMjJ">
  custom clip-path hit-area over image - with scaling</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.
</iframe>


## Tech Stack

- Vite
- Petite-vue
- HTML
- CSS
- JavaScript
- Airtable
- Vercel