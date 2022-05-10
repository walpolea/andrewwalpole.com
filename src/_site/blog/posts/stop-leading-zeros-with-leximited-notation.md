---
layout: blog_base.njk
tags: 
  - post
  - published
title: Stop Leading Zeros with Leximited Notation
summary: Ever hit the issue where you want numbered items to alphabetically order themselves numerically, so you lead them with zeros, which works until you have more digits than zeros. Leximited notation solves this issue, and then some!
date: 2022-05-10
permalink: "blog/{{page.fileSlug}}/index.html"
url: "blog/{{page.fileSlug}}/index.html"
---

{{page.date | readableDate}}
# {{title}}

Have you ever started a content series of some kind – maybe videos, music tracks, book chapters, blog posts or podcast episodes – where you want the episode number to be a part of the title, and so you just start naming them:

- &#8203;1. Introduction
- &#8203;2. The thing after the introduction
- &#8203;3. We're well beyond the intro now
- .
- .
- .
- &#8203;10. Quite a milestone
- &#8203;11. It goes to to eleven

Have you seen the problem yet? You can sort numbers easy-enough, sure:

```js
[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21].sort()

OUTPUT: [1, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 2, 20, 21, 3, 4, 5, 6, 7, 8, 9]
```

*Whoops!* Oh yeah, it's JavaScript, you can sort numbers ~~easy-enough~~, sure:
```js
[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21].sort( (a,b) => a - b )

OUTPUT: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
```

As you saw in the first example, on the default `Array.sort()`, even numerical values in JavaScript undergo an alphabetical sort, and it's no different when those numbers are strings. It's even harder as part of a title to cook-up a function that is going to both parse out the number from many characters and attempt to sort it correctly. Beyond that, our content lives in databases and across platforms, and so the issue gets worse as you may not even be in control of the sort algorithm.

> Did you know that the non-numerical ordering seen above has a name? It's lexicographical ordering, or lexical order. Remember that now!

<br>

### Enter: Leading Zeros

I'll be brief here, because, *spoiler alert*, this is not the answer I'm recommending. You can trade that sorting issue for another. You can lead the numbers with zeros. From an alphabetical perspective, your sorting will now check out:

```js
['001', '002', '003', ... '010', '011'].sort();

OUTPUT: ['001', '002', '003', ... '010', '011']
```

But do you see the issue you traded in for? Up front, you need to commit to a number of leading zeros, and as soon as you hit a number that extends beyond the bounds of your zeros, you're right back to the original sorting mess.


### A new challenger approaches: Leximited Notation

[Dave Ackley](https://twitter.com/livcomp) came up with a different style of numerical notation that solves both issues. A notation that *when sorted alphabetically or numerically maintains the same order*: [Leximited Notation](https://github.com/elenasa/ULAM/wiki/Appendix-D%3A-Leximited-Format).

It's pretty easy to learn, kind of like pig-latin as a kid, it's a bit odd at first, but then you get the hang of it quickly as you go. Here's how it works:

- You prepend the number's character length to the number itself.
- **That's it!** Let's take a look at some examples:

`4 has a character length of 1, so in Leximited notation it's: 14` The length is prepended to the number itself.

Another: `37 has a character length of 2, so in Leximited notation it's: 237`

Let's try counting!

`0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ... 99, 100, 101` in Leximited format would be: `10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 210, 211, 212, 213, ... 299, 3100, 3101`

The numbers are also self-delimiting which means if you parse a string with leximited numbers, you can use the first value to know how many character spaces to parse out of the string to get the entire number. So, to complete the *"Ahhhhhh, I get it!"* moment, the name comes from:

> *Lex*icographically Del*imited* Notation!

Ahhhhhh, I get it!

### tl;dr

Leximited Notation solves an annoying issue where numbers as strings, especially in titles of things, lexicographically sort differently from numerical sorting. You can lead those numbers with zeros, but that's both ugly and flawed. Leximited notation on the other hand is easy: *You just prepend the number's character length to the number itself*.

You can [read all the juicy details on Leximited Notation](https://github.com/elenasa/ULAM/wiki/Appendix-D%3A-Leximited-Format) or if you want to use it in code, I put together a simple [JavaScript encoder/decoder](https://github.com/walpolea/leximitedjs) on github.
