function MobileMenu(options) {

    //set defaults
    options = extend({
        MenuContainer: "mobile-menu-container", // the css class that will be added to the responsive menu container
        MenuSelector: "menu", // the css class of the menu containers
        CloseMarkup: "<span></span><span></span><span></span>", // text/markup that is displayed when the menu is open
        CloseMessage: "Hide Navigation", // the title attribute text for the close navigation button
        OpenMarkup: "<span></span><span></span><span></span>", // text/markup that is displayed when the menu is closed
        OpenMessage: "Show Navigation", // the title attribute text for the open navigation button
        TriggerWidth: "767", // the screen width below which the menu will be triggered
    }, options || {});

    var isMobile = false;
    var menuOpen = false;
    var currentWidth = $(window).width();

    //check for mobile usage
    if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i)) || (navigator.userAgent.match(/Android/i)) || (navigator.userAgent.match(/Blackberry/i)) || (navigator.userAgent.match(/Windows Phone/i))) {
        isMobile = true;
    }

    //trigger menu on mobile browsers
    if (isMobile) {
        mobileMenuTrigger();
    }

    //bind mobile menu trigger to window resize event
    $(window).resize(function () {
        currentWidth = $(window).width();
        mobileMenuTrigger();
    });

    //triggers the mobile menu
    function mobileMenuTrigger() {
        if (currentWidth <= options.TriggerWidth) {
            showMobileMenu();
        }
        else {
            hideMobileMenu();
        }
    }

    //shows the mobile menu
    function showMobileMenu() {
        if (menuOpen == false) {

            $('body').prepend('<div class="' + options.MenuContainer + '"><div class="mobile-menu-toggle"><a href="#" title="' + options.OpenMessage + '">' + options.OpenMarkup + '</a></div><div class="mobile-menu"></div></div>');

            $('.' + options.MenuSelector + '').each(function () {
                var contents = $(this).html();
                $('.' + options.MenuContainer + ' .mobile-menu').append(contents);
            });

            //close the menu
            $('.' + options.MenuContainer + ' .mobile-menu').hide();

            //set click function to toggle menu
            $(".mobile-menu-toggle a").click(function () {
                if ($('.' + options.MenuContainer + ' .mobile-menu').css('display') == 'none') {
                    $(this).html(options.CloseMarkup);
                    $(this).attr('title', options.CloseMessage);
                    $('.' + options.MenuContainer + ' .mobile-menu').slideDown();
                }
                else {
                    $(this).html(options.OpenMarkup);
                    $(this).attr('title', options.OpenMessage);
                    $('.' + options.MenuContainer + ' .mobile-menu').slideUp();
                }
            });

            menuOpen = true;
        }
    }

    //hides the mobile menu
    function hideMobileMenu() {
        if (menuOpen) {
            $('.' + options.MenuContainer + '').remove();
            menuOpen = false;
        }
    }
}
//extend properties
function extend(a, b) {
    for (var prop in b) {
        a[prop] = b[prop];
    }
    return a;
}