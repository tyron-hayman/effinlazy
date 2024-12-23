window.addEventListener("load", () => {
    let ef3_stories_box = document.querySelectorAll('.ef3_stories_box');
    if( ef3_stories_box.length > 0 ) {
        gsap.utils.toArray(".ef3_stories_box").forEach((section, index) => {
            gsap.set(section, { y: 50, opacity: 0})
            gsap.to(section,
                { 
                    y: 0, opacity: 1, duration: 0.5, delay : (index + 1) * 0.25
                }
            );
        });
    }
});