import "@/css/tailwind.css";
import "@/css/Hoges/hoge.scss";

export const hoge = () => {
    console.log(`hoge ${count}`);
};

let count = 0;
setInterval(() => {
    hoge();
    count++;
}, 1000);
