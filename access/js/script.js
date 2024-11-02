document.addEventListener("DOMContentLoaded", function() {
    const imageRow = document.querySelector(".image-row");
    const images = document.querySelectorAll(".image-row img");

    let currentIndex = 0;

    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        const translateValue = `translateX(${-currentIndex * 100}%)`;
        imageRow.style.transform = translateValue;
    }, 3000); // Chuyển ảnh sau mỗi 3 giây
});
