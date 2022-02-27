import { defineConfig } from "vite";
import path from "path";
import glob from "glob";

// entrypoints to bundle
const entries = {};
// input dir
const srcDir = "./resources/js";
// output dir
const distDir = `./webroot/js`;

const targetPaths = glob.sync("**/*.+(js|ts)", { cwd: srcDir });
targetPaths.map((key) => {
    const srcFilepath = path.join(srcDir, key);
    // replace path for typescript
    const distFilepath = key.replace(/.ts$/, "");
    // register entrypoint
    entries[distFilepath] = srcFilepath;
});

console.log("🚀 > entries", entries);

export default defineConfig({
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
