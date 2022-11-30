<body>
     <div class="header" style="background-color: #fddea7; width:100%; height:50px; padding:0px">
        <img src="{{asset('template/madjouLogo.png')}}" height="40px" width="200px" style="padding: 5px" alt=""> 
    </div>
    <div class="mail-body">
        <h1 style="text-align: center;">Email To customer</h1>
        <h4>Subject : {{$subject}}</h4>
        <div class="content" style="text-indent: 50px">
            {!! htmlspecialchars_decode($comment) !!}
        </div>
    </div>

</body>
