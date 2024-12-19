window.addEventListener("load", () => {
    let wrapper = document.getElementsByClassName('ef3_about_block');
    let theTitle = document.getElementsByClassName('ef3_about_block_content_title');
    let imageBox = document.getElementsByClassName('ef3_about_block_image_box');
    gsap.to(theTitle[0],
        { 
            scrollTrigger: {
                trigger: wrapper[0],
                start: 'top top',
                end : '+=800px',
                scrub: 1,
            },
            opacity : 0, filter: 'blur(4px)', scale: 0.9, y: 50
        }
    );
    gsap.to(imageBox[0],
        { 
            scrollTrigger: {
                trigger: wrapper[0],
                start: 'top top',
                end : 'bottom bottom-=500',
                scrub: 1,
            },
            y: -50
        }
    );
});