import "@/css/tailwind.css";
import "@/css/Hoges/hoge.scss";
import { createApp } from "vue";
import App from "./App.vue";

export const hoge = () => {
  console.log(`hoge ${count}`);
};

let count = 0;
setInterval(() => {
  hoge();
  count++;
}, 1000);

const app = createApp(App);
app.mount("#app");
