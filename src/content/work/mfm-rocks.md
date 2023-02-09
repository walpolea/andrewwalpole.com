---

title: MFM.rocks
slug: mfm-rocks
summary: A personal project exploring robust-first computation, built in TypeScript.
tags:
  - published
  - Frameworks
tech:
  - TypeScript
  - pixi.js
  - Vue 3
  - HTML
  - CSS
  - JavaScript
---

# MFM.rocks

<a href="https://mfm.rocks" target="_blank" rel="noreferrer noopener">View Project</a>

<a href="https://github.com/walpolea/mfm-js" target="_blank" rel="noreferrer noopener">View Repo</a>


## Overview

MFM.rocks is a passion project of mine started back in 2018. The site showcases an underlying robust-first computational model called the Movable Feast Machine, designed by Dr. Dave Ackley. I have rebuilt the conceptual model, first in JavaScript and then migrated over into TypeScript. While the underlying MFM library is all done in TypeScript, it compiles down to ES6 and can be implemented client-side. In this case, pixi.js and Vue bring the main interface to life while running the MFM library under the hood.

<blockquote class="twitter-tweet"><p lang="en" dir="ltr"><a href="https://t.co/FHo9ezMzST">https://t.co/FHo9ezMzST</a> is starting to grow quite a diverse petri dish of living-systems experiments. Most notably here are Mosquito, Fly, Bird, Looper, Wonky Looper and the newest addition OfSwamp, which consists of Swamp, Swamplings and Swamp Workers. <a href="https://t.co/bDnXNM8Ee7">pic.twitter.com/bDnXNM8Ee7</a></p>&mdash; Andrew Walpole (@walpolea) <a href="https://twitter.com/walpolea/status/1501351405080088576?ref_src=twsrc%5Etfw">March 9, 2022</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

## Challenges

The main challenge has been squeezing performance out of the project. Since the computational model relies on random execution, many tricks for rendering optimization go out the window. But with the use of [pixi.js](https://pixijs.com/) and some computational caching, I have ben able to optimize the performance down many times over the duration of the project.

Beyond performance, the way elements are built and composed really pushed me to learn some advanced OOP concepts within TypeScript. I relied heavily on various factory patterns to enable elements to modify sites on the grid.

## Tech Stack

- TypeScript
- pixi.js
- Vue