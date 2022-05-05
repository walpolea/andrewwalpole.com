const pluginRss = require("@11ty/eleventy-plugin-rss");
const pluginDate = require("eleventy-plugin-date");
const syntaxHighlight = require("@11ty/eleventy-plugin-syntaxhighlight");

module.exports = function (eleventyConfig) {
  eleventyConfig.addPlugin(pluginDate);
  eleventyConfig.addPlugin(pluginRss);

  //watch and copy over the bundles css and js
  eleventyConfig.addPassthroughCopy({ "./src/_site/assets": "assets" });
  eleventyConfig.addWatchTarget("./src/_site/assets");

  //copy over all assets
  eleventyConfig.addPassthroughCopy({ "./src/assets/": "assets/images" });
  eleventyConfig.addWatchTarget("./src/assets/");

  //copy over static files
  eleventyConfig.addPassthroughCopy({ "./src/static/": "static/" });
  eleventyConfig.addWatchTarget("./src/static/");

  eleventyConfig.addPassthroughCopy("./src/_site/robots.txt");

  eleventyConfig.addShortcode("year", () => `${new Date().getFullYear()}`);


  eleventyConfig.addPlugin(syntaxHighlight);

  return {
    dir: {
      input: "src/_site",
      output: "dist",
    },
    markdownTemplateEngine: "njk",
  };
};
