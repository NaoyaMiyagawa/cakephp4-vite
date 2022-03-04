import { defineConfig } from "vite";
import path from "path";
import glob from "glob";
import liveReload from "vite-plugin-live-reload";
import vue from "@vitejs/plugin-vue";

// entrypoints to bundle
const entries = {};
// input dir
const srcDir = "./resources/js";
// output dir
const distDir = `./webroot/js`;

// register entrypoints
const srcFileKeys = glob.sync("**/*.+(js|ts)", { cwd: srcDir });
srcFileKeys.map((key) => {
  const srcFilepath = path.join(srcDir, key);
  entries[key] = srcFilepath;
});

export default defineConfig({
  plugins: [
    //
    vue(),
    liveReload(["./templates/**/*.php"]),
  ],
  build: {
    outDir: distDir,
    emptyOutDir: true,
    assetsDir: "",
    manifest: true,
    rollupOptions: {
      input: entries,
    },
  },
  resolve: {
    alias: {
      "@": "/resources",
    },
  },
});
