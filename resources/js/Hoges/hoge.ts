import "@/css/tailwind.css";
import "@/css/Hoges/hoge.css";
// import "virtual:windi.css";

export const hoge = () => {
    console.log("hoge");
};

hoge();
setTimeout(() => {
    hoge();
}, 300);