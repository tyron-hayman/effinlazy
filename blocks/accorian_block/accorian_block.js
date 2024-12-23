window.addEventListener("load", (event) => {
    let ef3_accordion_item = document.getElementsByClassName('ef3_accordion_item');
    if ( ef3_accordion_item.length > 0 ) {
        for(let i = 0; i < ef3_accordion_item.length; i++) {
            addItemListener(ef3_accordion_item[i], i)
        }
    }
});

const addItemListener = (element, index) => {
    element.addEventListener("click", (e) => {
        let ef3_accordion_item = element.parentNode.querySelectorAll('.ef3_accordion_item');

        for (let i = 0; i < ef3_accordion_item.length; i++) {
            if ( i != index ) {
                ef3_accordion_item[i].classList.remove("open");
            }
        }

        if ( element.classList.contains("open") ) {
            element.classList.remove("open");
        } else {
            element.classList.add("open");
        }
    });
}