(($) => {
    const doc = $(document);
    const win = $(window);
    const wp_ajaxurl = ajaxObject.ajaxurl;
    const wp_siteurl = ajaxObject.siteurl;
    let lenis;

    doc.on("ready", () => {
        $('#global_search_wrap').hide();
        // Local variabls
        let keyUpdated;
        // Initialize Lenis
        lenis = new Lenis({
            autoRaf: true,
	        prevent: (node) => node.id === "search_results_wrap"
        });
        lenis.on('scroll', (e) => {
        });
        function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
        // Search
        document.addEventListener('keyup', doc_keyUp, false);
        $('.global_search_link a').on("click", (e) => {
            e.preventDefault();
            openSearch();
            return false;
        });
        $('#global_search_wrap_bg').on("click", () => {
            closeSearch();
        });
        $('#global_search_input').on("keyup", (e) => {
            $('.search_loader').addClass("show");
            clearTimeout(keyUpdated);
            keyUpdated = setTimeout(async () => {
                $("#search_results").html("");
                let value = e.target.value;
                const form = new FormData();
                form.append('action', 'getSearchData');
                form.append('search_val', value);
                const params = new URLSearchParams(form);
                try {
                    const response = await fetch(wp_ajaxurl, {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Cache-Control': 'no-cache',
                        },
                        body: params     
                    });
                    if (!response.ok) {
                        throw new Error(`Response status: ${response.status}`);
                      }
                    const json = await response.json();
                    if ( json.length > 0 ) {
                        for(let i = 0; i < 6; i++) {
                            $("#search_results").append(
                                '<div class="postResults"><h3>' + json[i].post_title.substring(0,20) + '....</h3><a href="' + json[i].guid + '">View</a></div>'
                            );
                        }
                    } else {
                        $("#search_results").append(
                            '<div class="postResults"><p>We could not find anything matching your search.</p></div>'
                        );
                    }
                } catch (error) {
                    console.error(error.message);
                } finally {
                    $('.search_loader').removeClass("show");
                }
            }, 1000)
        });
        // Blog page
        $('#blog_cats a').on("click", (e) => {
            e.preventDefault();
            let category = $(e.target).attr("data-catid");
            $(e.target).addClass("current_blog_item").parent().siblings().find('a').removeClass("current_blog_item");
            fetchBlogData($('#blog_content_wrap'), category);
            return false;
        });
        // contact page
        $('.ef3_contact_form').on('submit', (e)=> {
            let dataElem = $(e.target).find('.ef3_contact_fields');
            let dataElemScontrol = $(e.target).find('.ef3_contact_fields_scontrol');
            let formData = $(e.target)
            let dataArr = [];
            let spamFilter = [];

            dataElem.each((i)=> {
                let elem = $(dataElem[i]).val();
                if ( elem == "" || elem == null ) {
                    dataArr.push("error");
                    $(dataElem[i]).addClass("errored");
                }
            });

            dataElemScontrol.each((i)=> {
                let elem = $(dataElemScontrol[i]).val();
                if ( elem != "" && elem != null ) {
                    spamFilter.push("error");
                }
            });

            if ( spamFilter.length > 0 ) {
                alert("Do not pass go, do not collect $200!");
                return false;
            }

            if ( dataArr.length > 0 ) {
                return false;
            } else {
                sendMail(formData);
            }

            return false;
        });
        // Mobile Menu
        $('.openMobileMenu a').on("click", (e) => {
            e.preventDefault();
            $('#mobile_menu').addClass("opened");
            gsap.to("#mobile_menu li",
                { 
                    opacity : 1,
                    width : '100%',
                    stagger: 0.15,
                    duration: 0.5,
                    delay : 0.35
                }
            );
            return false;
        });
        $('#close_mobile_menu').on("click", (e) => {
            e.preventDefault();
            gsap.to("#mobile_menu li",
                { 
                    opacity : 0,
                    width : '0%',
                    stagger: 0.15,
                    duration: 0.5,
                    delay : 0.35,
                    onComplete: () => {
                        $('#mobile_menu').removeClass("opened");
                    }
                }
            );
            return false;
        });
    });

    win.on("load", () => {
        // Blog page
        if ( $('#blog_content_wrap').length > 0 ) {
            fetchBlogData($('#blog_content_wrap'), "all");
        }
        if( $('.ef3_landing_block_image_right').length > 0 ) {
            gsap.set('.ef3_landing_block_image_right', { scale : 0.9 });
        }
        gsap.set('.animationTargets', { y : -50, opacity : 0, filter : "blur(4px)" });
        init();
    });
    
    win.on("scroll", () => {
        let pos = win.scrollTop();
        if ( pos > 100 ) {
            $('#mainSiteNav').addClass("scrolled");
        } else {
            $('#mainSiteNav').removeClass("scrolled");
        }
    });

    const init = () => {
        const siteLoader = $('#siteLoader');
        if ( siteLoader.length > 0 ) {
            var tl = new TimelineLite();
            tl.to(".tp4", 3, {strokeDashoffset:"0"});
            tl.to(".tp4", 0.2, {fillOpacity:1}, "-=1.5");
            tl.to(siteLoader, 0.5, { opacity: 0, onComplete: () => {
                siteLoader.css({ display : 'none' });
                loadAnimations();
            }})
        } else {
            loadAnimations();
        }
    }

    // listen for escape
    let doc_keyUp = (e) => {
        if (e.key === "Escape") {
            closeSearch();
        }
    }

    const loadAnimations = () => {
        gsap.registerPlugin(ScrollTrigger);
        gsap.registerPlugin(Draggable);
        gsap.to('#mainSiteNav .animationTargets', { y : 0, opacity : 1, filter : "blur(0px)", stagger : 0.1 });
        // Landing
        if ( $('.ef3_landing_block').length > 0 ) {
            gsap.to('.ef3_landing_block_image_right',
                { 
                    scrollTrigger: {
                        trigger: '.ef3_landing_block',
                        start: '-100px top',
                    },
                    opacity : 1, scale : 1, duration : 1
                }
            );
            gsap.to('.ef3_landing_block h2 span',
                { 
                    scrollTrigger: {
                        trigger: '.ef3_landing_block',
                        start: '-100px top',
                    },
                    opacity : 1, duration : 1, delay : 0.5, stagger : 0.2
                }
            );
            gsap.to('.ef3_landing_block h3, .ef3_landing_block .ef3_buttons',
                { 
                    scrollTrigger: {
                        trigger: '.ef3_landing_block',
                        start: '-100px top',
                    },
                    opacity : 1, duration : 1, delay : 1.5
                }
            );
        }
        // Video block
        if ( $('.ef3_video_block').length > 0 ) {
            gsap.utils.toArray(".ef3_video_block .ef3_video_block_bg").forEach(section => {
                gsap.to(section,
                    { 
                        scrollTrigger: {
                            trigger: $(section).parent(),
                            start: 'top top+=700px',
                            end : 'bottom bottom-=200px',
                            scrub: 1,
                        },
                        left : 0, right : 0
                    }
                );
            });
        }
        // Testimonials
        if ( $('.ef3_testimonials_block').length > 0 ) {
            Draggable.create(".ef3_testimonials_block_testimonials", {
                type: "x",
                bounds: ".ef3_testimonials_block_content",
                inertia: true,
            });
            gsap.set('.mouseFriend', { scale : 0.3 });
            $('.ef3_testimonials_block_content').on("mousemove", (event) => {
                gsap.to('.mouseFriend',
                    { 
                        x : event.clientX - 50,
                        y : event.clientY - 50
                    }
                );
            });
            $('.ef3_testimonials_block_content').on("mouseleave", (event) => {
                gsap.to('.mouseFriend',
                    { 
                        opacity : 0,
                        scale : 0.3
                    }
                );
            });
            $('.ef3_testimonials_block_content').on("mouseover", (event) => {
                gsap.to('.mouseFriend',
                    { 
                        opacity : 1,
                        scale : 1
                    }
                );
            });
        }
        // client stories
        if ( $('#client_stories_wrap').length > 0 ) {
            $('body').css({ 'overflow-x' : 'hidden' });
            let clientStories = $('.client_stories');
            let scrollerW = 700 * clientStories.length;
            let scrollNum = scrollerW - (800 * 2);
            $('#client_stories_scroller').css({ width: scrollerW + 'px' });
            $('#client_stories_inner').css({ height : scrollerW + 'px' });
            gsap.to('#client_stories_scroller',
                { 
                    scrollTrigger: {
                        trigger: '#client_stories_inner',
                        start: 'top top',
                        end: 'bottom bottom',
                        scrub: 1,
                    },
                    x: `-${scrollNum}px`
                }
            );
        }
    }

    const closeSearch = () => {
        $('#global_search_wrap').fadeOut(500);
        $("#search_results").html("");
        lenis.start();
        $('body').css({
            'overflow-y' : 'auto'
        })
    }

    const openSearch = () => {
        $('#global_search_wrap').fadeIn(500);
        lenis.stop();
        $('body').css({
            'overflow-y' : 'hidden'
        })
    }

    const fetchBlogData = async (elem, cat) => {
        elem.fadeOut(500, async () => {
            elem.html("");
            const form = new FormData();
            form.append('action', 'getBlogData');
            form.append('search_val', cat);
            const params = new URLSearchParams(form);
            try {
                const response = await fetch(wp_ajaxurl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Cache-Control': 'no-cache',
                    },
                    body: params     
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const json = await response.json();
                    for(let i = 0; i < json.length; i++) {
                        const theDate = new Date(json[i].post_date);
                        console.log(json[i]);
                        elem.append(
                            '<div class="postResults"><a href="' + wp_siteurl + '/' + json[i].post_name + '">' +
                            '<div class="postResultscontent"><h3>' + json[i].post_title + '</h3><div><p>Read More <i class="fa-solid fa-circle-arrow-right"></i></p></div></div>' +
                            '</a></div>'
                        );
                    }
            } catch (error) {
                console.error(error.message);
            } finally {
                elem.fadeIn(500, () => {
                    gsap.to("#blog_content_wrap .postResults",
                        { 
                            opacity : 1,
                            stagger: 0.15,
                            duration: 0.5
                        }
                    );
                });
            }
        });
    }

    const sendMail = async (formData) => {
            const form = new FormData();
            form.append('action', 'sendMail');
            form.append('name', formData[0].elements.ef3_contact_name.value);
            form.append('email', formData[0].elements.ef3_contact_email.value);
            form.append('subject', formData[0].elements.ef3_contact_subject.value);
            form.append('message', formData[0].elements.ef3_contact_message.value);
            const params = new URLSearchParams(form);
            try {
                const response = await fetch(wp_ajaxurl, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Cache-Control': 'no-cache',
                    },
                    body: params     
                });
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                const json = await response.json();
                if ( json.messsage == "Success") {
                    $('.ef3_contact_block_contact_form form').fadeOut(500, () => {
                        $('.ef3_contact_block_contact_form form').html("<p>Thank you for your message. I will get back to you as soon as I can!</p>");
                    })
                }
            } catch (error) {
                console.error(error.message);
            } finally {
                $('.ef3_contact_block_contact_form form').fadeIn(500);
            }
    }

})(jQuery);
