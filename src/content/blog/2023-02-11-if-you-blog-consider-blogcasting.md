---
tags: 
  - post
  - insights
  - web
  - published
title: If You Blog, Consider Blogcasting
slug: if-you-blog-consider-blogcasting
summary: As someone who has been wanting to do a podcast but not having time for it. Blogcasting seems like a great middle-ground solution.
date: 2023-02-11 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/if-you-blog-consider-blogcasting.mp3"
---

# If You Blog, Consider Blogcasting

I had the not-so-new idea of attaching an audio companion to my blog. As someone who sort of wants to dip into podcasting (beyond [the one I already tried](https://spotifyanchor-web.app.link/e/WA1kAZiJjxb)), but doesn't quite have the time or drive to get something going right now, it seemed like a cool compromise.

I'm calling it blogcasting, because it seems right, and certainly it's not a term I invented, but as long as I don't google it, I can claim to have.

## How to get started Blogcasting

I went down a few avenues to get the blogcast up and running. First I thought I would use a podcasting platform to host it, and then, bonus, it would be a podcast too. Ultimately though, most podcast hosts are not free and it's a bigger process to add in all the metadata for a podcast episode just to get something published.

Thanks to friends in the [ShopTalk Show d-d-d-discord](https://www.patreon.com/shoptalkshow/posts) though, I was able to figure out a simpler implementation.

### Step 1: Record the episode

First, I settled on a very quick recording process using audio hijack to capture the audio, and Adobe Audition to do a very quick listen-through and editing of pace and mistakes. So far each episode takes about 1.5x its length to edit, and that seems pretty good.

### Step 2: Host the episode

You need a place to host your `.mp3` files. In some cases your blog might have a server that can do this. In my case, a static blog hosted on Cloudflare, I chose to create a Cloudflare R2 storage bucket to host my files.

### Step 3: Implement the blogcast into your blog posts

Since I'm now using Astro, I was able to very quickly create a `BlogcastPlayer.astro` component that uses [`muxinc/media-chrome`](https://github.com/muxinc/media-chrome) under the hood. It's a really fantastic web component library for doing quick custom video and audio players.

The `BlogcastPlayer.astro` component looks something like this:

```html
---
const {url} = Astro.props;
---

<div class="blogcast-player" >
  <media-controller audio>
    <audio
    slot="media"
    src={url}
    ></audio>
    <media-control-bar>
      <media-play-button></media-play-button>
      <media-time-range></media-time-range>
      <media-playback-rate-button></media-playback-rate-button>
      <media-time-display show-duration></media-time-display>
      <media-mute-button></media-mute-button>
      <media-volume-range></media-volume-range>
    </media-control-bar>
  </media-controller>
  <p>Listen along to this post as you read, or <a href="https://andrewwalpole.com/feed.xml">subscribe to the blog</a></p>
</div>

<script>
  import 'media-chrome';
</script>
```

Given a `url` prop, the player renders itself. Not shown are some of the extra styles I applied to fix it to the bottom of the page, but hopefully you get the gist of it.

### Step 4: Add the media to your RSS feed

This is honestly the most surprising and cool part about this. I had no clue that all you need to do to add media to accompany a blog post feed is to add an `<enclosure />` tag pointing to the file for each `<item>`.

It might look something like this:

```xml
<enclosure url="https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/if-you-blog-consider-blogcasting.mp3" type="audio/mp3"/>
```

Most RSS readers are happy to pick this up and display a playable interface.

## Will you give it a shot?

What do you think? Is this an appealing idea? Have you tried it out on this post? I'd love to hear your feedback, whether it's just dropping a like in the lower right (sorry RSS folks), or replying to my [tweet](https://twitter.com/walpolea/status/1624206212937191424?s=20&t=yuD8VWXotnPgkJSKT6JGPQ) or [toot](https://mastodon.online/@walpolea/109843310354666047) sharing this post. I myself am looking forward to Blogcasts sweeping the nation!