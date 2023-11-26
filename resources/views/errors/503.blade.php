<!DOCTYPE html>
<html>
    <head>
        <title>503</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet");

@import url("https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700");

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
}

body{
  overflow:hidden;
  background-color: #f4f6ff;
}

.container{
  width:100vw;
  height:80vh;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: "Poppins", sans-serif;
  position: relative;
  left:6vmin;
  text-align: center;
}

.cog-wheel1, .cog-wheel2{
  transform:scale(0.7);
}

.cog1, .cog2{
  width:40vmin;
  height:40vmin;
  border-radius:50%;
  border:6vmin solid #f3c623;
  position: relative;
}


.cog2{
  border:6vmin solid #4f8a8b;
}

.top, .down, .left, .right, .left-top, .left-down, .right-top, .right-down{
  width:10vmin;
  height:10vmin;
  background-color: #f3c623;
  position: absolute;
}

.cog2 .top,.cog2  .down,.cog2  .left,.cog2  .right,.cog2  .left-top,.cog2  .left-down,.cog2  .right-top,.cog2  .right-down{
  background-color: #4f8a8b;
}

.top{
  top:-14vmin;
  left:9vmin;
}

.down{
  bottom:-14vmin;
  left:9vmin;
}

.left{
  left:-14vmin;
  top:9vmin;
}

.right{
  right:-14vmin;
  top:9vmin;
}

.left-top{
  transform:rotateZ(-45deg);
  left:-8vmin;
  top:-8vmin;
}

.left-down{
  transform:rotateZ(45deg);
  left:-8vmin;
  top:25vmin;
}

.right-top{
  transform:rotateZ(45deg);
  right:-8vmin;
  top:-8vmin;
}

.right-down{
  transform:rotateZ(-45deg);
  right:-8vmin;
  top:25vmin;
}

.cog2{
  position: relative;
  left:-10.2vmin;
  bottom:10vmin;
}

h1{
  color:#142833;
}

.first-four{
  position: relative;
  left:6vmin;
  font-size:40vmin;
}

.second-four{
  position: relative;
  right:18vmin;
  z-index: -1;
  font-size:40vmin;
}

.wrong-para{
  font-family: "Montserrat", sans-serif;
  position: absolute;
  bottom:5vmin;
  padding:3vmin 12vmin 3vmin 3vmin;
  font-weight:600;
  color:#092532;
  font-size:2rem;
}

#address-contact{
    height:20vh;
    margin: 0 auto;
}
#address-contact center p{
    font-family: "Poppins", sans-serif;
    font-weight: bold;
    font-size: 1.5rem;
    color: navy;
}
.logo{
    width:100%;
    height:100px;

}
        </style>
    </head>
    <body>
        <div class="container">
  <h1 class="first-four">5</h1>
  <div class="cog-wheel1">
      <div class="cog1">
        <div class="top"></div>
        <div class="down"></div>
        <div class="left-top"></div>
        <div class="left-down"></div>
        <div class="right-top"></div>
        <div class="right-down"></div>
        <div class="left"></div>
        <div class="right"></div>
    </div>
  </div>

  <div class="cog-wheel2">
    <div class="cog2">
        <div class="top"></div>
        <div class="down"></div>
        <div class="left-top"></div>
        <div class="left-down"></div>
        <div class="right-top"></div>
        <div class="right-down"></div>
        <div class="left"></div>
        <div class="right"></div>
    </div>
  </div>
 <h1 class="second-four">3</h1>
  <p class="wrong-para">We are in Maintenance mode! </br>We will be back soon!
  </p>
</div>

<div id="address-contact">
    <div class="logo">
        <center><img style="width: 20%;" src="{{ asset('assets/images/logo_long.png') }} " alt=""></center>
    </div>
    <center>
        <p>Head Office: 1/A-B, College Street, Mirpur Road, Dhaka-1205, Bangladesh </br>Contact: 01900000000  E-mail: alhadienterprise@gmail.com</p>
    </center>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.1/gsap.min.js"></script>
<script>
    let t1 = gsap.timeline();
let t2 = gsap.timeline();
let t3 = gsap.timeline();

t1.to(".cog1",
{
  transformOrigin:"50% 50%",
  rotation:"+=360",
  repeat:-1,
  ease:Linear.easeNone,
  duration:8
});

t2.to(".cog2",
{
  transformOrigin:"50% 50%",
  rotation:"-=360",
  repeat:-1,
  ease:Linear.easeNone,
  duration:8
});

t3.fromTo(".wrong-para",
{
  opacity:0
},
{
  opacity:1,
  duration:1,
  stagger:{
    repeat:-1,
    yoyo:true
  }
});
</script>



    </body>
</html>
