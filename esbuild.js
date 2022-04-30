const esbuild = require("esbuild");
const { sassPlugin } = require("esbuild-sass-plugin");

/////////////////
//Process ARGS!!
const args = Object.fromEntries(
  process.argv
    .slice(2)
    .map((arg) => {
      let [command, value] = arg.split("=");
      command = command.replace("--", "");
      return [command, value];
    })
    .filter((a) => a[0] && a[1])
);

const entries = ["src/js/main.js", "src/js/themer.js"];
const outDir = args["outDir"] ?? "./src/_site/assets";

esbuild.build({
  entryPoints: entries,
  // format: "iife",
  bundle: true,
  minify: true,
  outdir: outDir,
  sourcemap: process.argv.includes("--watch"),
  external: ["*.svg", "*.woff", "*.otf", "*.ttf", "*.css", "*.jpg", "*.png", "*.webp", "*.gif", "*.mp4"],
  watch: process.argv.includes("--watch"),
  plugins: [
    sassPlugin({
      cache: process.argv.includes("--watch"),
    }),
  ],
});
