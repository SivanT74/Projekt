<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Startsida</title>
        <style type="text/css">
            body {
                background-color: #8c8c8c;
            }

            table {
                text-align:center;
                table-layout:fixed;
                border: 2px solid;
                border-spacing: 1rem;
                margin-bottom: 2rem;
                empty-cells:hide;
            }

            h1 {
                font-size: 3em;
            }

        </style>
    </head>
    <body>

        <div>
            <h1> Schema <h1>
        </div>

        <div>

            <p>Hitta ditt Program</p>

            <form method='POST' action='Program.php'>

                <input type="text" placeholder="Search.." name='program'>
                <button>Sök!</button>

            </form>


        <form method="POST" action="Program.php">
            <?php

            $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/programs/');
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);

                echo "<select name='program'>";

            $programs= $dom->getElementsByTagName('program');


            foreach ($programs as $program){
                echo "<option value='".$program->getAttribute("name")."'>";
                echo $program->getAttribute("name");
                echo "</option>";
            }
                echo "</select>";
                
            ?>

        <input type="submit" value='Visa schema'>    

        </form>
            <p>Hitta din Kurs</p>
        <form method="POST" action="Curser.php">
            
            <?php

            $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/courses/');
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);

                echo "<select name='courses'>";

            $courses= $dom->getElementsByTagName('course');

            foreach ($courses as $course){
                echo "<option value='".$course->getAttribute("name")."'>";
                echo $course->getAttribute("name");
                echo "</option>";
            }
                echo "</select>";
            ?>   

        <input type="submit" value='Visa schema'>  

        </form>
            <p>Hitta ett rum</p>
        <form method="POST" action="Rum.php">
        
        <?php

        $xml = file_get_contents('https://wwwlab.webug.se/examples/XML/scheduleservice/rooms/');
            $dom = new DomDocument;
            $dom->preserveWhiteSpace = FALSE;
            $dom->loadXML($xml);

        echo "<select name='room'>";

            $Rums= $dom->getElementsByTagName('room');
            foreach ($Rums as $Rum){
                echo"<option value='" .$Rum->getAttribute("number")."'>";
                echo $Rum->getAttribute("number");
            }

        echo "</select>";
            
            ?>   

        <input type="submit" value='Visa schema'>    
        
        </form>
        </div>
    </body>
</html>