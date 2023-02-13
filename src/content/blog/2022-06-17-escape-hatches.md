---
tags: 
  - post
  - published
  - web architecture
  - insights
title: Escape Hatches
slug: escape-hatches
summary: Third-party frameworks and systems abstract away complexity, but often at the cost of flexibility. Escape hatches can be a great way to bring flexibility back without compromising features.
date: 2022-06-17
blogcast: https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/escape-hatches.mp3

---

# Escape Hatches

In web development, we rely on a lot of 3rd party systems when it comes to the practical building of websites and apps. *Your stack is a conglomeration of important decisions.* As someone responsible for making those decisions, the choice often comes down to:

> What do I get, and what do I give up?

Each framework, technology, or system gives you something – proprietary features, enhanced development experiences, hyper-specific workflows; essentially abstractions and shortcuts to getting the work you need to do done quicker and easier. You're buying-in to system productivity.

At the same time, all of those abstractions force you into a specific set of constraints. Some systems only integrate well with particular other systems. Others, may only solve for specific use-cases on top of a general process, cutting down on flexibility (or maybe it makes you feel better to call this complexity). Wordpress, as a classic example, has features that require specific technologies to sit around it, dictating the full stack – PHP, MySQL, Apache/nginx – but in return you get quick entry into building front-end pages, managing content, and a whole host of functions that tackle non-trivial common web-based situations.

Anyway, not to belabor the point:

> Abstractions have trade-offs that require careful consideration.

What I really want to say is, maybe they don't always have to. Certainly, some levels of the stack would have a harder time than others at this, but providing escape hatches to eject out of the abstraction, down into the underlying technology, can do wonders for a product's value. As an architect, I have learned to put *heavy weight* on technologies that provide both the happy-path as well as the ability to deviate when critical opportunities or edge-cases arise.

A great example of this is Vite. I have to think that a part of its popularity is not just the happy-path it provides, but also the ability to exit down into both the raw rollup and esbuild configurations when you need to; a feature I've already used more than a handful of times in production systems.

### Why don't more companies provide escape hatches?

I think it's two things:

1. There is a common mindset that the happy-path, your product experience, *defines your product*, and there just isn't enough internal perception to look beyond those walls. It's rarely questioned, and perhaps when it is, it's hard to argue away resources from focusing on bringing direct value to your offering.
2. Related, I think it's also common to think that if you expose the escape hatch, you also need to start paving the road out there too. It becomes hard to let go, it may even feel like if a whole portion of the experience you provide has no support, you're letting your users down in some way.

I think these reasons are both short-sighted, and are mostly a product of not considering a different audience: the folks that take on the debt of your product. I don't care if the escape hatch leads to treacherous territory, I agree to the terms and welcome the ability to not be hamstrung when executing on my very specific business needs.

So, if you have a hand in building your product, take a moment to consider the escape hatch; a way to leverage the features you're already building on top of, and a way to provide welcomed value to those who seek to push the limits of your happy-path.