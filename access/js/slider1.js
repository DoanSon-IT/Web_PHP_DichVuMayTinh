const rightbtn= document.querySelector('.fa-chevron-right')
const leftbtn= document.querySelector('.fa-chevron-left')
const img= document.querySelectorAll('.slider-content-left-top img')

let index=0
rightbtn.addEventListener("click" , function(){
    index=index+1
    if(index>img.length-1){
        index=0
    }
    document.querySelector(".slider-content-left-top").style.right =index*100+"%"
})

leftbtn.addEventListener("click" , function(){
    index=index-1
    if(index<=0){
        index=img.length-1
    }
    document.querySelector(".slider-content-left-top").style.right =index*100+"%"
})
// sliderleft-bottom khi click tiêu đề hiện ảnh dịch vụ tương ứn
const imgLi= document.querySelectorAll('.slider-content-left-bottom li')

imgLi.forEach(function(image,index){
   image.addEventListener("click", function(){
    removeactive()
    document.querySelector(".slider-content-left-top").style.right=index*100+"%"
    image.classList.add("active")
   }) 
})
function removeactive(){
    let imgactive= document.querySelector('.active')
    imgactive.classList.remove("active")
}
//slider auto
function imgAuto(){
    index=index+1
    if(index>img.length-1){
        index=0
    }
    removeactive()
    document.querySelector(".slider-content-left-top").style.right =index*100+"%"
    imgLi[index].classList.add("active")
}
setInterval(imgAuto,5000)