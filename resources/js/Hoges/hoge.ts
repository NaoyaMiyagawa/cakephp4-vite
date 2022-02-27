// import "@/css/tailwind.css";
import "@/css/Hoges/hoge.css";

export const hoge = () => {
    console.log(`hoge ${count}`);
};

let count = 0;
setInterval(() => {
    hoge();
    count++;
}, 1000);
