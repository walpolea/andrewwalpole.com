---
tags:
  - post
  - published
  - front-end
  - web
  - design
title: Glowing Blurred Backgrounds with CSS
slug: glowing-blurred-backgrounds-with-css
summary: A quick walk-through of an easy, artsy and impressive pure CSS visual effect.
date: 2023-09-10 12:00:00
# blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/remote-leadership-takes-a-concerted-effort.mp3"
---

# Glowing Blurred Backgrounds with CSS

About a year ago I was asked to create a [glowing ball of light animated background effect](https://codepen.io/walpolea/pen/ZERZOaB) for a website. The end result was very cool looking for being so easy to pull off with just CSS. Here's a quick look at how it's done.

Using `clip-path: polygon()` and `filter: blur()` on a container you can create some pretty cool and performant glowing, animating background effects:

<p class="codepen" data-height="525" data-default-tab="css,result" data-slug-hash="JjwYaxM" data-user="walpolea" style="height: 525px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/JjwYaxM">
  Pretty Blurred Backgrounds with clip-path and filter:blur</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>

I think the code is pretty straightforward, so I won't go line-by-line, but here are the things to note:

Using `clip-path:polygon()` is a really great way to create interesting and scalable shapes since you can use percentage-based values. On top of that, they are pretty easy to create with [online tools](https://bennettfeely.com/clippy/) or vector graphics software.

I happen to prefer Adobe Illustrator, and while it's paid, I'm well-versed with it and I love that I can copy a path out of it directly into `vscode` as an SVG. And pro-tip, your SVG export settings in Illustrator will match how that copy/pasted code looks, so you can fine-tune it to format exactly as you like. Illustrator does prefer to export SVGs with absolute pixel values, so the other trick there is to use a `100px x 100px` artboard to draw your path, and then use [some JavaScript like this](https://codepen.io/walpolea/pen/MWZaReg) to convert the path from pixel to percentage values! Works like a charm!

Now back to the CSS effect! Since we're going to be blurring these paths, they don't have to be perfect at all. In fact, I get away with turning three rough blob shapes into a single path by connecting them with a sliver of path that ends up disappearing in the blurring process.

Here it is without the blurring applied:

<p class="codepen" data-height="525" data-default-tab="html,result" data-slug-hash="jOXBpZj" data-user="walpolea" style="height: 525px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/jOXBpZj">
  Pretty Blurred Backgrounds with clip-path and filter:blur</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>

The next tip is to animate the internal shapes, but apply the `filter:blur()` to the container. This will give you the performance you want on an effect like this. It also helps to blur with a `vw` unit since a fixed value might not be as blurred as you want on large screens or too blurred on small screens.

Lastly, you can use gradients and `mix-blend-mode` to get the exact effect you're looking for. The little CSS framework I've provided in the above code also gives you all you need to layer multiple paths on top of each other and tweak values like colors, opacity, size, position, and speed.


<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>