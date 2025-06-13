document.addEventListener('DOMContentLoaded', function() {
    // Меню для мобильных устройств
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '☰';
    
    const header = document.querySelector('.header .container');
    const nav = document.querySelector('.main-nav');
    
    if (window.innerWidth < 768) {
        header.prepend(menuToggle);
        nav.style.display = 'none';
        
        menuToggle.addEventListener('click', function() {
            nav.style.display = nav.style.display === 'none' ? 'block' : 'none';
        });
    }
    
    // Обработка изменения размера окна
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            nav.style.display = '';
            if (document.querySelector('.menu-toggle')) {
                document.querySelector('.menu-toggle').remove();
            }
        } else {
            if (!document.querySelector('.menu-toggle')) {
                header.prepend(menuToggle);
                nav.style.display = 'none';
            }
        }
    });
});