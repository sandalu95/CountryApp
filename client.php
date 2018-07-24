<!DOCTYPE html>
<html>
    <head> 
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <style>
            .txt{
                font-weight: bold; 
                font-family: Arial, Helvetica,sans-serif;
                margin-top: 10px;
                 color:white;
            }
        </style>
    </head>

    <body style="background-image: url(world.png)">
       <!--  Outer box -->
        <div class="container" style="margin: auto; margin-top: 30px;">
            <div class="jumbotron" style="padding-left: 80px; padding-right: 0px; width: 500px; margin-right: auto; margin-left: auto; opacity: 0.8;">
                <h3 style="opacity: 1.0">Search by CountryCode</h3>
                <!-- form to enter country code -->
                <form name="form" action="client.php" method="post" style="width: 400px; margin: 0px; margin-right: 0px;opacity: 1.0">
                    <input   name = "indexNo" style ="width:250px; height:30px; opacity: 1.0"></input>
                    <input type="submit"  style ="width:60px; height:30px; opacity: 1.0" onclick="" value="Search"></input>
                </form>
            </div>
        </div>

        <!-- Inner box -->
        <div style ="margin:auto; padding:60px; padding-top:30px;background-color:#000; opacity:0.7;width:450px; height:400px; margin-top:20px">

            <h1 style ="color: #FFF; margin-left: 20px;">COUNTRY INFO</h1>
            <div style ="margin-top:40px; margin-left: 30px;!important">

                <?php
                    error_reporting(0);
                    $indexNo = $_POST['indexNo'];
                    if($indexNo==null){
                        echo "<p class='txt'style='margin-left:10px;'>Please enter the countrycode first</p>";
                    }
                    else{    
                            // import NuSOAP lib             
                            require_once "NuSOAP/lib/nusoap.php";
                            //get the WSDL file
                            $client = new nusoap_client("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL", true);
                            $error = $client->getError();
                            if ($error) {
                                echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
                            }

                        $result = $client->call("CountryName", array("sCountryISOCode" => $indexNo));

                                //get any errors in calling WSDL
                                $error = $client->getError();
                                if ($error) 
                                {
                                    echo $error;
                                }
                                else 
                                {
                                    foreach ($result as $x) 
                                    {
                                            echo "<p class='txt'>Country: ".$x."</p>"; //country name
                                    }
                                }

                            $result = $client->call("CapitalCity", array("sCountryISOCode" => $indexNo));
                            //get any error in calling method
                            $error = $client->getError();
                                if ($error) 
                                {
                                    echo $error;
                                }
                                else 
                                {
                                    foreach ($result as $x) 
                                    {
                                            echo "<p class='txt'>Capital: ".$x."</p>"; //capital name
                                    }
                                }

                            $result = $client->call("CountryIntPhoneCode", array("sCountryISOCode" => $indexNo));
                            //get any error in calling method
                            $error = $client->getError();
                                if ($error) 
                                {
                                    echo $error;
                                }
                                else 
                                {
                                    foreach ($result as $x) 
                                    {
                                            echo "<p class='txt'>Code: ".$x."</p>"; //phone code
                                    }
                                
                                }

                            $result = $client->call("CountryFlag", array("sCountryISOCode" => $indexNo));
                            //get any error in calling method
                            $error = $client->getError();
                                if ($error) 
                                {
                                    echo $error;
                                }
                                else 
                                {
                                    $imageLink= "";
                                    foreach ($result as $x) 
                                    {
                                            $imageLink = $imageLink.$x; //Flag link
                                    }
                                echo "<img src=".$imageLink." style='margin:auto;'></img>";
                                }                       
                    }
                ?>           
            </div>           
        </div>      
    </body>
</html>
