
const adressopen= document.querySelector('#form-open')
const adressclose= document.querySelector('#form-close')

adressopen.addEventListener("click",function(){
    document.querySelector('.adress-form').style.display="flex"
}
)
adressclose.addEventListener("click",function(){
    document.querySelector('.adress-form').style.display="none"
}
)