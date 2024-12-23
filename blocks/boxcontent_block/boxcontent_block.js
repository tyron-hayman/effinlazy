window.addEventListener("load", () => {
    let ef3_box_content_box = document.getElementsByClassName('ef3_box_content_box');
    if ( ef3_box_content_box.length > 0 ) {
        for(let i = 0; i < ef3_box_content_box.length; i++) {
            if ( i % 2 == 0) {
                gsap.set(ef3_box_content_box[i], { x: -100, opacity: 0 })
            } else {
                gsap.set(ef3_box_content_box[i], { x: 100, opacity: 0 })
            }
        }
        gsap.utils.toArray(ef3_box_content_box).forEach(section => {
            gsap.to(section,
                { 
                    scrollTrigger: {
                        trigger: section.parentNode,
                        start: 'top top+=500px',
                    },
                    x: 0, opacity: 1
                }
            );
        });
    }
});