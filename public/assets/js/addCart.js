
let addToCart = document.querySelectorAll(".adtocart");

let UrlSystem = window.location.href;
let getHref = UrlSystem.split("products");


const TIMEOUT_SEC = 90;

const timeout = function (s) {
    return new Promise(function (_, reject) {
        setTimeout(function () {
            reject(
                new Error(`Request took too long! Timeout after ${s} second`)
            );
        }, s * 1000);
    });
};

async function changing(self, icon, errorMsg = "Something went wrong 💥💥") {

    let dataForm = {
        '_token':self.firstElementChild.value,
        'id':self.getAttribute("data_product"),
    };
    
    try {
        const fetchData = fetch(getHref[0] + "invoices/cart", {
            method: "POST", // or 'PUT'
            headers: {
                "Content-Type":"application/json",
                "X-CSRF-TOKEN":self.firstElementChild.value,
            },
            body: JSON.stringify(dataForm),
        });

            const response = await Promise.race([fetchData, timeout(TIMEOUT_SEC)]);

            if (!response.ok)
                throw new Error(
                    `${errorMsg} <strong>(${response.status})</strong> .Try again!`
                );

            const data = await response.json();

            let RemoveSpinner =   self.querySelector(".spinner-border");

            RemoveSpinner.remove();

            self.appendChild(icon);

            console.log(data);

        } catch (error) {

            throw error;
        }
}

addToCart.forEach((item) =>{

    item.addEventListener('click' ,()=>{

        // Icon Reload
        const i = document.createElement("i");
        i.className = "las la-shopping-cart";

        spinner(item);
        
        changing(item, i);
    });
});


function spinner(item){

    let shoppingCart = item.querySelector(".la-shopping-cart");

    // spinner Reload
    const spinner = document.createElement("div");
    spinner.className = "spinner-border";
    spinner.setAttribute("role", "status");

    // span in Spinner  Reload
    const span = document.createElement("span");
    span.className = "sr-only";
    span.innerHTML = "Loading ...";

    // Icon Reload
    const i = document.createElement("i");
    i.className = "las la-shopping-cart";

    // Remove Shopping Cart
    shoppingCart.remove();

    // add spinner
    spinner.appendChild(span);
    item.appendChild(spinner);
}

