---
tags: 
  - post
  - published
  - web
  - front-end
title: The Showy / Hidey Navigation Bar
slug: the-showy-hidey-nav-bar
summary: An in-demand pattern distilled – a navbar that hides as you scroll down a page, but then instantly reappears and follows you when you scroll up.
date: 2024-04-08 12:00:00
---


# The Showy / Hidey Navigation Bar

That's definitely the technical term for it. It's that popular navbar pattern where the header disappears above the screen as you scroll down, affording you more content consumption space, but then, as if it were waiting just out of view for you, reappears upon the slightest scroll up.

I've built so many of these over the last few years, I decided to distill the pattern down. Essentially we need just a few ingredients to pull it off:

- A container separate from the `<header>` to sticky down the page.
- Some `javascript` to let us know when we've scrolled up or down.
- And if you don't want things to get too janky, an understanding of a minimum height for our header to be.

For our `html`:

```html
<header>
  <div class="navbar">
    <!-- All the nav stuff-->
  </div>
</header>
```

Focusing just on the pattern, I've left the innards of the navbar up to you, maybe a logo and a list of links would be good. We really just need the extra `.navbar` class to `position: fixed;` while the `<header>` stays `position: static;` to hold the space for the navbar. You can see that in our `CSS`:

```css
header {
  --nav-height: 100px;
  min-height: var(--nav-height);
  
  .navbar {
    --top-position: 0px;
    position:fixed;
    width:100%;
    top: var(--top-position);
    
    transition: top 0.6s;
    
    &.hide:not(:focus-within) {
      --top-position: -100%;
    }
  }
}
```

As I mentioned, setting the `--nav-height` is important because without letting the component know how tall it might be, it can't hold any space at the top of the page for the navbar to sit into. So either your first content section will run under the navbar, or if you toggle it between `static` and `fixed` positioning when you scroll, it will jump the screen up as it's taken out of the flow. It's all much simpler if you just hold the right amount of pixel space.

<aside>

As an aside, you might think I'm overdoing it here and you should just use `position: sticky;`. And indeed, this will keep the header in the flow and then sticky it to the top as you scroll. But I've gone down this path a few times and I continue to hit major barriers with sticky and the togglable mobile menu you may eventually build into the nav. So until I can get past that barrier I will continue to recommend `position:fixed;` for this pattern.

</aside>

Next, we default the `top` to `0px` and change it to `-100%` when it has the `.hide` class applied. Add in a transition and your navbar is ready to hide and show elegantly.

It's also worth mentioning the `:not(:focus-within)` bit, which allows the navbar to not be hidden when we give focus to the nav items. So as you tab through with a keyboard, the navbar will reappear.

Finally, we need some `javascript` to hook it all together. Though when scroll-driven animations are widely available, perhaps we won't need that at all.

```js
const useShowyHidey = () => {
  let lastScrollTop = 0;
  const navbar = document.querySelector(".navbar");
  
  const toggleNavOnScroll = () => {
    const st = document.documentElement.scrollTop;
    if ( st > lastScrollTop && st > parseInt(getComputedStyle(navbar).getPropertyValue("--nav-height")) ) {
      navbar.classList.add("hide");
    } else if (st < lastScrollTop) {
      navbar.classList.remove("hide");
    }
    lastScrollTop = st <= 0 ? 0 : st;
  }
  
  if (navbar) {
    window.removeEventListener( "scroll", toggleNavOnScroll);
    window.addEventListener( "scroll", toggleNavOnScroll);
  }
}

useShowyHidey();
```

We listen to the scroll event and toggle the `.hide` class based on scroll direction.

And here's [the whole thing in a codepen](https://codepen.io/walpolea/pen/eYoMOLp)!

<p class="codepen" data-height="500" data-default-tab="result" data-slug-hash="eYoMOLp" data-user="walpolea" style="height: 500px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;">
  <span>See the Pen <a href="https://codepen.io/walpolea/pen/eYoMOLp">
  Showy / Hidey Navigation Bar</a> by Andrew (<a href="https://codepen.io/walpolea">@walpolea</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>
<script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>