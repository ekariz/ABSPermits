function print_window() {
    var e = window;
    e.document.close(), e.focus(), e.print(), e.close()
}! function(e) {
    e(document).ready(function() {
        e(".boxed .fullscreen-bg").length > 0 && e("body").addClass("transparent-page-wrapper"), e(window).load(function() {
            e("body").removeClass("no-trans")
        });
        var o = navigator.platform.toLowerCase();
        0 != o.indexOf("win") && 0 != o.indexOf("linux") || Modernizr.touch || e.browser.webkit && (e.webkitSmoothScroll(), console.log("hello webkit"));
        var t, a = 0;
        (Modernizr.mq("only all and (min-width: 768px)") && !Modernizr.touch || e("html.ie8").length > 0) && e(".main-navigation:not(.onclick) .navbar-nav>li.dropdown, .main-navigation:not(.onclick) li.dropdown>ul>li.dropdown").hover(function() {
            var o = e(this);
            t = setTimeout(function() {
                o.addClass("open").slideDown(), o.find(".dropdown-toggle").addClass("disabled")
            }, a)
        }, function() {
            clearTimeout(t), e(this).removeClass("open"), e(this).find(".dropdown-toggle").removeClass("disabled")
        }), (Modernizr.mq("only all and (max-width: 767px)") || Modernizr.touch || e(".main-navigation.onclick").length > 0) && e(".main-navigation [data-toggle=dropdown], .header-top [data-toggle=dropdown]").on("click", function(o) {
            o.preventDefault(), o.stopPropagation(), e(this).parent().siblings().removeClass("open"), e(this).parent().siblings().find("[data-toggle=dropdown]").parent().removeClass("open"), e(this).parent().toggleClass("open")
        });
        var i;
        if (e(".transparent-header").length > 0 && (e(window).load(function() {
                trHeaderHeight = e("header.header").outerHeight(), e(".transparent-header .tp-bannertimer").css("marginTop", trHeaderHeight + "px")
            }), e(window).resize(function() {
                e(this).scrollTop() < headerTopHeight + headerHeight - 5 && (trHeaderHeight = e("header.header").outerHeight(), e(".transparent-header .tp-bannertimer").css("marginTop", trHeaderHeight + "px"))
            }), e(window).scroll(function() {
                0 == e(this).scrollTop() && (i && window.clearTimeout(i), i = window.setTimeout(function() {
                    trHeaderHeight = e("header.header").outerHeight(), e(".transparent-header .tp-bannertimer").css("marginTop", trHeaderHeight + "px")
                }, 300))
            })), e(".transparent-header .slideshow").length > 0 ? e(".header-container header.header").addClass("transparent-header-on") : e(".header-container header.header").removeClass("transparent-header-on"), e(".transparent-header .slider-banner-fullwidth-big-height").length > 0 && (Modernizr.mq("only all and (max-width: 991px)") ? (e("body").removeClass("transparent-header"), e(".header-container header.header").removeClass("transparent-header-on"), e(".tp-bannertimer").css("marginTop", "0px"), e("body").addClass("slider-banner-fullwidth-big-height-removed")) : (e("body").addClass("transparent-header"), e(".header-container header.header").addClass("transparent-header-on"), e("body").removeClass("slider-banner-fullwidth-big-height-removed"))), (e(".transparent-header .slider-banner-fullwidth-big-height").length > 0 || e(".slider-banner-fullwidth-big-height-removed").length > 0) && e(window).resize(function() {
                Modernizr.mq("only all and (max-width: 991px)") ? (e("body").removeClass("transparent-header"), e(".header-container header.header").removeClass("transparent-header-on"), e(".tp-bannertimer").css("marginTop", "0px")) : (e("body").addClass("transparent-header"), e(".header-container header.header").addClass("transparent-header-on"))
            }), e(".slider-banner-container").length > 0 && (e(".tp-bannertimer").show(), e("body:not(.transparent-header) .slider-banner-container .slider-banner-fullscreen").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 520,
                fullWidth: "off",
                fullScreen: "on",
                fullScreenOffsetContainer: ".header-container",
                fullScreenOffset: "0",
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                spinner: "spinner2",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                hideTimerBar: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".transparent-header .slider-banner-container .slider-banner-fullscreen").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 520,
                fullWidth: "off",
                fullScreen: "on",
                fullScreenOffsetContainer: ".header-top",
                fullScreenOffset: "",
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                spinner: "spinner2",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                hideTimerBar: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".slider-banner-container .slider-banner-fullwidth").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "on",
                spinner: "spinner2",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".slider-banner-container .slider-banner-fullwidth-big-height").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 650,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "on",
                spinner: "spinner2",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".banner:not(.dark-bg) .slider-banner-container .slider-banner-boxedwidth").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "off",
                spinner: "spinner2",
                shadow: 1,
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".banner.dark-bg .slider-banner-container .slider-banner-boxedwidth").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "off",
                spinner: "spinner2",
                shadow: 3,
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".slider-banner-container .slider-banner-boxedwidth-no-shadow").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "off",
                spinner: "spinner2",
                shadow: 0,
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".banner:not(.dark-bg) .slider-banner-container .slider-banner-boxedwidth-stopped").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "off",
                spinner: "spinner2",
                shadow: 1,
                stopLoop: "off",
                stopAfterLoops: 0,
                stopAtSlide: 1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            }), e(".banner.dark-bg .slider-banner-container .slider-banner-boxedwidth-stopped").show().revolution({
                delay: 8e3,
                startwidth: 1140,
                startheight: 450,
                navigationArrows: "solo",
                navigationStyle: "preview2",
                navigationHAlign: "center",
                navigationVAlign: "bottom",
                navigationHOffset: 0,
                navigationVOffset: 20,
                soloArrowLeftHalign: "left",
                soloArrowLeftValign: "center",
                soloArrowLeftHOffset: 0,
                soloArrowLeftVOffset: 0,
                soloArrowRightHalign: "right",
                soloArrowRightValign: "center",
                soloArrowRightHOffset: 0,
                soloArrowRightVOffset: 0,
                fullWidth: "off",
                spinner: "spinner2",
                shadow: 3,
                stopLoop: "off",
                stopAfterLoops: 0,
                stopAtSlide: 1,
                onHoverStop: "off",
                shuffle: "off",
                autoHeight: "off",
                forceFullWidth: "off",
                hideThumbsOnMobile: "off",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "off",
                hideArrowsOnMobile: "off",
                hideThumbsUnderResolution: 0,
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                startWithSlide: 0
            })), e(".owl-carousel").length > 0 && (e(".owl-carousel.carousel").owlCarousel({
                items: 4,
                pagination: !1,
                navigation: !0,
                navigationText: !1
            }), e(".owl-carousel.carousel-autoplay").owlCarousel({
                items: 4,
                autoPlay: 5e3,
                pagination: !1,
                navigation: !0,
                navigationText: !1
            }), e(".owl-carousel.clients").owlCarousel({
                items: 6,
                autoPlay: !0,
                pagination: !1,
                itemsDesktopSmall: [992, 4],
                itemsTablet: [768, 4],
                itemsMobile: [479, 3]
            }), e(".owl-carousel.content-slider").owlCarousel({
                singleItem: !0,
                autoPlay: 5e3,
                navigation: !1,
                navigationText: !1,
                pagination: !1
            }), e(".owl-carousel.content-slider-with-controls").owlCarousel({
                singleItem: !0,
                autoPlay: !1,
                navigation: !0,
                pagination: !0
            }), e(".owl-carousel.content-slider-with-large-controls").owlCarousel({
                singleItem: !0,
                autoPlay: !1,
                navigation: !0,
                pagination: !0
            }), e(".owl-carousel.content-slider-with-controls-autoplay").owlCarousel({
                singleItem: !0,
                autoPlay: 5e3,
                navigation: !0,
                pagination: !0
            }), e(".owl-carousel.content-slider-with-large-controls-autoplay").owlCarousel({
                singleItem: !0,
                autoPlay: 5e3,
                navigation: !0,
                pagination: !0
            }), e(".owl-carousel.content-slider-with-controls-autoplay-hover-stop").owlCarousel({
                singleItem: !0,
                autoPlay: 5e3,
                navigation: !0,
                pagination: !0,
                stopOnHover: !0
            })), headerTopHeight = e(".header-top").outerHeight(), headerHeight = e("header.header.fixed").outerHeight(), e(window).resize(function() {
                e(this).scrollTop() < headerTopHeight + headerHeight - 5 && e(window).width() > 767 && (headerTopHeight = e(".header-top").outerHeight(), headerHeight = e("header.header.fixed").outerHeight())
            }), e(window).scroll(function() {
                e(".header.fixed").length > 0 && !(e(".transparent-header .slideshow").length > 0) ? e(this).scrollTop() > headerTopHeight + headerHeight && e(window).width() > 767 ? (e("body").addClass("fixed-header-on"), e(".header.fixed").addClass("animated object-visible fadeInDown"), e(".header-container").css("paddingBottom", headerHeight + "px")) : (e("body").removeClass("fixed-header-on"), e(".header-container").css("paddingBottom", "0px"), e(".header.fixed").removeClass("animated object-visible fadeInDown")) : e(".header.fixed").length > 0 && (e(this).scrollTop() > headerTopHeight + headerHeight && e(window).width() > 767 ? (e("body").addClass("fixed-header-on"), e(".header.fixed").addClass("animated object-visible fadeInDown")) : (e("body").removeClass("fixed-header-on"), e(".header.fixed").removeClass("animated object-visible fadeInDown")))
            }), e(".graph").length > 0) {
            var n = function() {
                return Math.round(500 * Math.random())
            };
            if (e(".graph.line").length > 0) {
                var r = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "First dataset",
                        fillColor: "rgba(188,188,188,0.2)",
                        strokeColor: "rgba(188,188,188,1)",
                        pointColor: "rgba(188,188,188,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(188,188,188,1)",
                        data: [250, 300, 250, 200, 250, 300, 250]
                    }, {
                        label: "Second dataset",
                        fillColor: "rgba(126,187,205,0.2)",
                        strokeColor: "rgba(126,187,205,1)",
                        pointColor: "rgba(126,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(126,187,205,1)",
                        data: [300, 250, 200, 250, 300, 250, 200]
                    }, {
                        label: "Third dataset",
                        fillColor: "rgba(98,187,205,0.2)",
                        strokeColor: "rgba(98,187,205,1)",
                        pointColor: "rgba(98,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(98,187,205,1)",
                        data: [0, 100, 200, 300, 400, 500, 400]
                    }]
                };
                e(window).load(function() {
                    var e = document.getElementById("lines-graph").getContext("2d");
                    window.newLine = new Chart(e).Line(r, {
                        responsive: !0,
                        bezierCurve: !1
                    })
                })
            }
            if (e(".graph.bar").length > 0) {
                var s = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        fillColor: "rgba(188,188,188,0.5)",
                        strokeColor: "rgba(188,188,188,0.8)",
                        highlightFill: "rgba(188,188,188,0.75)",
                        highlightStroke: "rgba(188,188,188,1)",
                        data: [n(), n(), n(), n(), n(), n(), n()]
                    }, {
                        fillColor: "rgba(168,187,205,0.5)",
                        strokeColor: "rgba(168,187,205,0.8)",
                        highlightFill: "rgba(168,187,205,0.75)",
                        highlightStroke: "rgba(168,187,205,1)",
                        data: [n(), n(), n(), n(), n(), n(), n()]
                    }]
                };
                e(window).load(function() {
                    var e = document.getElementById("bars-graph").getContext("2d");
                    window.myBar = new Chart(e).Bar(s, {
                        responsive: !0
                    })
                })
            }
            if (e(".graph.pie").length > 0) {
                var l = [{
                    value: 120,
                    color: "#09afdf",
                    highlight: "#6BD5F4",
                    label: "Blue"
                }, {
                    value: 120,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Yellow"
                }, {
                    value: 120,
                    color: "#4D5360",
                    highlight: "#616774",
                    label: "Dark Grey"
                }];
                e(window).load(function() {
                    var e = document.getElementById("pie-graph").getContext("2d");
                    window.myPie = new Chart(e).Pie(l)
                })
            }
            if (e(".graph.doughnut").length > 0) {
                var d = [{
                    value: 120,
                    color: "#09afdf",
                    highlight: "#6BD5F4",
                    label: "Blue"
                }, {
                    value: 120,
                    color: "#FDB45C",
                    highlight: "#FFC870",
                    label: "Yellow"
                }, {
                    value: 120,
                    color: "#4D5360",
                    highlight: "#616774",
                    label: "Dark Grey"
                }];
                e(window).load(function() {
                    var e = document.getElementById("doughnut-graph").getContext("2d");
                    window.myDoughnut = new Chart(e).Doughnut(d, {
                        responsive: !0
                    })
                })
            }
        }(e(".popup-img").length > 0 || e(".popup-iframe").length > 0 || e(".popup-img-single").length > 0) && (e(".popup-img").magnificPopup({
            type: "image",
            gallery: {
                enabled: !0
            }
        }), e(".popup-img-single").magnificPopup({
            type: "image",
            gallery: {
                enabled: !1
            }
        }), e(".popup-iframe").magnificPopup({
            disableOn: 700,
            type: "iframe",
            preloader: !1,
            fixedContentPos: !1
        })), e("[data-animation-effect]").length > 0 && e("[data-animation-effect]").each(function() {
            if (Modernizr.csstransitions) {
                e(this).waypoint(function(o) {
                    var t = e(this.element).attr("data-effect-delay"),
                        a = e(this.element);
                    setTimeout(function() {
                        a.addClass("animated object-visible " + a.attr("data-animation-effect"))
                    }, t), this.destroy()
                }, {
                    offset: "90%"
                })
            } else e(this).addClass("object-visible")
        }), e(".text-rotator").length > 0 && e(".text-rotator").each(function() {
            var o = e(this).attr("data-rotator-animation-effect");
            e(this).Morphext({
                animation: "" + o,
                separator: ",",
                speed: 3e3
            })
        }), e(".stats [data-to]").length > 0 && e(".stats [data-to]").each(function() {
            var o = e(this),
                t = o.offset().top;
            e(window).scrollTop() > t - 800 && !o.hasClass("counting") && (o.addClass("counting"), o.countTo()), e(window).scroll(function() {
                e(window).scrollTop() > t - 800 && !o.hasClass("counting") && (o.addClass("counting"), o.countTo())
            })
        }), (e(".isotope-container").length > 0 || e(".masonry-grid").length > 0 || e(".masonry-grid-fitrows").length > 0 || e(".isotope-container-fitrows").length > 0) && (e(window).load(function() {
            e(".masonry-grid").isotope({
                itemSelector: ".masonry-grid-item",
                layoutMode: "masonry"
            }), e(".masonry-grid-fitrows").isotope({
                itemSelector: ".masonry-grid-item",
                layoutMode: "fitRows"
            }), e(".isotope-container").fadeIn();
            var o = e(".isotope-container").isotope({
                itemSelector: ".isotope-item",
                layoutMode: "masonry",
                transitionDuration: "0.6s",
                filter: "*"
            });
            e(".isotope-container-fitrows").fadeIn();
            var t = e(".isotope-container-fitrows").isotope({
                itemSelector: ".isotope-item",
                layoutMode: "fitRows",
                transitionDuration: "0.6s",
                filter: "*"
            });
            e(".filters").on("click", "ul.nav li a", function() {
                var a = e(this).attr("data-filter");
                return e(".filters").find("li.active").removeClass("active"), e(this).parent().addClass("active"), o.isotope({
                    filter: a
                }), t.isotope({
                    filter: a
                }), !1
            })
        }), e('a[data-toggle="tab"]').on("shown.bs.tab", function(o) {
            e(".tab-pane .masonry-grid-fitrows").isotope({
                itemSelector: ".masonry-grid-item",
                layoutMode: "fitRows"
            })
        })), e("[data-animate-width]").length > 0 && e("[data-animate-width]").each(function() {
            (Modernizr.touch || !Modernizr.csstransitions) && e(this).find("span").hide();
            e(this).waypoint(function(o) {
                e(this.element).animate({
                    width: e(this.element).attr("data-animate-width")
                }, 800), this.destroy(), (Modernizr.touch || !Modernizr.csstransitions) && e(this.element).find("span").show("slow")
            }, {
                offset: "90%"
            })
        }), e(".knob").length > 0 && (e(".knob").knob(), e(".knob").each(function() {
            var o = e(this).attr("data-animate-value");
            e(this).animate({
                animatedVal: o
            }, {
                duration: 2e3,
                step: function() {
                    e(this).val(Math.ceil(this.animatedVal)).trigger("change")
                }
            })
        })), e(".video-background").length > 0 && (Modernizr.touch ? e(".video-background").vide({
            mp4: "videos/background-video.mp4",
            webm: "videos/background-video.webm",
            poster: "videos/video-fallback.jpg"
        }, {
            volume: 1,
            playbackRate: 1,
            muted: !0,
            loop: !0,
            autoplay: !0,
            position: "50% 100%",
            posterType: "jpg",
            resizing: !0
        }) : e(".video-background").vide({
            mp4: "videos/background-video.mp4",
            webm: "videos/background-video.webm",
            poster: "videos/video-poster.jpg"
        }, {
            volume: 1,
            playbackRate: 1,
            muted: !0,
            loop: !0,
            autoplay: !0,
            position: "50% 100%",
            posterType: "jpg",
            resizing: !0
        })), e(".video-background-banner").length > 0 && (Modernizr.touch ? e(".video-background-banner").vide({
            mp4: "videos/background-video-banner.mp4",
            webm: "videos/background-video-banner.webm",
            poster: "videos/video-fallback.jpg"
        }, {
            volume: 1,
            playbackRate: 1,
            muted: !0,
            loop: !0,
            autoplay: !0,
            position: "50% 50%",
            posterType: "jpg",
            resizing: !0
        }) : e(".video-background-banner").vide({
            mp4: "videos/background-video-banner.mp4",
            webm: "videos/background-video-banner.webm",
            poster: "videos/video-banner-poster.jpg"
        }, {
            volume: 1,
            playbackRate: 1,
            muted: !0,
            loop: !0,
            autoplay: !0,
            position: "50% 50%",
            posterType: "jpg",
            resizing: !0
        })), e(window).scroll(function() {
            0 != e(this).scrollTop() ? e(".scrollToTop").fadeIn() : e(".scrollToTop").fadeOut()
        }), e(".scrollToTop").click(function() {
            e("body,html").animate({
                scrollTop: 0
            }, 800)
        }), e(".modal").length > 0 && e(".modal").each(function() {
            e(".modal").prependTo("body")
        }), e(".pricing-tables").length > 0 && e(".plan .pt-popover").popover({
            trigger: "hover",
            container: "body"
        }), e("#contact-form").length > 0 && e("#contact-form").validate({
            submitHandler: function(o) {
                e(".submit-button").button("loading"), e.ajax({
                    type: "POST",
                    url: "php/email-sender.php",
                    data: {
                        name: e("#contact-form #name").val(),
                        email: e("#contact-form #email").val(),
                        subject: e("#contact-form #subject").val(),
                        message: e("#contact-form #message").val()
                    },
                    dataType: "json",
                    success: function(o) {
                        "yes" == o.sent ? (e("#MessageSent").removeClass("hidden"), e("#MessageNotSent").addClass("hidden"), e(".submit-button").removeClass("btn-default").addClass("btn-success").prop("value", "Message Sent"), e("#contact-form .form-control").each(function() {
                            e(this).prop("value", "").parent().removeClass("has-success").removeClass("has-error")
                        })) : (e("#MessageNotSent").removeClass("hidden"), e("#MessageSent").addClass("hidden"))
                    }
                })
            },
            errorPlacement: function(e, o) {
                e.insertBefore(o)
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name: {
                    required: !0,
                    minlength: 2
                },
                email: {
                    required: !0,
                    email: !0
                },
                subject: {
                    required: !0
                },
                message: {
                    required: !0,
                    minlength: 10
                }
            },
            messages: {
                name: {
                    required: "Please specify your name",
                    minlength: "Your name must be longer than 2 characters"
                },
                email: {
                    required: "We need your email address to contact you",
                    email: "Please enter a valid email address e.g. name@domain.com"
                },
                subject: {
                    required: "Please enter a subject"
                },
                message: {
                    required: "Please enter a message",
                    minlength: "Your message must be longer than 10 characters"
                }
            },
            errorElement: "span",
            highlight: function(o) {
                e(o).parent().removeClass("has-success").addClass("has-error"), e(o).siblings("label").addClass("hide")
            },
            success: function(o) {
                e(o).parent().removeClass("has-error").addClass("has-success"), e(o).siblings("label").removeClass("hide")
            }
        }), e("#footer-form").length > 0 && e("#footer-form").validate({
            submitHandler: function(o) {
                e(".submit-button").button("loading"), e.ajax({
                    type: "POST",
                    url: "php/email-sender.php",
                    data: {
                        name: e("#footer-form #name2").val(),
                        email: e("#footer-form #email2").val(),
                        subject: "Message from contact form",
                        message: e("#footer-form #message2").val()
                    },
                    dataType: "json",
                    success: function(o) {
                        "yes" == o.sent ? (e("#MessageSent2").removeClass("hidden"), e("#MessageNotSent2").addClass("hidden"), e(".submit-button").removeClass("btn-default").addClass("btn-success").prop("value", "Message Sent"), e("#footer-form .form-control").each(function() {
                            e(this).prop("value", "").parent().removeClass("has-success").removeClass("has-error")
                        })) : (e("#MessageNotSent2").removeClass("hidden"), e("#MessageSent2").addClass("hidden"))
                    }
                })
            },
            errorPlacement: function(e, o) {
                e.insertAfter(o)
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name2: {
                    required: !0,
                    minlength: 2
                },
                email2: {
                    required: !0,
                    email: !0
                },
                message2: {
                    required: !0,
                    minlength: 10
                }
            },
            messages: {
                name2: {
                    required: "Please specify your name",
                    minlength: "Your name must be longer than 2 characters"
                },
                email2: {
                    required: "We need your email address to contact you",
                    email: "Please enter a valid email address e.g. name@domain.com"
                },
                message2: {
                    required: "Please enter a message",
                    minlength: "Your message must be longer than 10 characters"
                }
            },
            errorElement: "span",
            highlight: function(o) {
                e(o).parent().removeClass("has-success").addClass("has-error"), e(o).siblings("label").addClass("hide")
            },
            success: function(o) {
                e(o).parent().removeClass("has-error").addClass("has-success"), e(o).siblings("label").removeClass("hide")
            }
        }), e("#sidebar-form").length > 0 && e("#sidebar-form").validate({
            submitHandler: function(o) {
                e(".submit-button").button("loading"), e.ajax({
                    type: "POST",
                    url: "php/email-sender.php",
                    data: {
                        name: e("#sidebar-form #name3").val(),
                        email: e("#sidebar-form #email3").val(),
                        subject: "Message from FAQ page",
                        category: e("#sidebar-form #category").val(),
                        message: e("#sidebar-form #message3").val()
                    },
                    dataType: "json",
                    success: function(o) {
                        "yes" == o.sent ? (e("#MessageSent3").removeClass("hidden"), e("#MessageNotSent3").addClass("hidden"), e(".submit-button").removeClass("btn-default").addClass("btn-success").prop("value", "Message Sent"), e("#sidebar-form .form-control").each(function() {
                            e(this).prop("value", "").parent().removeClass("has-success").removeClass("has-error")
                        })) : (e("#MessageNotSent3").removeClass("hidden"), e("#MessageSent3").addClass("hidden"))
                    }
                })
            },
            errorPlacement: function(e, o) {
                e.insertAfter(o)
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name3: {
                    required: !0,
                    minlength: 2
                },
                email3: {
                    required: !0,
                    email: !0
                },
                message3: {
                    required: !0,
                    minlength: 10
                }
            },
            messages: {
                name3: {
                    required: "Please specify your name",
                    minlength: "Your name must be longer than 2 characters"
                },
                email3: {
                    required: "We need your email address to contact you",
                    email: "Please enter a valid email address e.g. name@domain.com"
                },
                message3: {
                    required: "Please enter a message",
                    minlength: "Your message must be longer than 10 characters"
                }
            },
            errorElement: "span",
            highlight: function(o) {
                e(o).parent().removeClass("has-success").addClass("has-error")
            },
            success: function(o) {
                e(o).parent().removeClass("has-error").addClass("has-success")
            }
        }), e("#rsvp").length > 0 && e("#rsvp").validate({
            submitHandler: function(o) {
                e(".submit-button").button("loading"), e.ajax({
                    type: "POST",
                    url: "php/email-sender.php",
                    data: {
                        name: e("#rsvp #name").val(),
                        email: e("#rsvp #email").val(),
                        guests: e("#rsvp #guests").val(),
                        subject: "RSVP",
                        events: e("#rsvp #events").val()
                    },
                    dataType: "json",
                    success: function(o) {
                        "yes" == o.sent ? (e("#MessageSent").removeClass("hidden"), e("#MessageNotSent").addClass("hidden"), e(".submit-button").removeClass("btn-default").addClass("btn-success").prop("value", "Message Sent"), e("#rsvp .form-control").each(function() {
                            e(this).prop("value", "").parent().removeClass("has-success").removeClass("has-error")
                        })) : (e("#MessageNotSent").removeClass("hidden"), e("#MessageSent").addClass("hidden"))
                    }
                })
            },
            errorPlacement: function(e, o) {
                e.insertAfter(o)
            },
            onkeyup: !1,
            onclick: !1,
            rules: {
                name: {
                    required: !0,
                    minlength: 2
                },
                email: {
                    required: !0,
                    email: !0
                },
                guests: {
                    required: !0
                },
                events: {
                    required: !0
                }
            },
            messages: {
                name: {
                    required: "Please specify your name",
                    minlength: "Your name must be longer than 2 characters"
                },
                email: {
                    required: "We need your email address to contact you",
                    email: "Please enter a valid email address e.g. name@domain.com"
                }
            },
            errorElement: "span",
            highlight: function(o) {
                e(o).parent().removeClass("has-success").addClass("has-error"), e(o).siblings("label").addClass("hide")
            },
            success: function(o) {
                e(o).parent().removeClass("has-error").addClass("has-success"), e(o).siblings("label").removeClass("hide")
            }
        }), e(".affix-menu").length > 0 && setTimeout(function() {
            var o = e(".sidebar");
            o.affix({
                offset: {
                    top: function() {
                        var e = o.offset().top;
                        return this.top = e - 65
                    },
                    bottom: function() {
                        var o = e(".footer").outerHeight(!0) + e(".subfooter").outerHeight(!0);
                        return e(".footer-top").length > 0 && (o += e(".footer-top").outerHeight(!0)), this.bottom = o + 50
                    }
                }
            })
        }, 100), e(".scrollspy").length > 0 && (e("body").addClass("scroll-spy"), e("body").scrollspy(e(".fixed.header").length > 0 ? {
            target: ".scrollspy",
            offset: 85
        } : {
            target: ".scrollspy",
            offset: 20
        })), e(".smooth-scroll").length > 0 && e(".smooth-scroll a[href*=#]:not([href=#]), a[href*=#]:not([href=#]).smooth-scroll").click(e(".header.fixed").length > 0 && Modernizr.mq("only all and (min-width: 768px)") ? function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var o = e(this.hash);
                if (o = o.length ? o : e("[name=" + this.hash.slice(1) + "]"), o.length) return e("html,body").animate({
                    scrollTop: o.offset().top - 64
                }, 1e3), !1
            }
        } : function() {
            if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
                var o = e(this.hash);
                if (o = o.length ? o : e("[name=" + this.hash.slice(1) + "]"), o.length) return e("html,body").animate({
                    scrollTop: o.offset().top
                }, 1e3), !1
            }
        }), e("#offcanvas").length > 0 && e("#offcanvas").offcanvas({
            canvas: "body",
            disableScrolling: !1,
            toggle: !1
        }), e("#offcanvas").length > 0 && e("#offcanvas [data-toggle=dropdown]").on("click", function(o) {
            o.preventDefault(), o.stopPropagation(), e(this).parent().siblings().removeClass("open"), e(this).parent().siblings().find("[data-toggle=dropdown]").parent().removeClass("open"), e(this).parent().toggleClass("open")
        }), e(".parallax").length > 0 && !Modernizr.touch && e(".parallax").parallax("50%", .2), e(".parallax-2").length > 0 && !Modernizr.touch && e(".parallax-2").parallax("50%", .3), e(".parallax-3").length > 0 && !Modernizr.touch && e(".parallax-3").parallax("50%", .4), e(".main-navigation.onclick").length > 0 && !Modernizr.touch && e.notify({
            message: 'The Dropdowns of the Main Menu, are now open with click on Parent Items. Click "Home" to checkout this behavior.'
        }, {
            type: "info",
            delay: 1e4,
            offset: {
                y: 150,
                x: 20
            }
        }), e(".main-navigation.animated").length > 0 || Modernizr.touch || !(e(".main-navigation").length > 0) || e.notify({
            message: "The animations of main menu are disabled."
        }, {
            type: "info",
            delay: 1e4,
            offset: {
                y: 150,
                x: 20
            }
        }), e(".btn-alert").length > 0 && e(".btn-alert").on("click", function(o) {
            return e.notify({
                message: "Great! you have just created this message :-) you can configure this into the template.js file"
            }, {
                type: "info",
                delay: 4e3,
                offset: {
                    y: 100,
                    x: 20
                }
            }), !1
        }), e(".btn-remove").click(function() {
            e(this).closest(".remove-data").remove()
        }), e("#shipping-info-check").is(":checked") && e("#shipping-information").hide(), e("#shipping-info-check").change(function() {
            e(this).is(":checked"), e("#shipping-information").slideToggle()
        }), e(".full-image-overlay").length > 0 && (overlayHeight = e(".full-image-overlay").outerHeight(), e(".full-image-overlay").css("marginTop", -overlayHeight / 2)), e(".header-top .dropdown-menu input").click(function(e) {
            e.stopPropagation()
        })
    })
}(this.jQuery), jQuery(".btn-print").length > 0,
    function(e, o, t, a, i, n, r) {
        e.GoogleAnalyticsObject = i, e[i] = e[i] || function() {
            (e[i].q = e[i].q || []).push(arguments)
        }, e[i].l = 1 * new Date, n = o.createElement(t), r = o.getElementsByTagName(t)[0], n.async = 1, n.src = a, r.parentNode.insertBefore(n, r)
    };
