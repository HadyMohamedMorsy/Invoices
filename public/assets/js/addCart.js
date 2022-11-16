
let addToCart = document.querySelectorAll(".adtocart");

let UrlSystem = window.location.href;
let getHref = UrlSystem.split("products");


function changing(self) {
    
    let test = {id : self};

    fetch("http://127.0.0.1:8000/en/invoices/cart", {
        method: "GET", // or 'PUT'
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((response) => response.json())
    .then((data) => {

        console.log("Success:", data);
    })
    .catch((error) => {
        console.error("Error:", error);
    });
}
changing(addToCart[0].getAttribute("data_product"));
