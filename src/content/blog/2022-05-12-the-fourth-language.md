---
title: The Fourth Language
slug: the-fourth-language
summary: Have you ever thought about the web having a fourth major, native language? Here are a few of my thoughts on it.
date: 2022-05-12
---

# The Fourth Language

The web, and more the browser as we know it today, has its three core technologies that allow us web developers to build web content: HTML, CSS and JavaScript. But what's next? *What will the fourth language be?* I know there's not much of a dialog to be had here on my blog, though I would love to hear your thoughts, perhaps via [twitter](https://twitter.com/walpolea). But here's what I think.

The fourth could be a language of state. There are countless flavors of state-keeping libraries rooted in JavaScript these days, and you might be prepared to argue that they can stay there. There are some really amazing implementations; [Vue's reactivity library](https://github.com/vuejs/core/tree/main/packages/reactivity) being incredibly impressive for how small and simple it is, and so many other examples that have made it easy to build robust and complex application workflows.

But there's an issue of interoperability.

As state libraries deeply ingrain themselves into JavaScript, they fracture the way we are meant to tie together HTML and CSS. Sometimes to the point that the implementor just kicks it all out the door: **JavaScript all the things!**

A reactive, state-keeping language is less about bringing new computer science to the web, and more about being a fourth member on the team; its own member, *an ambassador of state*, with its own opinions and integrations that could be equal across JavaScript, HTML and CSS. I think it would have an API that each other technology could lean into, to get, update, and react to state changes. When CSS changes the state, HTML reacts. When JavaScript changes the state, CSS and HTML react; all equally delegated to and updated from this new friend.

We already do these things, but the wires are left exposed and tangled, woven throughout these three existing layers, causing concession and work-around. A fourth language, a fourth layer, to abstract away the mess into a place that there is no mess at all – like a perfectly wired server rack – would remove a burden from both the existing tech we shoe-horn this functionality into and the developer who needs to manage and orchestrate it all (especially over time).

I think it could be JSON-ish, and even have some amount of compatibility there, but it would have some syntactic flair of its own for sure. An elegant exposure of models and relationships between data, not unlike what you see in [XState](https://xstate.js.org/). A way to focus solely on describing how your website or app collectively quantifies the inputs, outputs and triggered sequences of action and change that need to be known and possibly occur.

So that's what I think, and I have an appetite for it too. Sure, *it's another thing* but that's not a foreign concept for us web-folk. I'd much rather it be so extra super new that we can't ignore it; that we can't just throw it out and move on when we get bored. Instead, we can rally around it, and grow an entirely new community of folks that can help the rest of us through it, and we can clean up our code, and make room for a bunch of new crazy-yet-terrible innovation on the web.