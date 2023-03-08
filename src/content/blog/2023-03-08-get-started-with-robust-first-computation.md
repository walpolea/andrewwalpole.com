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
- [Living Computation as Robust-First Code](#living-computation-as-robust-first-code)
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

It's important to set a good perspective for all of this. Undoing CPU and RAM and starting over is hard and will be slow, and we're only barely beyond, or even arguably at, the starting line. *But that's what is so interesting to me.* After 80 years of core computer science discovery, nearly all based on deterministic execution, this feels like a small, obscured basement door, left dusty and unperturbed, that opens up into an entirely new parallel universe of undiscovered computer science. **Absolutely wild!**

<a id="living-computation-as-robust-first-code" href="#living-computation-as-robust-first-code">

## Living Computation as Robust-First Code 
</a>

So what does robust-first code look like? One way to answer this question objectively is to look around and see if we can find any robust-first systems that already exist, and in fact, they do! Humans, animals, microorganisms, plants; *living systems* are incredible examples of computational systems built to withstand and execute amidst wild amounts of varying environmental factors.

From Dave's own Robust-first computing wiki:

> Viewed as a kind of computer, note how different a living organism is compared to a serial deterministic machine. Deterministic machines are 100% completely repeatable – from the same inputs will come the exact same outputs — while living organisms rarely do anything the exact same way twice. Deterministic machines will crash, seize-up, or otherwise misbehave when virtually anything goes wrong inside them; living organisms, by contrast, can suffer grievous injury and yet survive, handle the immediate situation, and get away long enough to heal up and live on.

And so in thinking about what our code might look like, it's put forth that living systems are ripe for the picking to discover some of the base principles that might help us get into this new world.

- healing
- redundancy
- plasticity
- stigmergy
- bottom-up computing
- agential systems

And many more observable concepts can be repurposed into the pursuit of building robust software.

> "But Andrew, that's not writing code, that's thinking about writing code!"

Too true! To get down to the clickity-clacking of our keyboards there's a lot of work to figure out and do. But once again, thanks to Dave Ackley and others thinking about these ideas for many years now, there are some places to lean on to jump further into it.


<a id="the-movable-feast-machine" href="#the-movable-feast-machine">

### The Movable Feast Machine
</a>

The Movable Feast Machine (MFM) is Dave's specific architectural implementation of a software operating system, meant as a basis for programming robust-first software. Certainly, it's one of many possible ways you could build a robust-first architecture, but having worked with it myself, I would implore you to take a deep look at all it has to offer before trying to come up with your own system.

When people first see the MFM running, it's common to hear, "oh, it's like Conway's Game of Life!" And the answer is, "Yes, a little bit, but 'No' a lot a bit."

The MFM is a spatially laid-out 2D `Grid`, where individual grid `Sites`, implemented on hardware `Tiles` can contain `Atoms` which are essentially small agent programs that execute code/behaviors upon the grid within their own localized space. The important part is that there is no central control here. Each Atom on the grid can only see four sites away from its current location. The tiles, where sites are implemented are also treated as an implementation detail in the architecture: they're required to create a physical grid of tiles, and do help with robustness in that tiles can be swapped in and out as things need maintenance, but otherwise, the sites and atoms have no understanding that they are there; there is only the vast grid.

This brings us to an aside that I had not yet figured out how to work in. The MFM grid is built to be *indefinitely scalable*. Don't get it confused with infinitely scalable, we're not talking theory here. By having no centralized hardware or software unit, the MFM is designed to surpass traditional computing power, not by being efficient and fast, but by being able to grow in size without limits.

The official MFM is currently available in two places: First, you can get started with the Movable Feast Machine Simulator (MFMS). Dave has built this as a software program that runs on Linux and can be programmed in two programming languages he has concocted for robust-first programming: ULAM and SPLAT.


<a id="the-t2-tile-project" href="#the-t2-tile-project">

### The T2 Tile project
</a>

<a id="get-involved" href="#get-involved">

## How you can get involved
</a>