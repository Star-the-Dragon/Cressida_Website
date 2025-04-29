document.addEventListener('DOMContentLoaded', (event) => {
    let currentIndex = 0;

    // Получаем все изображения слайдера
    const slides = document.querySelectorAll('.slider img');
    const totalSlides = slides.length;

    // Функция для перехода к следующему слайду
    function nextSlide() {
        currentIndex++;
        if (currentIndex >= totalSlides) {
            currentIndex = 0; // Если достигли последнего, возвращаемся к первому
        }
        updateSliderPosition();
    }

    // Функция для перехода к предыдущему слайду
    function prevSlide() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = totalSlides - 1; // Если достигли первого, возвращаемся к последнему
        }
        updateSliderPosition();
    }

    // Обновление позиции слайдера
    function updateSliderPosition() {
        const slider = document.querySelector('.slider-images');
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(nextSlide, 10000);

    //Добавляем обработчики событий для кнопок
    document.querySelector('.prev').addEventListener('click', prevSlide);
    document.querySelector('.next').addEventListener('click', nextSlide);
});
