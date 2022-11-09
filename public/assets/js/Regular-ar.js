

let config = document.getElementById("config").getAttribute("data-page");

let generateConfig = ( MainName , SubName = false ) => SubName ? `${SubName}_${MainName}` :`${MainName}`;

const getElementBySelecting = (classForm , multi = "no") => {

    return  multi == "no" ? document.querySelector(classForm) : document.querySelectorAll(classForm);
}


let nameCategory = getElementBySelecting(`.${generateConfig(config,'name')}`, "yes");

nameCategory.forEach((item) => {

        item.addEventListener('change', (e) =>{

        let pattern = /^[\u0621-\u064A\u0660-\u0669\s]+$/;

        let result = e.target.value.match(pattern);

        if (result) {

            e.target.value = result[0];

        } else {
            
            e.target.value = "";
        }
    });   
})
