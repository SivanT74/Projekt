<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rum schema</title>
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

        <div>
            <h1> Schema <h1>
        </div>

        <table>

            <?php
                if(isset($_POST['room'])){
                    $Rum=$_POST['room'];
                }
                else if (isset($_GET['val'])){
                    $Rum=$_GET["val"];
                }

            $xml = file_get_contents("https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/?number=".$Rum);
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);
            
            echo "<h2>";
            echo "Sal ".$Rum;
            echo "</h2>";

            $rum= $dom->getElementsByTagName('entry');

                $lista=Array();
                foreach ($rum as $child){
                    $lista["T".str_replace(" ","",$child->getAttribute("starttime"))]=Array($child->getAttribute("starttime"),$child->getAttribute("endtime"),$child->getAttribute("coursename"),$child->getAttribute("courseid"),$child->getAttribute("comment"),$child->getAttribute("sign"));
                    ksort($lista);
                }
                    foreach ($lista as $child){
                        echo "<tr>";
                        echo "<th>";
                        echo "<h3>";
                        echo $child[0]." ";
                        echo " - ";
                        echo $child[1];
                        echo "</h3>";
                        echo "Course: ".$child[2]."  ";
                        echo "ID: ".$child[3]."  ";
                        echo "Typ: ".$child[4]."  ";
                        $Lärare = explode(",",$child[5]); //dela upp sign i tvÃ¥
                        echo "<a href='Teachers.php?val=".$Lärare[0]."'>".$Lärare[0]."</a>".", "; //visa SIGN som lÃ¤nk till staff och posta SIGN
                        echo "<a href='Teachers.php?val=".$Lärare[1]."'>".$Lärare[1]."</a>";
                        echo "</th>";
                        echo "</tr>";
                    }
            ?>
        </table> 
    </body>
</html>