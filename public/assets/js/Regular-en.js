

let config = document.getElementById("config").getAttribute("data-page");

let langWindow = window.location.href;

let generateConfig = ( MainName , SubName = false ) => SubName ? `${SubName}_${MainName}` :`${MainName}`;

const getElementBySelecting = (classForm , multi = "no") => {

    return  multi == "no" ? document.querySelector(classForm) : document.querySelectorAll(classForm);
}

function RegularExpressionEn(valueInput) {

    let pattern = /[A-Za-z][A-Za-z0-9\'\s]*$/;

    let result = valueInput.match(pattern);

    if (result) {

        valueInput = result[0];

    } else {

        valueInput = "";
    }

    return valueInput;
}

function RegularExpressionAr(valueInput) {

    let pattern = /^[\u0621-\u064A\u0660-\u0669\s]+$/;

    let result = valueInput.match(pattern);

    if (result) {

         valueInput = result[0];

    } else {

         valueInput = "";
    }

    return valueInput;
}

function RegularExpression(valueInput) {    

   return langWindow.includes('ar') ? RegularExpressionAr(valueInput) : RegularExpressionEn(valueInput);
} 

function TakeSelectingElement (Naming) {
    
    let nameCategory = getElementBySelecting(`.${generateConfig(config,Naming)}`, "yes");

    nameCategory.forEach((item) => {

        item.addEventListener('change', (e) =>{

            e.target.value = RegularExpression(e.target.value);
        });   

    });

}   

function WorkingFunctionTranslation(ParentElement , LabelClass,InputClass ){
    
    let SelectForm = getElementBySelecting(`.${generateConfig(config, ParentElement)}`,"yes");
    
    console.log(SelectForm);

        let dropDownArrow = document.querySelectorAll(".dropdown-menu-arrow a");

        SelectForm.forEach((item) => {

            let parent = item;
            
            let label = item.querySelector(`.${generateConfig(config, LabelClass)}`);
            
            let input = item.querySelector(`.${generateConfig(config, InputClass)}`);

            let numberOfLang = 0;

            let arrLang = [];

            dropDownArrow.forEach((lang) => {

                arrLang.push(lang.getAttribute("hreflang"));

                numberOfLang++;
            });


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
                
                
                parent.appendChild(cloneLabel);
                parent.appendChild(cloneInput);

                
                if(langItem == 'ar'){

                let arabic = document.querySelectorAll(`.${name}_${langItem}`);
                
                arabic.forEach((item)=>{
                    
                    item.addEventListener("change", (e) => {
                        
                      e.target.value =  RegularExpressionAr(e.target.value);
                    }); 
                })
                }else{
                    item.addEventListener("change", (e) => {
                        
                      e.target.value = RegularExpressionEn(e.target.value);
                    }); 
                }
            });
        });
}

TakeSelectingElement('text');
WorkingFunctionTranslation("multi", "label", "text");

TakeSelectingElement("test");
WorkingFunctionTranslation("new", "label", "test");





