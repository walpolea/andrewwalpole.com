---

title: U River Cruises Redesign
slug: u-river-cruises
summary: A client redesign and interesting take on a bespoke design system build.
tags:
  - published
  - Front-end Dev
  - Design Systems
tech:
  - Nunjucks
  - Gulp
  - HTML
  - CSS
  - JavaScript
  - MapBox
  - GSAP
---

# U River Cruises Redesign

<a href="https://urc.andrewwalpole.dev/" target="_blank" rel="noreferrer noopener">View the Design System and Demo Site</a>

## Overview

This client project was a lot of fun, for some interesting reasons. From a high level the job was to build a new website for U River Cruises, but underneath the technical needs were much more challenging. The company used a CMS where all parts of the website were split out into essentially vanilla HTML/CSS/JavaScript snippets. In order to deliver a full site, but also in the format that would best translate into this CMS, I stood up a fairly bespoke system using Nunjucks and Gulp.

Nunjucks as a templating language allowed for all the things you might find yourself needing to implement components into a design – loops, if statements, etc, while also keeping our development efforts squarely centered in vanilla technologies.

Four years later, I might raise an eyebrow at this specific strategy and instead just point at Web Components. But at the time it fit the bill and allowed myself and my team to tackle the site as a robust design system of components.

## Challenges

While sorting out the architecture presented some early challenges, another technical challenge was having to dig quite deeply into the MapBox API to make some of the itinerary modules work. It was a lot of fun learning how to make MapBox zoom around the globe and overlay complex modules into the map itself.

## Tech Stack

- Plain HTML, CSS and JavaScript
- Nunjucks
- Custom Gulp build system
- MapBox
- GSAP
