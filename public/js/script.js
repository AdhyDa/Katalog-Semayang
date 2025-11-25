document.addEventListener("DOMContentLoaded", () => {
    let index = 0;
    const items = document.querySelectorAll(".testimonial");

    setInterval(() => {
        items[index].classList.remove("active");
        index = (index + 1) % items.length;
        items[index].classList.add("active");
    }, 3000);
});
