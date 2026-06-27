<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JC_Resume</title>

    <style>
        body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;  
                font-family: 'Verdana', sans-serif;
            }

        .container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .container .main {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: flex-end;
                flex-direction: column;
                flex-wrap: nowrap;
            }

        .container .main .header {
            height: 20%;
            width: auto;
            display: flex;
            justify-content: space-evenly;
                background-color: #474A2C;
            flex-direction: row-reverse;
        }

        .container .main .header .box {
            width: 70%;
            margin: 20px;
        }

        .container .main .header .box .name p {
            font-size: 50px;
            font-weight: bold;
            color: #fff;
        }

        .container .main .header .box .summary p {
            font-size: 20px;
            color: #acacac;
        }

        .container .main .header .image {
            width: 15%;
            margin-top: 20px;
        }

        .container .main .header .image img {
            width: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .container .main .space {
            height: 10%;
            width: auto;
            padding: 10px;
        }

        .container .main .content {
            height: 100%;
            width: auto;

            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-evenly;
        }

        .container .main .content .box {
            margin: 20px;
            align-items: fill;
            width: 30%;
        }
        
        table{
            align-items: center;
        }
        td{
            padding: 10px;

        }

    </style>
</head>
<body>
    
    <?php 
        $name = "Justin Czar E. Borines";
        $prof_bg = "Born on September 10, 2004, in Quezon City, Philippines. Currently 20 years old.<br/> 
            A student at the Far East University Institute of Technology under AGD major.<br/> 
            He was a chess varsity during his elementary and highschool days. He grabs the opportunity<br/> 
            to improve his skill level and enjoys the challenge that came along with it.";
        $address = "Quezon City, Philippines";
        $email = "Lorem_Ipsum@gmail.com";
        $contact_num = "+63 912 345 6789";


    ?>

    <div class="container">   
        <div class="main">
            <div class="header">
                <div class="image">
                    <img src="Images/Borines_Justin_1x1Photo.png" alt="image">
                </div>
                <div class="box">
                    <div class="name">
                        <p><?php echo $name; ?></p>
                    </div>
                    <div class="summary">
                        <p>
                            <?php 
                                echo $address . "<br/>"; 
                                echo $email . "<br/>"; 
                                echo $contact_num; 
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="space"></div>

            <div class="content">
                <div class="box">
                    <div class="title">
                        <h2>Educational Background</h2>
                    </div>
                    <div class="summary">
                        <table>
                            <tr>
                                <td>DECEMBER, 2022</td>
                                <td>2nd place in  robotics concept of presentation,<br/> Colegio de Muntinlupa</td>
                            </tr>
                            <tr>
                                <td>2021 - 2023</td>
                                <td>Graduated with honors, Trinity University of Asia</td>
                            </tr>
                            <tr>
                                <td>2017 - 2021</td>
                                <td>Graduated with honors, Escuela de Sophia of Caloocan, Inc.</td>
                            </tr>
                            <tr>
                                <td>2007 - 2014</td>
                                <td>Graduated with honors, Union Village Christian Academy</td>
                            </tr>
                        </table><br/>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h2>Achievements</h2>
                    </div>
                    <div class="summary">
                        <table>
                            <tr>
                                <td>DECEMBER, 2022</td>
                                <td>2nd place in  robotics concept of presentation,<br/> Colegio de Muntinlupa</td>
                            </tr>
                            <tr>
                                <td>2021 - 2023</td>
                                <td>Graduated with honors, Trinity University of Asia</td>
                            </tr>
                            <tr>
                                <td>2017 - 2021</td>
                                <td>Graduated with honors, Escuela de Sophia of Caloocan, Inc.</td>
                            </tr>
                            <tr>
                                <td>2007 - 2014</td>
                                <td>Graduated with honors, Union Village Christian Academy</td>
                            </tr>
                        </table><br/>
                    </div>
                </div>
                <div class="box">
                    <div class="title">
                        <h2>Seminars Attended</h2>
                    </div>
                    <div class="summary">
                        <table>
                            <tr>
                                <td>April, 2025</td>
                                <td>FIGMA Training,<br/> Far East University Institute of Technology</td>
                            </tr>
                            <tr>
                                <td>March, 2023</td>
                                <td>APPS Development Training for Senior high school,<br/> Trinity University of Asia</td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>February - March, 2023</td>
                                <td>Work Immersion Culminating Activity,<br/> Trinity University of Asia</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>