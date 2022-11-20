
let UrlSystem = window.location.href;
let getHref = UrlSystem.split("invoices");
let token = document.querySelector('.token');

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

async function changing(self, token ,errorMsg = "Something went wrong 💥💥") {

    let dataForm = {
        _token: token.value,
        cart_id: self.closest("td").querySelector(".data_item").value,
        count: self.value,
        subtotal: +self.closest("tr").querySelector(".subtotal").innerHTML,
    };
    
    try {

    const fetchData = fetch(getHref[0] + "invoices/countItems", {
        method: "POST", // or 'PUT'
        headers: {
            "Content-Type":"application/json",
            "X-CSRF-TOKEN":token.value,
        },
        body: JSON.stringify(dataForm),
    });

        const response = await Promise.race([fetchData, timeout(TIMEOUT_SEC)]);

        if (!response.ok)
            throw new Error(

                `${errorMsg} <strong>(${response.status})</strong> .Try again!`
            );

        const data = await response.json();

        if (data.Success) {

            not7(data.Success);

        } else {
            
            not11(data.Error);
        }   
        
        console.log(data);
        
    } catch (error) {

        throw error;
    }
}

async function DeleteItem(self, token ,errorMsg = "Something went wrong 💥💥"){

    let dataForm = {
        _token: token.value,
        Cart_id: self.getAttribute("data-remove"),
    };

    try {
        const fetchData = fetch(getHref[0] + "invoices/DeleteItem", {
            method: "POST", // or 'PUT'
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token.value,
            },
            body: JSON.stringify(dataForm),
        });

        const response = await Promise.race([fetchData, timeout(TIMEOUT_SEC)]);

        if (!response.ok)
            throw new Error(
                `${errorMsg} <strong>(${response.status})</strong> .Try again!`
            );

        const data = await response.json();
        // Executes the func after delay time.
        console.log(data);


    } catch (error) {
        throw error;
    }

}

if(document.querySelectorAll('.quantity')){

    let plus = document.querySelectorAll('.plus');
    let minus = document.querySelectorAll('.minus');
    let remove = document.querySelectorAll(".remove-from-cart");

    plus.forEach((item)=>{
        item.addEventListener('click' , (e)=>{
            calculationPlus(item);
            CalculationTotal();
        })
    })

    minus.forEach((item)=>{
        item.addEventListener('click' , (e)=>{
            calculationMinus(item);
            CalculationTotal();
        })
    })

    remove.forEach((item)=>{
        item.addEventListener('click', (e)=>{
            e.preventDefault();
            DeleteItem(item, token);
            item.closest('tr').remove();
            CalculationTotal();
        })
    })

    CalculationTotal();
}

const UpdateDebounce = debounce((target)=>{
    changing(target, token)
});

function debounce(cb , delay = 1000 ){
    let timeout;
    return function (...args){
    clearTimeout(timeout);
    timeout =  setTimeout(()=>{
            cb(...args);
    }, delay)
    }
}

function calculationPlus(target){
    let quantity = target.closest('td').querySelector('.quantity');
    let price =  +target.closest('td').nextElementSibling.innerHTML;
    +quantity.value++;
    let NewPrice = price  *  quantity.value;
    target.closest('td').nextElementSibling.innerHTML = NewPrice;
    if(+quantity.value > 8){
        quantity.value = 8;
        target.closest('td').nextElementSibling.innerHTML = price;
    }
    UpdateDebounce(quantity,token);
}

function calculationMinus(target){
    let quantity = target.closest('td').querySelector('.quantity');
    let price =  +target.closest('td').nextElementSibling.innerHTML;
    let NewPrice = price  /  +quantity.value;
    target.closest('td').nextElementSibling.innerHTML = NewPrice;
    +quantity.value--;
    if(+quantity.value < 1){
            quantity.value = 1;
            target.closest('td').nextElementSibling.innerHTML = price;
    }
    UpdateDebounce(quantity,token);
}

function CalculationTotal() {
    let subtotal = document.querySelectorAll(".subtotal");
    let total = document.querySelector(".total");

    let PriceTotal = 0;

    subtotal.forEach((item) => {
        PriceTotal += +item.innerHTML;
    });

    let Checkout = document.querySelector(".Checkout");

    total.innerHTML = PriceTotal + "$";
    Checkout.value = PriceTotal;
}



