---
layout: blog_base.njk
tags: 
  - post
  - web development
  - ideas
title: The Web Needs Muscles
date: Created
permalink: "blog/{{page.fileSlug}}/index.html"
customHeader: "/static/muscles.png"
headerTitle: true
---

{{page.date | readableDate}}
# {{title}}

## Does it?

It's a strange idea, and that's enough to write about, so muse along.

## Something, something person metaphor

How does it go? HTML is the skeleton, JavaScript is the brain and CSS is the skin. I guess that works ok when you don't give it too much thought.

*Shudders at giving it too much thought* 

But where's the rest of the person? Well it's sort of strewn about. Muscles are kind of a big deal, where are they? They cover up the bones, so maybe they're a part of HTML, but they react via brain signals so theres some JavaScripty encroachment going on there, and really you can't give your skin all the credit for your devilishly good looks, it's only the outer layer, the cherry on top, of your gorgeous dev-bod.

Ok, we did it, we thought about it too much and the metaphor broke down. Normally you hit that wall and move on. But let's not; not this time.

## HTML, CSS, JavaScript and ... muscles.

I'm not saying that we need something that already exists, like templating languages, reactive frameworks or style libraries to be natively adopted into the browser. Those exist just fine as abstractions of our base languages and capabilities on the web.

What I want to try to imagine is something that could remove some burdensome development use-case that currently we have to hook across all three browser languages to accomplish. What are the muscles?

## What would a fourth language do?

I don't really know; we're just musing along here, I was really up-front about that. If you know, let's hear it! But maybe just for the sake of the metaphor let's keep going. I really do feel like HTML sort of has its purpose and then some. Beyond providing a base structure for your content, it acts as glue to unite JavaScript and CSS with the browser, it has hooks into the events system, and accessibility features, connects pages together, handles all sorts of user data input situations, so on and so forth.

I think I can imagine, similarly to how CSS swooped in and took over styling and layout from HTML so many years ago, a dedicated language to describe, and handle – more succinctly and wholly – the actions/events and the effects they have upon the state of the content on the page. It's a bit of a fuzzy vision, but it feels like I find myself most bridging HTML, CSS and JavaScript when needing to deal with and react to events and maintain a ubiquitous understanding across layout, style and function the current state of the site. I mark my content to be found in HTML, I find the content in JavaScript or CSS, I hook into some user event and define some change I want to happen, sometimes a change that happens redundantly across all three technologies.

A native API layer, maybe it does resemble some sort of reactive state object/library, but it sits at a level where HTML, CSS and JavaScript have equal and uninhibited direct access to it in order to stay in sync and create much simpler action/effect chains among the content, visual look and functionality of any website.

To me, even as rough as it is, that sounds like a decent case for web muscles. I like it, and I'll continue to think on it. But if you agree or disagree, or have a clearer or different vision for a fourth web language I would love to hear about it. Until next time, I leave you with this idea, *you*, dear developer, are indeed the heart of the web.