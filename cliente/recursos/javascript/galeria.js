document.addEventListener("DOMContentLoaded", () => {

    const galleryImages = document.querySelectorAll(".gallery-image .img-box img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const closeBtn = document.querySelector(".close");
    const nextBtn = document.querySelector(".next");
    const prevBtn = document.querySelector(".prev");

    let currentIndex = 0;

    // Abre ao clicar em uma imagem
    galleryImages.forEach((img, index) => {
        img.addEventListener("click", () => {
            currentIndex = index;
            showImage();
            lightbox.style.display = "block";
        });
    });

    function showImage() {
        lightboxImg.src = galleryImages[currentIndex].getAttribute("src");
    }

    nextBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        currentIndex = (currentIndex + 1) % galleryImages.length;
        showImage();
    });

    prevBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        showImage();
    });

    closeBtn.addEventListener("click", () => {
        lightbox.style.display = "none";
    });

    // Fechar ao clicar fora
    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            lightbox.style.display = "none";
        }
    });

});
