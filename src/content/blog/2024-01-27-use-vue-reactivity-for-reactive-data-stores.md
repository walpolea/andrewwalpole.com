---
tags:
  - post
  - published
  - front-end
  - web
title: Use @vue/reactivity for Reactive Data Stores
slug: use-vue-reactivity-for-reactive-data-stores
summary: vue/reactivity is a small, stand-alone reactivity system that any JavaScript framework can use. Here are three ways to create shared state stores with it.
date: 2024-01-27 12:00:00
# blogcast: "https://pub-40fccf9e493a4d029eb2b8955f358ac3.r2.dev/use-vue-reactivity-for-reactive-data-stores.mp3"
---

# Use @vue/&ZeroWidthSpace;reactivity for Reactive Data Stores

Vue's reactivity system has been around since 2020, but I've often thought it has gone under the radar. That thought was more than confirmed for me when the idea of signals dropped last year and everyone seemed to go nuts at it's revelational reactive state capabilities. To me, at both first glance and deeper-dive, signals was barely different from `@vue/reactivity`.

But I can see why it has been overlooked. It has `vue` in the name, so it must be for Vue! That's not the case. Though built for and into the core offering of `Vue 3`, the `@vue/reactivity` package stands alone just fine and can be used completely absent of Vue the component framework.

