

let config = document.getElementById("config").getAttribute("data-page");


let generateConfig = ( MainName , SubName = false ) => SubName ? `${SubName}_${MainName}` :`${MainName}`;

const getElementBySelecting = (classForm , multi = "no") => {

    return  multi == "no" ? document.querySelector(classForm) : document.querySelectorAll(classForm);
}


function TakeSelectingElement (Naming) {

    let nameCategory = getElementBySelecting(`.${generateConfig(config,Naming)}`, "yes");

    nameCategory.forEach((item) => {

            item.addEventListener('change', (e) =>{

            let pattern = /[A-Za-z][A-Za-z0-9\'\s]*$/;

            let result = e.target.value.match(pattern);

            if(result){

                e.target.value = result[0];

            }else{
                
                e.target.value = "";
            }
        });   
    })

    let SelectForm = getElementBySelecting(`.${generateConfig(config, "multi")}`,"yes");

    let dropDownArrow = document.querySelectorAll(".dropdown-menu-arrow a");

    SelectForm.forEach((item) => {
        let Parent = item;

        let input = Parent.querySelector(`.${generateConfig(config, 'name')}`);

        let label = Parent.querySelector(`.${generateConfig(config, 'label')}`);

        let arrLang = [];

        let numberOfLang = 0;

        dropDownArrow.forEach((lang) => {
            arrLang.push(lang.getAttribute("hreflang"));

            numberOfLang++;
        });

        let langWindow = window.location.href;

        let NewLang = langWindow.split("/");

        let FiltrationArrLang = arrLang.filter((item) => item != NewLang[3]);

        let cloneLabel;
        let cloneInput;

        FiltrationArrLang.forEach((langItem) => {

            cloneLabel = label.cloneNode(true);
            cloneInput = input.cloneNode(true);

            cloneInput.removeAttribute("name");
            cloneInput.removeAttribute("class");

            let name = cloneInput.getAttribute("data-name");

            cloneInput.setAttribute("name", name + "_" + langItem);
            cloneInput.setAttribute("class",name + "_" + langItem +" " +"form-control");


            Parent.appendChild(cloneLabel);
            Parent.appendChild(cloneInput);

            if(langItem == 'ar'){
                let arabic = document.querySelectorAll(`.${name}_${langItem}`);

                arabic.forEach((item)=>{

                    item.addEventListener("change", (e) => {
                        let pattern =
                            /^[\u0621-\u064A\u0660-\u0669\s]+$/;

                        let result = e.target.value.match(pattern);

                        if (result) {
                            e.target.value = result[0];
                        } else {
                            e.target.value = "";
                        }
                    }); 
                    
                })
            }else{
                    item.addEventListener("change", (e) => {
                        let pattern = /[A-Za-z][A-Za-z0-9\'\s]*$/;

                        let result = e.target.value.match(pattern);

                        if (result) {
                            e.target.value = result[0];
                        } else {
                            e.target.value = "";
                        }
                }); 
            }
        });
    });
}

TakeSelectingElement("text");




