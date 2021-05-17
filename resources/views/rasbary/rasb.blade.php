<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>AdUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdUp</title>
 
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

 
<style>
video { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
  background-size: cover;
  transition: 1s opacity;
}
</style>

</head>

            
            <?php
                $aabc= "<script>document.writeln(res);</script>";
              
       
               // echo gettype($aabc);
              

            ?>
            <?php
                
                //echo strval($mac);
                $con=DB::table('consumers')->where('Mac',"=", $mac)->get();    
                //echo gettype($con)
             
            ?>
          
<body class="font-sans w-full">
    <div class="container">
       
        <div class="card-body">
        @if(count($con) >0)

            @foreach($add as $key => $ad)
                    @if($ad->priority==11)
                    <script>

                        setTimeout(function(){ 
                            myFunctionsakka()
                        // document.getElementById("sendToIframe").click(); 
                        }, 100); 
                        var res = document.getElementById("Mac").value;



                        document.addEventListener('DOMContentLoaded', function() {
                            const messageEle = document.getElementById('message');

                            window.addEventListener('message', function(e) {
                                const data = JSON.parse(e.data);
                                const date = new Date(data.date).toLocaleTimeString('en-US');
                                
                                messageEle.innerHTML = `Receive "${data.message}" at ${date}<br>` + messageEle.innerHTML;
                                document.getElementById('Mac').value=data.message ; 
                            });

                            document.getElementById('sendToWindow').addEventListener('click', function() {
                                const message = JSON.stringify({
                                    message: 'skip',
                                    date: Date.now(),
                                });
                                window.parent.postMessage(message, '*');
                            });
                        });
                        function myFunctionsakka() {
                                    
                                        const messageEle = document.getElementById('message');
                                        const message = JSON.stringify({
                                            message: {{$ad->time}},
                                            date: Date.now(),
                                        });
                                        window.parent.postMessage(message, '*');
                                    
                            }
                        </script>
                    <video autoplay muted loop id="video">
                        <source src="{{$ad->video}}" type="video/mp4">
                    </video>
                    @endif
            @endforeach
           
          

            

        @else
        <h2>Adup   </h2>          
        <form action="{{ route("consumers.saveMe") }}" method="get" >
                @csrf
                <div class="form-group "  style="display:none" >
                <label for="Mac">Mac*</label>
                    <input type="text" id="Mac" name="Mac" class="form-control" value="{{$mac}}">
               
                                
                </div>
            
                <div class="form-group ">
                    <label for="sex">gender</label>
                    
                    <select class="form-control" id="sex" name="sex" class="form-control" value="male" required>
                        <option>male</option>
                        <option>female</option>
                    
                    </select>
                    
                </div>
                
                <div class="form-group ">
                    <label for="age">age</label>
                    <input type="text" id="age" name="age" class="form-control" required> 
                
                    
                </div>

            
            
                
                
                <div>
                    <input class="btn btn-danger" type="submit" id="sendToWindow" value="connect" onclick="myFunctionsakka()">
                </div>
            </form>
        @endif
    </div>
        <div id="message" class="border border-gray-400 h-48 my-2 overflow-auto p-2" style="display:none" ></div>

    </div>



</body>

</html>
