let invoiceNumber = document.querySelector(".invoice_number");
let RandomInvoice =  "asdfghjklqwertyuiopzxcvbnm1234567890";

function RandomInvoicing(len){

    let NewNo = "";
    let Dashes = 3;

    for (let i = 1; i < 9; i++) {
        NewNo +=RandomInvoice[Math.floor(Math.random() * len)].toUpperCase();
        if (i == Dashes){
            NewNo += "-";
            Dashes+= 3
        }
    }
    return NewNo;
}

let RandomValue = RandomInvoicing(36);
console.log(RandomValue);

invoiceNumber.value = RandomValue;

invoiceNumber.addEventListener('change' , (e)=>{

    e.target.value = RandomValue;

})