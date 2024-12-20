window.addEventListener("load", () => {
    let scrollBtn = document.getElementsByClassName('ef3_ef3_image_right_block_btn');
    let sectionImage = document.getElementsByClassName('ef3_image_right_block_image');
    if ( scrollBtn[0] ) {
    scrollBtn[0].addEventListener("click", (e) => {
        e.preventDefault();
        let target = scrollBtn[0].parentElement.nextElementSibling.offsetTop;
        window.scroll({
            top: target,
            behavior: "smooth",
          });
    });
    }
        gsap.to(sectionImage[0].childNodes[0],
            { 
                scrollTrigger: {
                    trigger: sectionImage[0].parentElement,
                    start: 'top top+=600px',
                    end : '+=300px',
                    scrub: 1,
                },
                width: 0
            }
        );
});