Again for those of you in the back:
> [`@vue/reactivity`](https://github.com/vuejs/core/tree/main/packages/reactivity) is a completely stand-alone and light-weight reactivity system.

## Why reactive data stores?

There are a lot of patterns that vary in complexity to add the capability of shared state across an application or website. Without getting in the weeds there, the reactivity part of a reactive data store pattern is really about abstracting away the ability for state to become updated as it changes across the places it needs to be used. So instead of having the manually retrieve values as they update, you have automatic mechanisms to tap into performing actions as state updates.

## 3 Ways to create reactive stores

One thing I like about the `@vue/reactivity` package is that you have a few options as to how you want to structure your stores. You can level up the complexity of them which helps you build in safeguards needed to wrangle state across larger apps, or keep them dead simple for smaller needs. Let's take a look at three patterns, going from simple to more complex:

### Really simple global store

This is about as simple as it gets. We use the library's `reactive` object to store all of our values, getters and actions. This is great for small but highly shared sets of data that need to stay in sync.

`store.js`
```js
import { reactive, computed } from '@vue/reactivity';

// global reactive state
export const state = reactive({
  count: 0,
  increment() {
    state.count++;
  },
  countIsEven: computed( () => state.count % 2 === 0 ),
});

```

When we want to use the store, we simply import the `store` object and access all the properties. Here's an example of wiring-up our counter with vanilla `HTML` and `javascript`.

`somewhere-else.html`
```html
<div class="count"></div>
<div class="is-even"></div>
<button class="inc">++</button>

<script type="module">
import { effect } from "@vue/reactivity";

document.querySelector('.inc').addEventListener('click', () => state.increment() );

effect( () => {
  document.querySelector('.count').innerHTML = state.count;
  document.querySelector('.is-even').innerHTML = state.countIsEven;
});
</script>
```

This introduces the `effect` function, which is the way we tap into state changing automatically: any function passed into `effect()` will be run when the state changes.

[View as Codepen Demo](https://codepen.io/walpolea/pen/ExMXKOQ?editors=1010)


### The flexible store

This pattern ups the complexity a bit but provides a few safeguards and lets you distinguish between global shared state and also instance-specific local state values.

`useCounter.js`
```js

import { ref, computed } from '@vue/reactivity';

// Global state, getters, actions:
const globalCount = ref(0);

const countIsEven = computed( () => globalCount.value % 2 === 0 );

function incrementGlobalCountOnly() {
  globalCount.value++;
}

//Scoping our store into a function allows us to capture
//local state which can be run across multiple instances of useCounter
export const useCounter = () => {

  // Local state, getters and actions
  const localCount = ref(0);

  const localCountIsEven = computed( () => localCount.value % 2 === 0 );

  function increment() {
    globalCount.value++;
    localCount.value++;
  }

  return {
    globalCount, 
    countIsEven,
    incrementGlobalCountOnly,
    localCount,
    increment,
    localCountIsEven
  };
};
```

Here we've established two places to declare state and actions. Outside of the `useCounter` function, these values will be shared among all users of the store, but declarations made within the function provide each caller of `useCounter()` its own localized copy of that value. This allows for a reusable pattern that lets you compose state and function into any sort of UI; excellent for components!

Here's a look at using this counter store with templating library, [`lit-html`](https://lit.dev/docs/v1/lit-html/introduction/), where we put together a quick reusable `Counter()` template. This code is a direct pull from [a snippet Evan You shared back in 2020](https://x.com/youyuxi/status/1298674615468863490?s=20)

`somewhere-else.html`

```html

<h2>Counter 1</h2>
<div class="counter-1"></div>

<h2>Counter 2</h2>
<div class="counter-2"></div>

<script type="module">

import { useCounter } from './useCounter.js';
import { effect } from "@vue/reactivity";
import { html, render } from "lit-html";

const Counter = () => {
  const {
    increment, 
    globalCount, 
    localCount, 
    countIsEven, 
    localCountIsEven 
  } = useCounter();
  
  return () => html`
    <div class="counter">
      <p>Global Count: ${globalCount.value} - isEven? ${countIsEven.value}</p>
      <p>Local Count: ${localCount.value} - isEven? ${localCountIsEven.value}</p>
      <button @click=${increment}>++</button>
    </div>
  `;
}

//This marries our component instance with the DOM
//and sets up re-rendering based on state using effect
function mount( comp, target ) {
  const template = comp();
  effect( () => render( template(), target) );
}

mount( Counter, document.querySelector('.counter-1') );
mount( Counter, document.querySelector('.counter-2') );

</script>
```

Perhaps not the most practical example here, but I hope it's clear that this pattern gives you more options as to how you can scope reactive state to both the global and local instance.

We also switch from piling everything into a `reactive` object and instead reach for `ref` which is similar but meant for creating reactive primitives. Separating our state and actions into individual variables allows them to be exported and then imported separately which gives you granular control over which consumers of the state can access and do what. It's also worth mentioning that with `ref` types, we must use `<ref>.value` to access the data, whereas, `reactive` types, the keys can be directly accessed.

[View as Codepen Demo](https://codepen.io/walpolea/pen/gOERMYO?editors=1010)


### Multi-store app state

With greater app complexity comes a greater responsibility to stay organized and limit where and when state can be mutated. This last pattern continues to add a few features that help you maintain sanity across a larger application structure with multiple sets of data.

Mainly I'll add two concepts that help separate mutation from state and also show that you don't need one store to rule them all; we can break things up by service or domain to allow components to specialize in their state scope.

First, let's create two separate stores similar to our previous patterns:

`/store/UserStore.js`

```js
import { reactive, computed } from "@vue/reactivity";

// State
const user = reactive({
  isLoggedIn: false,
  username: null,
  profileUrl: computed( () => {
    return user.username ? `/profile/@${user.username}` : undefined;
  })
});

// Actions
const User = {
  async Login( credentials ) {
    user.username = await Auth( credentials );
    user.isLoggedIn = true;
  },
  Logout() {
    user.username = null;
    user.isLoggedIn = false;
  }
}

export { user, User };

// Private functions
function Auth( credentials ) {
  // TODO: Authentication
  return "UserName";
}
```

This simple User-scoped store begins by only keeping state within the reactive `user` variable. All mutation actions are then placed in a `User` object. I like the simple distinction of lower and uppercase to distinguish these, but feel free to name them something like `userState` and `UserActions` if you want to be more explicit.

In this case, since the `UserStore` is more of a singleton pattern with only global properties, we aren't using the previous pattern of wrapping our export in a function like `useUser()` but again this is easily done if you need that instanced local state as well.

Here's another store we might have in our app to track global UI state:

`/store/UIStore.js`

```js

import { reactive } from "@vue/reactivity";

// Constants
const THEMES = ["light", "dark", "waverunner64"];

// State
const ui = reactive({
  showSettingsPanel: false,
  colorTheme: "light",
});


// Actions
const UI = {
  toggleSettingsPanel(v) {
    ui.showSettingsPanel =
      v === undefined ? !ui.showSettingsPanel : v === false ? false : true;
  },
  settingsPanelOff() {
    UI.toggleSettingsPanel(false);
  },
  settingsPanelOn() {
    UI.toggleSettingsPanel(true);
  },
  changeTheme( theme ) {
    if( isValidTheme(theme) ) {
      ui.colorTheme = theme;
    }
  }
};

export { ui, UI, THEMES };

// Private functions
function isValidTheme( theme ) {
  return THEMES.includes(theme);
}
```

We've introduced some constants that you may want to expose as helpers, but otherwise same deal here: separate state and logic into respective `ui` and `UI` objects.

Now for the final piece to the pattern. While you could expose each of these state objects directly to the components that need them, I like to hide them behind one more layer that composes all of your state objects together. This creates a unified way components access state, creates a layer to inject middleware and transforms, and may make refactoring easier down the road.

`UseAppState.js`

```js

import { ref, readonly } from "@vue/reactivity";
import { user, User } from "./userState";
import { ui, UI } from "./uiState";

const initialized = ref(false);

function initializeAppState(config) {
  //We can do things like set up a database connection
  //Or load information from localStorage here
  console.log('initialize app state');
}

export const useAppState = (config) => {
  if (!initialized.value) {
    initializeAppState(config);
    initialized.value = true;
  }

  return {
    ui: readonly(ui),
    user: readonly(user),
    UI,
    User,
  };
};
```

The layer here is pretty light, but a few things to point out. We've moved back to the `useAppState()` function to allow you to do any sort of local initialization you may need. We also have a global initialization function that will run once the first time any component or service taps into our state model. This is great for initializing database connections or loading in preset. Lastly and most importantly, we've introduced the `readonly()` function supplied with `@vue/reactivity` which turns your reactive state object into a copy that cannot be directly mutated. This further safeguards our data from accidentally being changed outside of the specified action functions.

To see how this can be used check out this full [Astro-based demo on stackblitz](https://stackblitz.com/edit/vue-reactivity-app-state?file=src%2Fstore%2FUIStore.js,src%2Fstore%2FUserStore.js,src%2Fstore%2FUseAppState.js,src%2Fpages%2Findex.astro).

## tl;dr

I showed you three patterns for creating simple to more complex reactive stores that can be shared across instances of just about any sort of client-side JavaScript, be it Vue components, Astro components, React, web components or just plain `<script>` tags.

One of the biggest points I want to leave you with is that these patterns aren't perfect and the pattern you choose could be a middle-ground between these, or even something much more battle-hardened than the final example. **There isn't any exact way to build these**; there's an ambiguity to deal with in how flexible the library and its individual constructs are. So most of all, take into consideration your application size and needs to create a shared state pattern that works best for you.

[`@vue/reactivity`](https://github.com/vuejs/core/tree/main/packages/reactivity) is an underrated library that is both lightweight and mature. So I can't recommend enough taking a look if you're looking to add reactivity or shared state and data store solutions to your next project.
