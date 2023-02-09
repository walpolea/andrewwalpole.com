---
tags: 
  - post
  - published
  - petite-vue
  - front-end
title: Blog Post Image Generator with HTML2Canvas
slug: blog-post-image-generator-with-html2canvas
summary: Here's a practical look at using html2canvas to generate images for blog posts. You might be looking at said image right now!
date: 2022-05-29
featuredImage: "https://andrewwalpole.com/static/blog/blog-post-image-generator-with-html2canvas.png"

---


# Blog Post Image Generator with HTML2Canvas

I'm a big fan of the [HTML2Canvas](https://html2canvas.hertzen.com/) library. It has some quirks and is less maintained (lots of [issues](https://github.com/niklasvh/html2canvas/issues) and open [PRs](https://github.com/niklasvh/html2canvas/pulls)) than I would like to see – actually I worry quite a bit about it becoming too stale to use, just because it can be so useful!

Here's a look at one way I'm using it to generate preview images for my blog posts, it's so simple, my production version of it just lives in codepen.

Before I get to that, I just want to clarify that this is not [automatic social share images](https://css-tricks.com/automatic-social-share-images/). Though this could be a piece of getting there, the biggest issue is that a hands-off solution will require you to automate the *"run in browser"* portion of an automated process, which you can pull off with something like [puppeteer](https://github.com/puppeteer/puppeteer), but that's not in scope of this post.

## The Setup

The setup is mostly focused on getting some HTML and CSS up that I would like to render as an image.

```html
<div class="featured-image" :class="{ square: isSquare }">
    <h1>{{title}}</h1>
    <p>{{summary}}</p>
    <div class="site-tag">
      <svg viewBox="0 0 1158 1201" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- truncated for space -->
      </svg>
      <div class="tag-content">
        <p>Andrew Walpole &copy; {{year}}</p>
        <p>andrewwalpole.com</p>
      </div>
    </div>
```

You'll notice some `{{petite-vue}}` content placeholders here, but it's not required. You could hardcode the content in, or use vanilla JavaScript to update it. But for me, petite-vue is a quick way to hook the content up to text inputs that I can easily use to generate a new custom image.

Here are those form fields getting hooked up to the content:

```html
<label>
  Post Title:
  <input type="text" v-model="title">
</label>
<label>
  Post Summary:
  <textarea v-model="summary" cols=50 rows=5></textarea>
</label>
<label>
  <input type="checkbox" v-model="isSquare"> Square
</label>
<button @click="saveDown">Save Image</button>
```

As mentioned, this provides a simple interface to allow the content to be customized quickly. The title and description can be entered, and I even have an option to toggle between wide and square layouts.

## The Secret Sauce

The last but most special bit is to use `html2canvas` to generate an image from the html, and it's pretty easy:

```js
import "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js";

saveDown() {
  const containerToRender = document.querySelector('.featured-image');
  html2canvas(
    containerToRender,
    { 
      allowTaint: true, 
      useCORS: true, 
      backgroundColor: "transparent",  
      width: containerToRender.offsetWidth, 
      height: containerToRender.offsetHeight,
    }
  ).then(canvas => {
    const previewArea = document.querySelector('.preview-area');
    previewArea.innerHTML = "";
    previewArea.appendChild(canvas);
  });
}
```

We `querySelector` for the container we want to imagify, then call `html2canvas( <container>, <options> )`. It returns a promise that when fulfilled will give you back a `<canvas>` element. We can then just append that canvas into our HTML and you can right click it to `Save Image As...`.

A few things to note. We're using the container's width and height to render the image, this allows our size toggle to work, and will also render a different image if the browser window is constraining the size. You can fix these values if you want a consistent size. Also, I had some issues with the SVG positioning and the opacity settings on it, also the `::before` on the title renders oddly the first time you save it, and then correctly the second time. These are those quirks I mentioned at the beginning.

The image that is generated is a PNG, which is not well optimized. I find myself needing to run it through [squoosh](https://squoosh.app) before using it, and that's a little annoying, but in my search for a client-side optimizer that could eliminate this step I have come up short.

Finally here's the whole thing for you to see and play with:

<p class="codepen" data-height="800" data-default-tab="result" data-slug-hash="VwQbzdq" data-user="walpolea" style="height: 800px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/VwQbzdq">
  Blog Post Featured Image Generator</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>