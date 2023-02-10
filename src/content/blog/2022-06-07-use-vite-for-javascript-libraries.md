---
tags: 
  - post
  - published
title: Use Vite for JavaScript Libraries
slug: use-vite-for-javascript-libraries
summary: More than once I've written some snazzy JavaScript code that I want to quickly turn into a sharable library, but the process of how to easily do that has bogged me down enough to drop the idea entirely. Here's a look at using vite to quickly publish your code as a JavaScript Library.
date: 2022-06-07
---


# Use Vite for JavaScript Libraries

More than once I've written some snazzy JavaScript code that I want to quickly turn into a sharable library, but the process of how to best and easily do that has bogged me down enough to drop the idea entirely.

In this post, I'll walk through how you can build a set of JavaScript into a library provided in both `ESM` and `UMD` format using vite.

There's not a lot of secret sauce here, in fact, most of what I'm about to show you is lifted right from the [vite docs](https://vitejs.dev/guide/build.html#library-mode). But I find it helpful when 3rd-party people can verify a technique.

## Setup

Starting from a fresh directory we need to:

- Initialize the project
- Install vite
- Setup some files

```bash
npm init --yes
npm i vite --save-dev
mkdir lib && touch lib/main.js vite.config.js index.html 
```

`lib/main.js` will be your main library entry point that vite will compile and `index.html` is actually optional, but what it's really great for is showing an example of how you use your library, which tends to be a small but nagging pain point in building a library that you want folks to use.

## Configure

Let's now configure vite to build your library. To do that we need to edit two files: `vite.config.js` and `package.json`.

### vite.config.js

```js
const path = require('path')
const { defineConfig } = require('vite')

module.exports = defineConfig({
  build: {
    lib: {
      entry: path.resolve(__dirname, 'lib/main.js'),
      name: 'YOUR_LIBRARY_NAME',
      fileName: (format) => `YOUR_LIBRARY_NAME.${format}.js`
    }
  }
});
```

The magic here is that vite has a [library mode](https://vitejs.dev/guide/build.html#library-mode), and that's exactly what we're using. By default it will build your entry point into `ESM` and `UMD` formats into a `/dist` folder.

### package.json

```json
{
  "name": "YOUR_LIBRARY_NAME",
  "version": "1.0.0",
  "description": "A GOOD DESCRIPTION",
  "files":["dist"],
  "main":"./dist/YOUR_LIBRARY_NAME.umd.js",
  "module":"./dist/YOUR_LIBRARY_NAME.es.js",
  "exports": {
    ".": {
      "import": "./dist/YOUR_LIBRARY_NAME.es.js",
      "require": "./dist/YOUR_LIBRARY_NAME.umd.js"
    }
  },
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  },
  ...
}
```

We wrap-up config by telling your `package.json` where your compiled library will live. This is not technically required, but if someone installs your library as a dependency, npm/yarn will know where to pull code from.

## Write the library

Your `lib/main.js` file is where you will export all of your code from. If your library is simple you could put all of the code right in there, or if it's more complex with multiple files, it just needs to import and reexport all the things you want to bundle into the library. It's also worth noting that if you import external dependencies into your library files they will also get bundled together in the final output.

As an example, I have recently created [a wrapper library for petite-vue called PV](https://github.com/walpolea/PV). You can check out the library code as well as the `index.html` to see how I'm using that to test and build a demo of the library.

## Build the library

`npm run build` or `vite build` will bundle up your library into `/dist` while `npm run dev` or `vite` will start a server to view your `index.html` which makes it easy to test things out as you build the library.

And that's all there is to it! If you need to further customize your library, vite is really just exposing a proxy for rollup, and you can add `rollupOptions` to your `vite.config.js` to customize your build settings, like [multiple entry points](https://github.com/vitejs/vite/discussions/1736#discussioncomment-312982).