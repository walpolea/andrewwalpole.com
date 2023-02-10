---
tags: 
  - post
  - insights
  - published
title: We Need Context Management Systems
slug: we-need-context-management-systems
summary: Applying context to websites often lives tied to content, or tied to the front end, or split into both. Here I propose building a new contextual layer separate from both.
date: 2022-11-18
---


# We Need Context Management Systems

The problem with headless content management systems is that they don't cleanly account for the context of content to always be defined in a proper place.

Take a headless CMS with content representing a restaurant menu. In that instance, the content can be modeled in a way that is very easy to manage without assigning context to it. A very clean separation where content manager can happily keep up the data while the front end assumes the role of applying that content into its final context.

However, take a homepage, comprised of components (or blocks or modules). Here we have the content – the words and media on the page – as well as a specific context – the order and layout decisions that mold content into a consumable digital experience. 

Just ordering the list of components on the screen is applying a hierarchical context to the page. And then each component itself is often riddled with specific context choices. A hero: maybe the sizing and position of the heading text relative to a background image laid underneath. A grid of product cards might also give you control over the amount of columns or choosing a special layout for the first item to take on.

Abandoning a hard-lined rule that the CMS contains content and website code applies context comes with many trade-offs and implications.


## Mixing content and context can be good

- The content manager now wields more control over the website: this can lead to better upkeep and longevity in the utility of the site.
- It can make business sense: the previously mentioned longevity is attributed to a more cost-effective management of a site, as well as being able to streamline experiential changes to match the evolving goals of the business.
- Deciding on context first, when your content is still taking shape, can help solidify your content choices given the context limitations.


## But tight coupling leads to a lot of bad

Those benefits trade-off with things like a much heavier up-front cost to develop contextual flexibility into the site.

Also tying large amounts of context into a headless CMS erodes away a major benefit of headless in the first place: your contextual content now becomes specifically dependent on your component API, making it much harder to move away from that exact front-end implementation.

Without a clear line established, the decision for where every contextual variant in a component now becomes a discussion: How much configuration is appropriate for this component? Where will this get configured, and how? What's the experience of setting, evaluating and committing to contextual configurations?

The answering of these questions equates to significant time and effort for building a website. Furthermore, the decisions are often arbitrary without an underlying rule to strengthen them. This leaves a fragile barrier that invites continuous debate and last-minute changes as or after a system is built.


## It's hard to separate content and context

All that said, it might seem simple: stop mixing context and content! But that's actually hard. Context and content inform each other. As frustrating as it may be on the development side to manage a control panel of contextual inputs, it's also maddening for a content creator to build what they need to without a visual guide of what the end experience will be.


## But it can be done

I think there are two solutions to lay out here:


### Consider context strategically.

The first is taking on strategic consideration of the technical implementation of handling context as part of defining the project's scope. Become conscious of where contextual application sits in the thing you're building.

If more than "no context" will live at the CMS layer, decide up-front a clear sense of how much or how little context needs to be configurable. Where you land on this scale from little to most will ripple through budget, timeline and architecture.


### We need Context Management Systems

Second, I think there's a larger opportunity for technology to step in and formalize context further as a major step in making the web. *This is the Context Management System.* Create a separate space, that lives decoupled from content and code and streamlines the ability to marry content with an experiential context it is intended to be presented in. But why? That seems like a lot of added complexity!

Yes, it is more architecture and may not apply to smaller systems that can work out an agreed-upon shared custody of context. But I do firmly believe that the cleaner delineation of context is extremely valuable:

- Content managers can focus on *content* management and dial way back on the required technical proprietary understanding of system configuration so often thrown onto them.
- In tandem, the effort spent by the development team to customize the context configuration experience, which is driven by the specific technical expertise of an individual or team of content managers, can be greatly reduced.
- A new role, *context manager* is born. And maybe this still ends up falling on the content manager, or a developer, or maybe more strategically assigned to a designer. Whether it increases headcount or not, being able to assign this role specifically unattached to also managing content or also maintaining codebase is massively valuable.
- A context management system can focus on shaping content into an explicit experience, but also many explicit experiences using the same content, thus re-establishing the whole point of moving into a headless CMS.

### What does a Context Management System look like?

Managing context already exists across many platforms. The Wordpress Block Editor is a great example, it marries content and context management in a pretty good way. Some headless CMS products also provide various strategies to hook into your front-end code creating sort of an alternative path to the content creation experience. These are fine, and definitely fall under the bucket of strategic context management, but they aren't quite what I'm proposing here.

A context management system is one that sits much more firmly between the CMS and the final end-point. It takes on all of the deep ties to the front-end experience, but provides an interface that does not require intimate knowledge of code.

It can still provide an environment to experiment with context before content is finalized, but also brings UX design back into the conversation long after a web design has been finalized and approved. Where the maintenance phase of a website often consists of either: just change the content, or develop a new feature, with little in-between. Configuration at the contextual layer allows you to keep the content but change the experience. With having implemented a design system of components, this now becomes a massively useful tool to experiment with and apply that design system in an agile manner.

More technically, a Context Management System might have these features:

- A way to visualize multiple contexts at once at a high level.
- A way to apply content into a context (of course).
- A way to map content fields to possible contextual destinations within components.
- A way to transform content to fit certain contexts.

## Separating context and content is worth considering

Context is worth considering, separately from content and the front-end implementation. Especially in the case of working with design systems, your context options are defined up-front and fit this idea quite well. Just as content evolves, the design and experience with which it is conveyed should evolve too, sometimes separately from the message. I think we need tools that specifically focus on this capability that also allow for autonomy around developing new features and content. Context Management Systems, and Context Managers could be that next focused key that help large digital systems work effectively over a longer lifespan.
