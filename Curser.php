<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kurser Schema</title>
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
        
            if(isset($_POST['courses'])){
                $search=$_POST['courses'];
            }else{
                $search="Unknown";
            }

            $xml = file_get_contents("https://wwwlab.webug.se/examples/XML/scheduleservice/courses?namesearch=".urlencode($search));
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);
            
            $courses= $dom->getElementsByTagName('course');
            foreach ($courses as $course){
                echo "<tr>";
                echo "<th>";
                echo "Course ID: ".$course->getAttribute("id")."<br>";
                echo "Course:".$course->getAttribute("name")."<br>";
                echo "Hp: ".$course->getAttribute("hp")."<br>";
                echo "Department: ".$course->getAttribute("department")."<br>";
                echo "</th>";
                echo "</tr>";
            
                $entries= $dom->getElementsByTagName('entries');

                $lista = array();

                foreach ($entries as $child){
                    $lista["T".str_replace(" ","",$child->getAttribute("starttime"))]=Array($child->getAttribute("starttime"),$child->getAttribute("endtime"),$child->getAttribute("room"),$child->getAttribute("sign"));
                }
                ksort($lista);
                
                foreach ($lista as $child){
                    echo "<tr>";
                    echo "<td>";
                    echo "Starttime: ".$child[0]. " ";
                    echo "Endtime: ".$child[1]. " ";
                    echo "Room: "."<a href='Rum.php?val=".$child[2]."'>".$child[2]."</a>"." ";
                    $Lärare = explode(",",$child[3]); //dela upp sign i tvÃ¥
                    echo "Instructor: "."<a href='Teachers.php?val=".$Lärare[0]."'>".$Lärare[0]."</a>".", ";
                    echo "<a href='Teachers.php?val=".$Lärare[1]."'>".$Lärare[1]."</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }

            ?>
        </table>
    </body>
</html>