---
tags:
  - post
  - insights
  - computer science
title: Get Started with Robust-First Computation
slug: get-started-with-robust-first-computation
summary: Did you know there's an entire field of computer science barely yet explored? Join me at the entrance to a deep rabbit hole as we take a look at Robust-First Computation.
date: 2023-03-09 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/get-started-with-robust-first-computation.mp3"
---

# Get Started with Robust-First Computation

In 2017, with an hour to kill before teaching a web development class at UCSD, I stumbled into a free talk being put on. [*Living Computation & Postdeterministic Digital Design* by Dave Ackley](https://www.youtube.com/watch?v=Dmlm6mtnSZs). Little did I know it was to be an inflection point in my entire view of computer science and personal scientific interests.

This post is likely to get long, so I'll split up the sections into a table of contents for easy reference:

- [A World Beyond Hardware Determinism](#beyond-hardware-determinism)
- [Understanding Robust-First](#understanding-robust-first)
- [A Whole New World of Computer Science](#new-world-of-computer-science)
- [Writing Robust-First Code](#writing-robust-first-code)
- [The Movable Feast Machine](#the-movable-feast-machine)
- [The T2 Tile Project](#the-t2-tile-project)
- [How You Can Get Involved](#get-involved)

<a id="beyond-hardware-determinism" href="#beyond-hardware-determinism">

## A World Beyond Hardware Determinism
</a>

To set the stage for all of this, we have to look at the foundational components of computing we desperately rely on today. CPU and RAM; the Von Neumann Architecture has been the underlying fixture upon which we compute for nearly 80 years. It's the guarantee of hardware determinism that allows us to code in the way we do: the minutely micromanaged dictatorship of the *Centralized* Processor Unit tells us that with its complete worldview and direct access to the entire software state held in RAM, it will not ever deviate from perfection. So that from step one of our program to step one billion, we can rely on deterministic results and value to be what we expect them to be.

This is how Dave put it in his talk, and when it's put this way it sounds quite amazing, *too amazing*. Hardware determinism is fragile. Sure it has taken us incredibly far, I'm not saying to discount it at all. But the fact is, we've climbed so high on this fragile path that as we begin to see limitations ahead of us, we're becoming more and more aware of the treacherous place we're currently computing in.

One bit-flip and we might be cooked - might not be too - but might be indeed, and there's no way to predict which it will be. Crashes, blue-screens, all of these symptoms showing through the cracks of hardware determinism. And we pave over them:

- "Just one more bug to fix!"
- "No problem: restart it, it's efficient enough!"

We avoid the underlying issue entirely because we accept it absolutely as the immovable, unchangeable part of the system.

But here's the mind-blowing, blue-pill-offering moment: What of a world beyond hardware determinism? A new system, built from the ground up, where hardware certainly tries to be correct, but doesn't guarantee it, and without that contract, software now has to be built to exist and adapt in that world.

Well, that's *Robust-First Computation*, a computational system of hardware and software that embraces non-deterministic execution, and it's not just an abstract idea anymore.

<a id="understanding-robust-first" href="#understanding-robust-first">

## Understanding "Robust-First"
</a>

In order to understand why it's Robust-First Computation, we need to break the problem down. CPU and RAM impose a C.E.O. paradigm into its computational policy: *Correct and Efficient Only!*

As soon as we dispose of that foundation, we need to understand what other concepts then become available and useful on a less reliable platform. Robustness is *the ability to withstand or overcome adverse conditions or rigorous testing* and in an environment that is no longer guaranteed to be correct, lends itself incredibly well as a concept to deal with incorrectness or unknown conditions. So as we introduce the ability to be incorrect, we can trade off efficiency for robustness (because they are at odds) in order to maintain correctness.

And so we're left with the Robust-First Computing Creed:

> First be robust<br>
> Then as correct as possible<br>
> Then as efficient as necessary

<br>

<a id="new-world-of-computer-science" href="#new-world-of-computer-science">

## A Whole New World of Computer Science
</a>

Hello. Are you still with me? Thanks! Let's try to bridge into the more tangible aspects of these wild ideas I've laid out, and get into what this all might look like from a hardware and software perspective.

It's important to set a good perspective for all of this. Undoing CPU and RAM and starting over is hard and will be slow, and we're only barely beyond, or even arguably at, the starting line. *But that's what is so interesting to me.* After 80 years of core computer science discovery, nearly all based on deterministic execution, this feels like a small, obscured basement door, rarely perturbed, that opens up into an entirely new parallel universe of undiscovered computer science. **Absolutely wild!**

<a id="writing-robust-first-code" href="#writing-robust-first-code">

## Writing Robust-First Code
</a>

<a id="the-movable-feast-machine" href="#the-movable-feast-machine">

## The Movable Feast Machine
</a>

<a id="the-t2-tile-project" href="#the-t2-tile-project">

## The T2 Tile project
</a>

<a id="get-involved" href="#get-involved">

## How you can get involved
</a>