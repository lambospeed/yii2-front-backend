$(document).ready(function () {
    $('.js-star-rating').starRating({
        activeColor: '#ffb430',
        emptyColor: '#dfdfdf',
        starSize: 18,
        useGradient: false,
        hoverColor: '#ff7f30'
    });

    $('.hide-description__btn').first().toggleClass('closed-v--blue');
    $('.hide-description__btn').first().toggleClass('opened-v--blue');
    $('.hide-description__btn').first().text('Hide details');


    $('.js-open-sibling').on('click', function () {
        var current = $(this);
        current.siblings('p').slideToggle();
        current.toggleClass('opened');
        current.toggleClass('closed');
    });

    $('.js-hide-description').on('click', function () {
        var current = $(this);
        if (current.text() == "Show details") {
            current.text("Hide details")
        } else {
            current.text("Show details")
        }
        current.siblings('.score-list').slideToggle();
        current.toggleClass('opened-v--blue');
        current.toggleClass('closed-v--blue');

    });

    $('.hamburger').on('click', function () {
        $(this).toggleClass('is-active');
        $('.main-nav').slideToggle();
    });

    $('.js-open-popup').on('click', function () {
        $('.disclaimer>div').toggle();

    });

    $('.cookie-law__button').on('click', function () {
        $.ajax(
            '/cookies-law/got-it/',
            {
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var $cookie_law = $('.cookie-law');
                    if (response.response) {
                        $cookie_law.addClass('hidden');
                    } else {
                        $cookie_law.removeClass('hidden');
                    }
                }
            }
        );
    });

    $('.google-tracking-conversion').on('click', function() {
        goog_report_conversion($(this).attr("href"));
    });

    $('.table-row-button').on('click', function () {
        var url = $(this).data('tracking-url');
        goog_report_conversion(url);
    });

    var disqus_loaded = false;
    var load_disqus = function () {
        disqus_loaded = true;
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = "https://truedefense.disqus.com/embed.js";
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        var ldr = document.getElementById('disqus_loader');
        ldr.parentNode.removeChild(ldr);
    };

    $(window).on('scroll', function () {
        if (
            (window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 1500)
            && (disqus_loaded === false)
        ) {
            load_disqus()
        }
    });

    $.ajax(
        '/cookies-law/get-state/',
        {
            type: "GET",
            dataType: "json",
            success: function (response) {
                var $cookie_law = $('.cookie-law');
                if (response.response) {
                    $cookie_law.addClass('hidden');
                } else {
                    $cookie_law.removeClass('hidden');
                }
            }
        }
    );
});
