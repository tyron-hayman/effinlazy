window.addEventListener("load", (event) => {
    let quoteItem = document.querySelectorAll('.ef3_quotes_wrap .ef3_quotes_item');
    let box1 = document.getElementsByClassName('box1');
    let box2 = document.getElementsByClassName('box2');
    gsap.to(box1[0], {
        duration: 1.5,
        y: '+=5',
        x: "+=5",
        repeat: -1,
        ease: "sine.inOut",
        yoyo: true,
    });
    gsap.to(box2[0], {
        duration: 1.5,
        y: "-=5",
        x: "-=5",
        repeat: -1,
        ease: "sine.inOut",
        yoyo: true
    });
    let quoteNum = 1;
    gsap.set(quoteItem, { opacity : 0, filter: 'blur(4px)', scale: 1.05 });
    gsap.set(quoteItem[0], { opacity : 1, filter: 'blur(0px)', scale: 1 });
    const timer = setInterval(() => {
        quoteNum++;
        if ( quoteNum >= quoteItem.length -1 ) {
            quoteNum = 0;
        }
        runQuotes(quoteNum);
    }, 8000);

    const runQuotes = (quoteNum) => {
        for(let i = 0; i < quoteItem.length; i++) {
            gsap.to(quoteItem[i], { opacity : 0, filter: 'blur(4px)', scale: 1.05, duration: 0.5 });
        }
        setTimeout(() => {
            gsap.to(quoteItem[quoteNum], { opacity : 1, filter: 'blur(0px)', scale: 1, duration: 0.5 });
        }, 500);
    }
});