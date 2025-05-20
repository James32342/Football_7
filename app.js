var images1=["./images/image1.png","./images/image2.png","./images/image3.png"]
var images2=["./images/image6.png","./images/image9.png","./images/image10.png"]
var images3=["./images/image7.png","./images/image8.png","./images/image11.png"]
var indx1=0
var indx2=0
var indx3=0

function changeimg(){
    
     const img=document.querySelectorAll(".dyn")
   
        
    img[0].src=images1[indx1];
    img[1].src=images2[indx2];
    img[2].src=images3[indx3];

    indx1=(indx1+1)%images1.length;
    indx2=(indx2+1)%images2.length;
    indx3=(indx3+1)%images3.length;


    

}
    
    setInterval(changeimg,3000)

