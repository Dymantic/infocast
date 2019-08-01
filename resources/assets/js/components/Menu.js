export default class Menu {

    constructor() {
        this.main = document.querySelector('.main-nav');
        this.menu = document.querySelector('.main-nav');
        this.trigger = document.querySelector('.main-nav');
        this.is_open = false;
    }

    init() {
        this.trigger.addEventListener('click', () => this.toggleMenu());
    }

    toggleMenu() {
        if(this.is_open) {
            this.main.classList.remove('show');
        } else {
            this.main.classList.add('show');
        }

        this.is_open = !this.is_open;
    }
}