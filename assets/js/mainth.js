document.addEventListener("DOMContentLoaded",function(){
    // autocompletion film
    const searchFilm = document.getElementById("searchFilm");
    const renderTitle = document.getElementById("renderTitle");
    document.addEventListener("keyup",()=>{
        let serchVal = searchFilm.value;
        fetch("libraries/autoFilm.php",{
            method:"POST",
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: "searchFilm="+serchVal
        })
        .then(function(response){
            return response.text();
        })
        .then(function(text){
            renderTitle.innerHTML = text;
        })
    });

    const anim = gsap.from(".card",{duration:1.5,opacity:0,x:"random(100,900)",y:"random(100,900)",scale:0.5,stagger:0.5,paused:true});
    anim.play();
    /*
    function(a){
        console.log("Youpi"+a);
    }
    // est identique à
    (a)=>{
        console.log("Youpi"+a);
    }
    */
    //Scroll
    
});