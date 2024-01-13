---
tags:
  - post
  - published
  - insights
title: Bloxels is the Best STEAM Software for Kids
slug: bloxels-is-the-best-steam-software-for-kids
summary: No sponsors here, just an honest look back and review of a valuable and endlessly fun educational game for kids.
date: 2024-01-13 12:00:00
# blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/bloxels-is-the-best-steam-software-for-kids.mp3"
---

# Bloxels is the Best STEAM Software for Kids

In December of 2020, my then seven year-old was big into art and Angry Birds, which was his first foray into video games. He would play the game and when his screen time was over switch to his desk to draw all of the characters and the levels. As an engineering dad seeing his brain begin to piece together the complexities of playing a game like that, I naturally began itching to find a great gift that could introduce him to programming.

We had tried a few things previously; like those robots you can program to move with simple arrow buttons to denote going forward or turning. They were neat, but didn't really capture his attention. A bit of the same with scratch and scratch-like visual programming tools and games; He could understand the basics, but there wasn't enough payoff to them that held his attention.

Looking at what else might be out there to fill the "engineering for kids" void, it seemed as if I had to concede that there really wasn't a great product for such an early age.

## Enter Bloxels

![Bloxels home screen](/static/blog/bloxels/bloxels.png)

Deciding to pivot on engineering a tiny bit, I purchased [Bloxels](https://bloxels.com), an educational video game building app. I recall being quite unsure about it as there were a lot of mixed reviews on Amazon. It was an interesting product though. Not only were you purchasing a voucher to have an account and own the app, it also came with a physical pixel art board that lets kids design characters and levels by placing colored cubes into a grid; novel, but a neat way to turn pixel art into a tangible event.

So on Christmas morning, my little one opened it up and with a clearly excited-confused look of, "Wow, amazing... what is it?!?!" our journey into Bloxels began.

## What Bloxels is and what it isn't

*Before I go on, I just want to note that one of the great things about Bloxels is that what it is now is much more evolved from what it was three years ago. So from here on out I'll be referring to the latest capabilities rather than just the old.*

Bloxels is not really a programming game. At least not in a clear one-to-one manner. You won't find an exposed programming language with if statements and loops and variables to learn. Instead, Bloxels focuses more on the mechanics of design, both in form and function. And so in that sense, Bloxels is absolutely an *engineering* game.

### Teaching the form of design

![Bloxels character builder](/static/blog/bloxels/characterbuilder.png)

Bloxels is a great first drawing app for kids. I could even imagine that, had I been a Bloxels user earlier, I would have plopped my three or four year old in front of the character designer to play around with building pixel art. You can build pixel-based sprites with an easy to use interface and even animate them. It's an incredible introduction to digital art that balances ease of use and complexity of capability with masterful UX design.

There are essentially four modes of design within Bloxels:
- The character builder (for building characters with all their moving states)
- The art builder (for building environmental level tiles and items)
- A background builder (for creating backgrounds for your levels to sit on top of)
- And the game builder itself (for designing and bringing all your assets together into a game)

The first three design modes mentioned above have a very similar drawing app interface; it's the place you can really exercise those artistic pixel-art skills. The game builder though, is quite another beast. 

### Teaching the function of design

![Bloxels game builder screen](/static/blog/bloxels/gamebuilder.png)

Upon creating a new game, you're given a choice: `Platformer` or `Top-Down`; think original Mario Bros. vs original The Legend of Zelda. Once you make a choice the game builder sets you into your level, which is a large gridded-out canvas where you can place blocks. Different [block types](https://www.bloxels.com/tutorials/8-block-types) make up the core functionality of building games; from **terrain**, **hazard**, **collectible**, **story block**, **enemy**, **action block**, **power-up** and **liquid**, you have everything you need to design out the function of the game. The thing I love most about this is that the types of blocks are color-coded and can be placed down completely from a functional perspective first, and then later skinned with your various block-art designs. This presents a huge engineering skill packed into a very simple feature: planning out your functional design and mechanics separate from focusing on your artistic vision.

Each block type also has configuration settings, this is where we start to see some programming concepts in the game. Though limited to the features of Bloxels, there are enough if/then scenarios that can be built and toggled to do a decent job of building the mental foundations of connecting various decision trees to form a functional game.

You can set up:

- Doors and keys
- Various difficulties and types of enemies
- Power-ups for your character to change their abilities mid-game
- Warp points to move throughout levels and even across separate game maps
- And much more; Bloxels continues to add features regularly to keep games engaging

### They doubled down on the engineering

I'm not going to belabor convincing you that this is a good app for kids; **it really is**.

Instead, let's take a look at what really clinches Bloxels for me personally as something I *want* to support. Remember when I mentioned the bad Amazon reviews? Well it turns out that Bloxels original owners didn't do a great job at marketing the product and began failing as a company. Therefore they went through a period where they were offloading product with pretty much zero support, causing folks with issues to run screaming to the review section to say what a scam it was.

I'm not sure I have the story pieced together 100% correct, but it seems like one of the lead engineers was able to rescue the brand and the app from the company, take it over and turn the ship around by pouring time into making it a better, more reliable product. Years later, Bloxles seems to be quite healthy, and their continuous investment into features over many years has made it the incredible app it is today.

Under the hood, [play.bloxels.com](https://play.bloxels.com) is a pretty elegant looking SPA. All of the various features, capabilities and textures come in over API endpoints as structured JSON data, which is then rendered client-side. Given that once you're editing games nearly everything you see is user-generated or user-configured, it's quite a smart tactic to save and load sets of configurations back and forth, with efficiencies going into the size and structures of those datasets. Just open up `devtools` as you poke around and you'll be impressed with the interworkings of fetch calls and responses.

### Set up for success and encouraging failture

The last thing I'll focus on is how the game comes with a ton of asset packs and pre-made examples for kids to get started from. This creates a smooth on-ramp of usability and learning that is often lacking in software. At the same time, the `test` button is almost always on screen, encouraging learning to experiment and iterate with ideas with a near real-time feedback loop.

## tl;dr

We've been a [Bloxels](https://bloxels.com) household for over three years now and there are few apps or games that I can recall having such a long-term reverence for. I thought I was just getting something fun for my son to express his creativity and was surprised to find out it absolutely was that and a ton more. Bloxels strikes a balance of fun and education in a way that is quite rare. It promotes learning to iterate on design and take into consideration the player and advanced game mechanics and shows how bringing function and aesthetic design together is a powerful combination for creating engaging experiences. It is the best STEAM app I've come across for young children to learn how all the aspects of design and engineering play a powerful role in our world.

Once again, these thoughts are my own entirely, Bloxels has no understanding that I'm publishing this. They have just proven themselves deserving of kind and reverent words and a solid recommendation from this engineering dad.

I'll leave you with one of my son's first games to try out for yourself: [Flopsy's Adventure](https://play.bloxels.com/arcade/33646494)