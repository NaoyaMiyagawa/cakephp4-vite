import "@/css/Hoges/index.css";

let count = 0;
const btn = document.getElementsByClassName("el_btn")[0];

btn.addEventListener("click", (event) => {
  count += 10;
  event.target.innerText = `Count: ${count}`;
});
