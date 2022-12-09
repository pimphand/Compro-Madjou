<body style="background-color: #F5EBE0;">
    <div class="header" style="background-color: #fddea7; width:100%; height:50px; padding:0px; margin:0;">
       <img src="{{asset('template/madjouLogo.png')}}" height="40px" width="200px" style="padding: 5px" alt=""> 
   </div>
   <div class="mail-body">
       <h1 style="text-align: center;margin-bottom:25px">{{$subject}}</h1>
       <div class="content" style="text-indent: 50px;">
            <div class="image" style="margin-left: 50px; margin-top:20px; margin-bottom:20px">
                <img src="{{asset('storage/notifications')}}/{{$image}}" height="200px" width="500px" alt="">
            </div>
           <p style="font-size: 20px;font-family:'Courier New', Courier, monospace;">{!! htmlspecialchars_decode($body) !!}</p>
       </div>
   </div>

</body>