let quote = document.getElementsByClassName('ef3_landing_quote');

window.addEventListener("load", (event) => {
    let quoteNum = 1;
    quote[0].classList.add("active");
    const timer = setInterval(() => {
        quoteNum++;
        if ( quoteNum >= quote.length -1 ) {
            quoteNum = 0;
        }
        runQuotes(quoteNum);
    }, 8000);
});

const runQuotes = (quoteNum) => {
    for(let i = 0; i < quote.length; i++) {
        quote[i].classList.remove('active');
    }
    setTimeout(() => {
        quote[quoteNum].classList.add('active');
    }, 500);
}