---
tags: 
  - post
  - published
  - web
  - back-end
  - web architecture
title: Build Your Next App with Durable Redis
slug: build-your-next-app-with-durable-redis
summary: Capability delivered through simplicity is one of my favorite features of tech. Digging into using durable redis to power a web-application, I found that it hits a perfect sweet spot of being easy to work with and capable of storing and relating diverse application data.
date: 2024-11-01 12:00:00
---

# Build Your Next App with Durable Redis

Connecting your website or app to a database unlocks an immense amount of possibilities; being able to create something that adapts to usage over time is a critical enabling factor to compounding work that a computer can do for a person.

In the past I've written at length about a few of the KV store offerings out there, like [Cloudflare KV](/blog/building-a-like-button-with-cloudflare-workers/) and [Deno KV](/blog/fast-and-simple-apis-with-deno-kv/). I like them because because they are some of the simplest data services that you can tap into to bring your projects up to that next level of being dynamically data-driven.

With simple keys and values though, there are limitations around how far you can push those stores into behaving like a fully modeled application database. You might think then, that as you need to graduate up to another level of database capability you may need to bite the bullet and jump into something with way more setup overhead like Postgres, MongoDB or some similar equivalent.

## What's Redis?

I'll be honest, for as long as Redis has been around, I've mostly been oblivious to it. Academically I get it: *It's a database that capitalizes on the speed of running in-memory to make getting and setting data fast.* So as a proxy layer that sits between your big slow database and your user, it can be applied into your architecture as a means to squeeze out performance and scalability of your system.

Given that summation, it's hopefully apparent that Redis really doesn't sound like something to be reaching for for small projects and experiments.

## What's Durable Redis

Here's where that conclusion flips on its head a bit.

Redis is built with the ability to be hosted as a durable solution. While usually it isn't when used in the proxying context described above, durability is really what Redis lacks to be a stand-alone database solution. Essentially this means that as Redis is interacted with in-memory, it also performs the work of syncing and saving data to disk, allowing an outage to not cause total loss of data. This may slow down performance a bit, but trades off excellently with the need to simplify your architecture and choose Redis as a primary data source.

Durable Redis is pretty cool. The database itself is NoSQL in concept, bringing the simplicity of a KV store, but also going beyond with having an understanding of many different value types which can be traversed, compiled, searched and queried quite powerfully.

## How to get started with Durable Redis

I was introduced to Redis through [Vercel KV](https://vercel.com/docs/storage/vercel-kv). Digging in there though, you quickly realize that the service is mostly a light wrapper around [Upstash](https://upstash.com/), one of the only hosted durable Redis services I've been able to find. If you're looking to host it yourself, this really isn't the article for you, but I imagine it could be figured out pretty well with Docker.

Maybe worth mentioning also that [Amazon has MemoryDB](https://aws.amazon.com/memorydb/) which touts itself as a Redis compatible, durable data solution; I haven't tried it out but it sounds possibly comparable.

Upstash has quite decent [pay-as-you-go pricing](https://upstash.com/pricing), and a generous free tier, making it ideal for side-projects or small apps.

### The basics

Upstash walks you through setting up your first database, and when finished provides you the tokens you need to access the database via their SDK which comes in the usual various flavors.

For me, I've been using it through Astro SSR, which allows me to easily build server-side application logic that can interact with the DB, or create API endpoints that can proxy access to the client-side.

Essentially, like any KV store, Redis allows you to set data at keys; up to 250 million of them per instance! So even simple sets and gets will go quite far for you. Let's take a look at simple CRUD functions before talking about some useful capabilities:

`redis-crud.js`
```js

import { Redis } from '@upstash/redis'

const redis = new Redis({
  url: 'https://your-db-instance-name.upstash.io',
  token: '********',
})

/**
 * Create or Update a JSON object using `JSON.SET`.
 */
export async function createOrUpdateObject(key, data, path = '$') {
  return await redis.json.set(key, path, data); // '$' indicates the root path
}

/**
 * Retrieve a JSON object by key using `JSON.GET`.
 */
export async function getObject(key, path = '$') {
  return await redis.json.get(key, path); // '$' retrieves the entire object
}

/**
 * Delete an object using `DEL`.
 */
export async function deleteObject(key, path = '$') {
  return await redis.json.del(key, path);
}

```

It doesn't get much easier than that folks! Four critical operations handled in three simple functions.

If you noticed the `path = '$'` bit, essentially this has to do with Redis understanding JSON to a fair extent. We can use the [JSON commands](https://upstash.com/docs/redis/sdks/ts/commands/json/set) to modify objects and arrays and nested values within sub-parts of object models rather than continuously retrieving and re-storing large objects over each call.

### A few Redis tips

To take Redis further, I found the pattern of adding types to my keys very useful. For example, say you have multiple types of data you want to store in a Redis database. Well, the top-level set of keys are flat, so you can use the keys themselves to delineate data.

Keys like, `user:12345` or `todo:98765` where the prefix defines the data type and the suffix defines the Id, allows for a great way to scope down your data sets. You can then use `SCAN` which accepts a glob-style pattern to query your keys by type:

```js
export async function getAllObjectsOfType(type) {

  const pattern = `${type}:*`;
  let cursor = 0;
  let keys = [];
  
  //Use SCAN to retrieve all the keys
  do {
    const [nextCursor, scanKeys] = await redis.scan(cursor, { match: pattern });
    cursor = parseInt(nextCursor);
    keys = keys.concat(scanKeys);
  } while (cursor !== 0);
  
  if (keys.length === 0) return [];
  
  //Use JSON.MGET to retrieve all the objects at those keys:
  return await redis.json.mget(keys, '$');
}
```

We can write a simple function to check if a key exists:

```js
export async function keyExists(key) {
  return await redis.exists(key);
}
```

We can also write functions to modify JSON primitives, like adding/removing items in arrays, flipping boolean values, and incrementing or decrementing numeric values. Here are a few examples of those:

```js

export function redisKey(type, objectId) {
  return `${type}:${objectId}`;
}

/**
 * Toggle a boolean field in a JSON object using `JSON.TOGGLE`.
 */
export async function toggleBooleanField(type, objectId, path) {
  const key = redisKey(type, objectId);

  // Use `JSON.TOGGLE` to toggle the boolean field
  const newValue = await redis.json.toggle(key, path);

  // Return the new boolean value
  return newValue;
}


/**
 * Increment a numeric field in a JSON object using `JSON.NUMINCRBY`.
 */
export async function incrementObjectField(type, objectId, path, incrementBy) {
  const key = redisKey(type, objectId);
  return await redis.json.numincrby(key, path, incrementBy);
}

/**
 * Append a value to an array in a JSON object using `JSON.ARRAPPEND`.
 */
export async function appendToArray(type, objectId, path, value) {
  
  const key = redisKey(type, objectId);
  const exists = await redis.exists(key);
  
  if (!exists) {
    return await redis.json.set(key, path, [value]);
  } else {
    return await redis.json.arrappend(key, path, value);
  }
}

```

## Conclusion

I've just got done with my first foray into Durable Redis while building an app for a client using Astro and Vercel KV. I was impressed with the sweet spot of capability and simplicity in getting up and running with it, and hopefully I've shown you that this is a great option for projects that are not overly complex but need a bit more than a simple KV or object store. I think this is a great option to help get your next fun idea off the ground and even scale up a bit as it grows into something bigger.