---
tags: 
  - post
  - web
  - jamstack
  - published
title: The New Astro Content Collections are Great
slug: the-new-astro-content-collections-are-great
summary: Astro 2.0 just landed, and with it some great new features including Content Collections. Let's have a look!
date: 2023-02-10 12:00:00
blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/the-new-astro-content-collections-are-great.mp3"
---

# The New Astro Content Collections are Great

It's official, I think I'm an Astro fanboy.

If you're here, you might notice the site has been spruced up a bit, and that's because I just spent the last few evenings moving my entire site over to the [newly landed Astro 2.0](https://astro.build/blog/astro-2/). It was a joy to build. And while I quite loved my old Eleventy setup too, I'm glad I made the move.

But I'm not ready to gush about all things Astro yet, right now I just want to talk about a specific new feature: [Content Collections](https://docs.astro.build/en/guides/content-collections/).

## Content collections are a clever and simple file-based CMS

The way Content Collections work in Astro is you have a directory called `content/` in your project `src/`. In there, you create more directories, one for each content-type (or content collection) you want to manage. Within those content-type buckets you can put markdown or MDX files. The classic use-case is for a blog, like this one!

With metadata in the frontmatter and the content in the body, your markdown files act as individual content collection entries. The file-based nature of it is extremely robust, and I love that it's fully separated from the context in which the content will be placed.

In my case, this site currently has three Content Collections: `blog/`, `work/`, and `site/`. Each representing different content pieces that I may want to query for and place across my site.

## Using Content Collections is easy

There are two main ways to get content from Content Collections in Astro:

  1. You can query content by its file slug with `getEntryBySlug()`
  2. Or query an entire collection using `getCollection()`

### Querying by slug:

In my `site/` content collection I only have an `about.md` file for now. But as I build out sections and pages with content, I can add new files to the collection to pull out and place into areas of my site. It's a great use-case to query the content by slug because I'll likely know exactly which       single entry I'll want to put in a specific place.

In my `components/` directory I have a helper component called `SiteContent.astro` to make it easy:

```js
---
import { getEntryBySlug } from 'astro:content';

const { slug } = Astro.props;
const entry = await getEntryBySlug('site', slug);
const { Content } = await entry.render();
---

<Content />
```

This component imports `getEntryBySlug()` and calls it using a passed-in `slug` prop to query for a specific entry in my site content collection. Calling `render()` on the retrieved entry returns a `Content` component that can be used in the component body to render the markdown of the entry. If you needed to grab any of the frontmatter metadata for the entry, you can find all of that in the `entry.data` object.

Now in my `index.astro` I can just add a simple `<SiteContent slug="about" />` to render my `about.md` content.

### Querying multiple entries:

Getting multiple entries is not much harder. Creating the listing for my blog page looks a little like this:

```js
---
import CollectionListItem from './CollectionListItem.astro';
import { getCollection } from 'astro:content';

const {collection = 'blog'} = Astro.props

const allPosts = await getCollection(collection);

const { limit = Infinity, filter = ['published'], interactive = false} = Astro.props;
const filteredLimitedOrderedPosts = allPosts.reverse().filter(post => post.data.tags?.some( tag => filter.includes(tag) ) ).slice(0, limit);
---

{ allPosts.map( post => <CollectionListItem post={post} /> }
```

Again, given a passed-in `collection` prop, we can call `getCollection(collection)` to retrieve all of the entries as an array. From there it's a matter of massaging the array with features like sorting, filtering and limiting before sending them off to be rendered via another `<CollectionItem />` component.

### And there's more!

I didn't touch on it here, but Content Collections have another great feature: a full schema definition and checking system that keeps your content conforming to the required metadata you need to keep your site humming along properly.

All-in-all, I'm really enjoying Astro as a site builder. It's fast and intuitive, and if the slickness of Content Collections is any sign, I can't wait for this framework to continue to grow and mature.

If you'd like to see more of how I rebuilt this site in Astro, you can have a peek at the source code over on GitHub: https://github.com/walpolea/andrewwalpole.com.