import "@/css/tailwind.css";
import "@/css/Hoges/hoge.css";

export const hoge = () => {
    console.log("hoge");
};

hoge();
setTimeout(() => {
    hoge();
}, 200);
