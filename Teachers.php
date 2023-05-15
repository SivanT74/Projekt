<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lärare schema</title>

        <style type="text/css">
            body {
                background-color: #8c8c8c;
            }

            table {
                text-align:center;
                table-layout:fixed;
                border-spacing: 1rem;
                margin-bottom: 2rem;
                empty-cells:hide;
            }

            h1 {
                font-size: 5em;
            }

            .Tillbaka {
                width: 120px;
                color: #000000;
                font-size: 18px;
                border-radius: 0.5em;
                background: #ffffff;
                border: 1px solid #000000;
                text-align:center;
            } 

        </style> 

    </head>
    <body>

        <div class="Tillbaka">
            <a href="MainSida.php"> Startsida </a>
        </div>

        <div class="banner">
            <h1> Schema <h1> 
        </div>
        
        <table>

            <?php

            if(isset($_GET['val'])){
                $search=$_GET['val'];
            }else{
                $search="Unknown";
            }

            $xml = file_get_contents("https://wwwlab.webug.se/examples/XML/scheduleservice/staff?id=".urlencode($search));
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);
            
            echo "<h2>";
            echo "Sign: ".$search;
            echo "</h2>";

            $Lärares= $dom->getElementsByTagName('staff');
            foreach ($Lärares as $Lärare){
                echo "<tr>";
                echo "<td>";
                echo "<h3>Name:"."</h3>".$Lärare->getAttribute("fname")." ";
                echo $Lärare->getAttribute("lname")."<br>";
                echo "<h3>Title: "."</h3>".$Lärare->getAttribute("title")."<br>";
                echo "<h3>Department: "."</h3>".$Lärare->getAttribute("department")."<br>";
                echo "<h3>Born: "."</h3>".$Lärare->getAttribute("birthyear")."<br>";
                echo "<h3>Tele: "."</h3>".$Lärare->getAttribute("telnr")."<br>";
                echo "</td>";
                echo "</tr>";
            }

            ?>

        </table>
    </body>
</html>