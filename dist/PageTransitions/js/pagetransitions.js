var PageTransitions = (function () {

    var $main = function () {
            return $('#pt-main')
        },
        $pages = function () {
            return $main().children('div.pt-page')
        },
        pagesCount = $pages().length,
        current = 0,
        isAnimating = false,
        endCurrPage = false,
        endNextPage = false,
        animEndEventNames = {
            'WebkitAnimation': 'webkitAnimationEnd',
            'OAnimation': 'oAnimationEnd',
            'msAnimation': 'MSAnimationEnd',
            'animation': 'animationend'
        },
        animEndEventName = animEndEventNames[ Modernizr.prefixed('animation') ],
        support = Modernizr.cssanimations;

    function init() {
        $pages().each(function () {
            var $page = $(this);
            $page.data('originalClassList', $page.attr('class'));
        });

        $pages().eq(current).addClass('pt-page-current');
    }

    function nextPage(options) {
        var animation = (options.animation) ? options.animation : options;

        if (isAnimating) {
            return false;
        }
        isAnimating = true;

        var $currPage = $pages().eq(current);

        current = 1;

        var $nextPage = $pages().eq(current).addClass('pt-page-current');

        var outClass = '', inClass = '';

        switch (animation) {
            case 1:
                outClass = 'pt-page-moveToLeft';
                inClass = 'pt-page-moveFromRight';
                break;
            case 2:
                outClass = 'pt-page-moveToRight';
                inClass = 'pt-page-moveFromLeft';
                break;
        }

        console.log($currPage);
        $currPage.addClass(outClass).on(animEndEventName, function () {
            $currPage.off(animEndEventName);
            endCurrPage = true;
            if (endNextPage) {
                onEndAnimation($currPage, $nextPage);
            }
        });
        $nextPage.addClass(inClass).on(animEndEventName, function () {
            $nextPage.off(animEndEventName);
            endNextPage = true;
            if (endCurrPage) {
                onEndAnimation($currPage, $nextPage);
            }
        });

        if (!support) {
            onEndAnimation($currPage, $nextPage);
        }

    }

    function onEndAnimation($outpage, $inpage) {
        endCurrPage = false;
        endNextPage = false;
        resetPage($outpage, $inpage);
        isAnimating = false;

    }

    function resetPage($outpage, $inpage) {
        // console.log($outpage.data('originalClassList'));
        //$outpage.attr('class', 'pt-page');
        $outpage.remove();
        $inpage.attr('class', 'pt-page pt-page-current');


        current = 0;
    }

    init();

    return {
        init: init,
        nextPage: nextPage
    };

})();