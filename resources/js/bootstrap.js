window._ = require('lodash');
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.swal = require('sweetalert2');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

require('bootstrap');

$(() => {
    const scrollThreshold = 330;
    const navbar = $('.navbar');
    const checkScrollAndApplyClasses = () => {
        const scrollTop = $(document).scrollTop();
        if (scrollTop > scrollThreshold) {
            navbar.addClass('on-scroll');
            navbar.removeClass('on-top');
        } else {
            navbar.addClass('on-top');
            navbar.removeClass('on-scroll');
        }
    };

    checkScrollAndApplyClasses();

    $(document).on('scroll', () => {
        checkScrollAndApplyClasses();
    });
})
