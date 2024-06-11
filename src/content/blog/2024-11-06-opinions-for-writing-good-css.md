---
tags: 
  - post
  - published
  - web
  - front-end
title: Opinions for Writing Good CSS
slug: opinions-for-writing-good-css
summary: CSS is a flexible language that, in my opinion, requires opinions to be written well and consistently. Here are some of my opinions for writing good CSS.
date: 2024-06-11 12:00:00
---

# Opinions for Writing Good CSS

CSS can be hard and frustrating for beginners. The nature of the language is so different from traditional programming languages. While it’s easy to learn the parts: `selectors`, `properties`, `etc.` It's much tougher to practically compose multiple ideas together to make something new or more complex happen.

There just aren’t a lot of straight paths in CSS. With multiple ways to accomplish the same concepts, it can be difficult to figure out a solution that is new to you, and also to know if it’s the right or best approach. *If "it depends" is a telling mantra of the senior dev, CSS is indeed a language written to fill that space in an experienced developer's heart.*

As hard as it might be to fill the knowledge gap of knowing when and where to reach for what, that's what makes it such a beautiful language. CSS is quite robust and capable, as individual declarations can be complexly composed together into a lovely symphony of style and layout.

One of my core pieces of advice is: [to be flexible, be inflexible](/blog/to-be-flexible-be-inflexible). And I think that's really what this post is about with regard to CSS. Due to the nature of how complex CSS can and should be when written, it's important, to perhaps, **essential** to *have opinions* about how you write it.



## Opinions

As someone who has taught CSS to students and junior developers, take them or leave them, these are some of the opinions I've built up that I think help you in writing good CSS from day one.

### Don't include CSS that isn't needed

Too obvious? Maybe not! It's often necessary to experiment with things – don't be afraid of that! – but clean up failed experiments right away. Once you let something unnecessary linger in the codebase no one in the future will be able to easily tell if it's necessary or not – not even you!

### Use comments

Specifically, sometimes you need to write some CSS that either you aren't 100% confident about why you need it. This is the perfect place to express that skepticism in a comment, both for you and anyone else reviewing the code in the future. While there are other good reasons to use comments, including this confidence metadata for a solution opens up quick-win opportunities to revisit things later in an effort to refactor and improve the codebase. It also may signal spots where tough-to-track bugs may appear later.

### Avoid using Ids for CSS selection

Embrace the cascade. In doing that, you'll find that one of the core concepts is being adept at managing specificity in your code. And in doing that, the Id selector is just too potent to get used to using. For more information about this I can't recommend enough [this recent talk](https://www.youtube.com/watch?v=8Z8H2NEbLtE) by [Mayank](https://www.mayank.co/).


### Avoid using !important

Also related to managing specificity well, `!important` is a code smell. While there are some rare occasions where you absolutely need it (especially with inherited or older codebases), if you find yourself using it, there is a bigger issue somewhere. Stop and search out the issue first before deciding it is the solution.

### Figure out a system for consistency

No system is a bad system, and half a system is still a system. Naming, structure, selecting, vars, nesting, scoping; there are so many places in CSS where systematic consistency will go far in making your code revisitable and maintainable. Have a system of any kind, document it, and use it. As far as what system you should use, that’s all up to you. Do what makes sense. From [BEM](https://getbem.com/) to [CUBE](https://cube.fyi/) to making it up on the spot, there are a lot of options and most aren’t wrong considering the alternative.

### Resets and defaults are useful

In a related vein to systematizing, a good reset can take some antiquated complexities out of starting with CSS. I recommend checking out [Andy Bell's](https://piccalil.li/blog/a-more-modern-css-reset/) and [Josh Comeau's](https://www.joshwcomeau.com/css/custom-css-reset/) modern reset ideas.

Defaults are similar to resets, but can be used in a few clever ways. Define default values globally. These can serve your system as smart fallbacks. But also define defaults on things you can't afford to miss. The classic example being to select and apply a border to all images that have no `alt` attribute defined:

```css
img:not([alt]) {
  border: 5px solid red;
}
```

Clever selections of things you should be attending to aren't just a party trick, they work for you in complex builds, serving as a reminder to enforce your rules and system.

### Understand the codebase

This might be more specific to working on a team, but it's important to spend extra time reading and internalizing the CSS you aren't writing in a project. Aligning your coding style and the tools you reach for to the system in place is essential to keep the codebase feeling cohesive as you pitch in to build it. Get to know your reset, utility classes, global CSS vars, typography, colors, and spacing systems before moving forward on contributing your own components and styles.

### Lean heavily on CSS Variables

CSS variables aren't just about saving you keystrokes. Set up CSS variables as if you're gathering up your tools to implement your design. "I know I'll need these colors, backgrounds, pixel values, etc." Doing this will start to form a cohesive API of what makes the thing you're styling its specific style. In most cases you'll be set up to play with values easily and customize styling and layout across variations of your subject.

### Assess responsive requirements of a design first

Before writing any CSS, especially layout CSS, have a good long sit-down with your design. It's essential to formulate an understanding of how the next thing you're going to build behaves responsively. Clear responsive understanding will lead to cleaner, more elegant and thoughtful CSS solutions. Conversely, attempting to apply layout changes to a subject after one specific sizing has been created can often lead to brittle, band-aided solutions.

### Avoid margins on components and padding on containers

I'm not in the `no margins ever` club, but I do align with some of those points. Margin is special in that it often conveys spacing definitions between items. In a mode where you're styling a component, which often does not yet have an established context, you will want to wait to define a margin until the component is instanced into a final context.

Similarly, in styling something meant to contain or slot in some other unknown contextual item, be careful not to fix yourself to a specific set of padding so that it can be appropriately defined in each instance used.

There are exceptions to this depending on how flexible your system or design needs to be, but it helps to start from a cautious mindset and then explicitly opt-in to marrying spacing to any component.

### Don't paste CSS

I can't emphasize this enough, especially for the junior devs. **Do. Not. Paste. CSS.** Co-pilot for CSS? *No.* Figma styles for CSS? *No.* Grab all those cool styles from someone else's component? *No.*

Can you be informed by all of those things? ***Yes! Absolutely!*** But resist the urge to copy and paste large blocks of CSS as writing out each property definition will both make you a better CSS developer and engage your brain in a way that allows you to always make explicit and understood choices about the CSS you are writing.

## Wrapping up

I'm sure I could continue to build up this list until it matched my personal style of writing CSS. If you've disagreed with any of these, that's fine, they're just my opinions. But I do think I've picked a set that can be generally agreed upon and that I've seen provide a solid base for helping folks simplify their approach to CSS and end up with cleaner, better code. And I hope this post begs the question, *What CSS opinions do you have?*