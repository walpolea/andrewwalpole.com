import { defineConfig } from 'astro/config';
import vue from "@astrojs/vue";
import sitemap from '@astrojs/sitemap';

import mdx from "@astrojs/mdx";

// https://astro.build/config
export default defineConfig({
  site: `https://andrewwalpole.com`,
  integrations: [vue(), sitemap({
    filter: page => !page.includes('/preview/')
  }), mdx()]
});