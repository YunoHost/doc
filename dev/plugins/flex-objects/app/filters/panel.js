const toggle = document.querySelector('.filters-bar .adv-options');
const panel = document.querySelector('.filters-advanced');

if (toggle && panel) {
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('adv-options') || event.target.closest('.adv-options')) {
            event.preventDefault();
            const isOpen = toggle.classList.contains('open');

            panel.classList.toggle('hide');
            toggle.classList.remove(isOpen ? 'open' : 'close');
            toggle.classList.add(isOpen ? 'close' : 'open');
        }
    });
}
