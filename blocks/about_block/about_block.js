window.addEventListener("load", () => {
    let wrapper = document.getElementsByClassName('ef3_about_block');
    let theTitle = document.getElementsByClassName('ef3_about_block_content_title');
    let theImage = document.getElementsByClassName('ef3_about_block_image');
    gsap.to(theTitle[0],
        { 
            scrollTrigger: {
                trigger: wrapper[0],
                start: 'top top',
                end : '+=600px',
                scrub: 1,
            },
            opacity : 0, filter: 'blur(4px)'
        }
    );
    gsap.to(theImage[0],
        { 
            scrollTrigger: {
                trigger: wrapper[0],
                start: 'top top',
                end : '+=600px',
                scrub: 1,
            },
            scale: 1
        }
    );
});