module.exports = function (eleventyConfig) {
  //watch and copy over the bundles css and js
  eleventyConfig.addPassthroughCopy({ "./src/_site/assets": "assets" });
  eleventyConfig.addWatchTarget("./src/_site/assets");

  //copy over all assets
  eleventyConfig.addPassthroughCopy({ "./src/assets/": "assets/images" });
  eleventyConfig.addWatchTarget("./src/assets/");

  //copy over static files
  eleventyConfig.addPassthroughCopy({ "./src/static/": "static/" });
  eleventyConfig.addWatchTarget("./src/static/");

  return {
    dir: {
      input: "src/_site",
      output: "dist",
    },
    markdownTemplateEngine: "njk",
  };
};
