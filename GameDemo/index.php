<!-- Index -->
<!-- Based on https://github.com/tricsi/spacecraft, which is deployed here: https://tricsi.github.io/spacecraft/. -->

<!-- If this page is blank, there's probably a problem with the database connection. Either the login credentials are wrong, or an expected database, table, column, etc., is not being found. -->

<?php
session_start();

include('/etc/LearningGame/config.php');
include("functions.php");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$user_data = check_login($con);
$tori = $user_data['user_id'];
$weeklyQuery = "select * from WeekLeaderboard where user_id = $tori limit 1";
$monthlyQuery = "select * from MonthLeaderboard where user_id = $tori limit 1";
$alltimeQuery = "select * from AllTimeLeaderboard where user_id = $tori limit 1";
$dailyQuery = "select * from DayLeaderboard where user_id = $tori limit 1";

$convertdayQuery = mysqli_query($con, $dailyQuery);
$convertweekQuery = mysqli_query($con, $weeklyQuery);
$convertmonthQuery = mysqli_query($con, $monthlyQuery);
$convertallQuery = mysqli_query($con, $alltimeQuery);

$coinsforQ = 25;

$avcolor1 = '1'; //must be between 0 & 1 (inclusive, i think)
$avcolor2 = '1';
$avcolor3 = '1';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>VASA-Wiggin SpaceDash</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="192x192">
    <link rel="icon" sizes="192x192">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/d9a4adb85e.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style type="text/css">
        body,canvas,html,li,ul {
            width: 100%;
            height: 100%
        }

        #ctrl,body,canvas,h1,h2,h3,h4,html,li,table,td,th,tr,ul {
            margin: 0;
            padding: 0
        }

        body, html {
            overflow: hidden;
            background-color: #000;
            color: #fff;
            font: normal 14px Arial, Helvetica, sans-serif;
            text-align: center
        }

        #ctrl, #game, #hud, #load, #planet {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }

        #load {
            background-image: linear-gradient(#003, #033 50%, #000 0);
            opacity: 1
        }

        #load.hide {
            display: none
        }

        #hud, #load {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between
        }

        #hud div, #load div {
            width: 100%
        }

        #hud div:first-child, #load div:first-child {
            align-self: flex-start
        }

        #hud div:last-child, #load div:last-child {
            align-self: flex-end
        }

        ul {
            list-style: none
        }

        ul>li {
            position: absolute;
            letter-spacing: 3px;
            line-height: 60px;
            font-size: 24px;
            font-weight: 700
        }

        ul>li.hide {
            opacity: 0;
            transition: opacity 1s
        }

        h1 {
            font-size: 24px;
            letter-spacing: 5px;
            line-height: 80px
        }

        .displayCoinCount {
            width: 250px;
            height: 40px;
            font-size: 30px;
            background-color: blue;
            position: absolute;
            left: 20px;
            bottom: 30px;

            .fa-expand {
                color: white;
            }

            .my-swal {
                background: rgba(255, 255, 255, .8) !important;
                ;
            }

            .confirm {
                display: none;
            }

            .swal2-radio {
                display: grid !important;
            }

            .swal2-radio label {
                display: block
            }

            /* .swal2-modal .swal2-radio label {
      margin-left: 0px !important;
    } */

            .swal-wide {
                width: 850px !important;
            }

            /* .MCanswer{
                vertical-align: left;
                margin: 10px;
            } */



        }

        /* MC answer labels style */
        /* label { margin: 0px 0px 0px 0px; float: left;} */

        h2 {
            line-height: 30px
        }

        h2,
        h3 {
            font-size: 18px
        }

        h3 {
            height: 40px
        }

        h4 {
            line-height: 20px;
            font-size: 14px
        }

        h4.title {
            line-height: 25px;
            font-size: 20px
        }

        h4.done {
            text-decoration: line-through
        }

        p {
            margin: 10px 0;
            padding: 0
        }

        table {
            min-width: 250px;
            margin: 5px auto 0
        }

        th {
            text-align: left;
            font-weight: 400
        }

        td {
            text-align: right
        }

        .total {
            font-weight: 700;
            font-size: 18px;
            line-height: 25px
        }

        #quest {
            padding: 10px 0;
            background: rgba(0, 0, 0, .7);
            opacity: 1;
            visibility: hidden
        }

        #ctrl {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: center
        }

        #ctrl div {
            flex: 1 0 100%
        }

        #keys.hide, #touch.hide {
            display: none
        }

        i {
            position: absolute;
            display: block;
            top: 12px;
            width: 32px;
            line-height: 32px;
            font-size: 24px;
            font-style: normal;
            border-radius: 50%;
            cursor: pointer;
            color: #999
        }

        #sfx {
            right: 10px
        }

        #sfx:before {
            content: "♪";
            text-decoration: line-through
        }

        /* muted icon */
        #sfx.sfx:before {
            content: "♪";
            text-decoration: none
        }

        /* sfx sounds only icon */
        #sfx.allsounds:before {
            content: "♫";
            text-decoration: none
        }

        /* all sound icon */
        /* <!-- #fs{left:10px} -->
        <!-- #fs:before{content:"☐"} --> */
        a {
            display: inline-block;
            width: 100px;
            line-height: 48px;
            font-weight: 700;
            color: #000;
            text-shadow: 1px 1px 1px #fff;
            background-image: linear-gradient(#fff, #ccc);
            border: 2px solid #333;
            border-radius: 25px;
            padding: 0 20px;
            margin: 20px 5px;
            cursor: pointer;
            text-decoration: none
        }

        /* play and menu buttons on startup page */
        a.disabled {
            color: #999
        }

        .cyan {
            color: #2ff
        }

        .pink {
            color: #f2f
        }

        .red {
            color: #f22
        }

        .end #ctrl, .play #ctrl, .play a {
            visibility: hidden
        }

        .end #quest,
        .play #quest {
            visibility: visible
        }

        .play #quest {
            opacity: 0;
            transition: opacity 1s;
            transition-delay: 2.5s
        }

        .play table {
            display: none
        }

        * {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            -webkit-touch-callout: none;
            user-select: none
        }
    </style>
</head>

<body>

    <ul id="planet">
        <li style="background-image:url('./Photos/Earth.jpg')">SPACE</li>
        <li style="background-image:url('./Photos/Pluto2.jpg')">PLUTO</li>
        <li style="background-image:url('./Photos/Neptune.jpg')">NEPTUNE</li>
        <li style="background-image:url('./Photos/Uranus.jpg')">URANUS</li>
        <li style="background-image:url('./Photos/Saturn.jpg')">SATURN</li>
        <li style="background-image:url('./Photos/Jupiter.jpg')">JUPITER</li>
        <li style="background-image:url('./Photos/Mars.png')">MARS</li>
        <li style="background-image:url('./Photos/moon.jpg')">MOON</li>
    </ul>
    <canvas id="game" width="192" height="192"></canvas>

    <div id="hud">
        <div>
        </div>

        <div id="quest">
            <h4 class="title"></h4>
            <h4></h4><h4></h4>
            <table>
                <tr><th>Distance traveled</th><td></td></tr>
                <tr><th>Correct question answers</th><td></td></tr>
                <tr><th>Word guessing score</th><td></td></tr>
                <tr><th>Tokens collected</th><td></td></tr>
                <tr><th>Big tokens collected</th><td></td></tr>
                <tr><th>Asteroids destroyed</th><td></td></tr>
                <tr><th>Places visited</th><td></td></tr>
                <tr><th>Mission completed</th><td></td></tr>
                <tr>
                    <th class="total">TOTAL</th>
                    <td class="total"></td>
                </tr>
            </table>
        </div>

        <div><a id="ok">OK</a></div>
    </div>

    <div id="COINSCORE"> </div>


    <div id="ctrl">
        <h3>SPUTNIK</h3>
        <div style="position:absolute; top: 0px; left: 10px"> <a href="./menu.php"> MAIN MENU </a></div>

        <div>
            <h3></h3>
            <a id="prev">&lt;</a>
            <a id="play" class="">PLAY</a>
            <a id="next">&gt;</a>
        </div>
    </div>

    <div>
        <!-- <i class="fa-solid fa-expand" id="fs" title="Fullscreen"></i> -->
        <i id="sfx" title="Audio"></i>
    </div>

    <div id="load">
        <div>
            <h1>VASA-WIGGIN SPACEDASH</h1>
        </div>
        <div>
            <p id="keys">
                <b>MOVE</b> = <b>LEFT / RIGHT</b> arrow keys<br>
                <b>JUMP</b> = <b>UP</b> arrow key<br>
                <b>SHRINK</b> = <b>DOWN</b> arrow key<br>
                <b>BOOST</b> = <b>SPACE</b> key
            </p>
            <p id="touch"><b>JUMP</b> = Swipe <b>UP</b><br>
                <b>MOVE</b> = Swipe <b>LEFT / RIGHT</b><br>
                <b>SHRINK</b> = Swipe <b>DOWN</b><br>
                <b>BOOST</b> = <b>TAP</b>
            </p>
            <p>
                <b class="pink">BIG TOKENS</b> help you collect small ones.<br>
                Use <b>SHRINK</b> to go through <b class="red">SPACE JUNK</b>.<br>
                Use <b>BOOST</b> to destroy <b class="cyan">ASTEROIDS</b>.
            </p>
        </div>
        <div><a id="start">START</a></div>
        <div><a id="mainmenu" href="./menu.php">MAIN MENU</a></div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            function ajaxCall(thisroundscore) {
                /* fetch current leaderboard scores for this user*/
                <?php $dailyResult = mysqli_fetch_assoc($convertdayQuery);
                $weeklyResult = mysqli_fetch_assoc($convertweekQuery);
                $monthlyResult = mysqli_fetch_assoc($convertmonthQuery);
                $alltimeResult = mysqli_fetch_assoc($convertallQuery);
                ?>

                var thisusername = "<?php echo $user_data['user_name']; ?>";
                var thisuserid = "<?php echo $user_data['user_id']; ?>";
                var oldday = "<?php echo $dailyResult['Score']; ?>";
                var oldweek = "<?php echo $weeklyResult['Score']; ?>";
                var oldmonth = "<?php echo $monthlyResult['Score']; ?>";
                var oldalltime = "<?php echo $alltimeResult['Score']; ?>";
                console.log("old day ", oldday);
                console.log("old week ", oldweek);
                console.log("old alltime ", oldalltime);
                console.log("thisroundscore", thisroundscore);

                dayfinalscore = parseInt(oldday) + thisroundscore;
                weekfinalscore = parseInt(oldweek) + thisroundscore;
                monthfinalscore = parseInt(oldmonth) + thisroundscore;
                alltimefinalscore = parseInt(oldalltime) + thisroundscore;
                console.log("weekfinalscore", weekfinalscore);
                console.log("alltimefinalscore", alltimefinalscore);
                $.ajax({
                    // Our sample url to make request
                    url: 'ajaxcall.php',
                    // Type of Request
                    type: "post",
                    data: {
                        username: thisusername,
                        userid: thisuserid,
                        dayuserscore: dayfinalscore,
                        weekuserscore: weekfinalscore,
                        monthuserscore: monthfinalscore,
                        alltimeuserscore: alltimefinalscore
                    },
                    error: function(error) {
                        console.log(`Error ${error}`);
                    }
                });
            }

            var myQuestion;


            function entertrigger(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    document.getElementById("checkanswer").click();

                    /* document.removeEventListener("keyup", entertrigger, true); */
                }
            }




            /* Immediately-Invoked Function Expression (used to keep variables within a specific scope) */
            ! function(t) {

                var e = {};


                var xclaim = 2;

                function s(i) {
                    if (e[i]) return e[i].exports;
                    var r = e[i] = {
                        i: i,
                        l: !1,
                        exports: {}
                    };
                    return t[i].call(r.exports, r, r.exports, s), r.l = !0, r.exports
                }
                s.m = t, s.c = e, s.d = function(t, e, i) {
                    s.o(t, e) || Object.defineProperty(t, e, {
                        enumerable: !0,
                        get: i
                    })
                }, s.r = function(t) {
                    "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
                        value: "Module"
                    }), Object.defineProperty(t, "__esModule", {
                        value: !0
                    })
                }, s.t = function(t, e) {
                    if (1 & e && (t = s(t)), 8 & e) return t;
                    if (4 & e && "object" == typeof t && t && t.__esModule) return t;
                    var i = Object.create(null);
                    if (s.r(i), Object.defineProperty(i, "default", {
                            enumerable: !0,
                            value: t
                        }), 2 & e && "string" != typeof t)
                        for (var r in t) s.d(i, r, function(e) {
                            return t[e]
                        }.bind(null, r));
                    return i
                }, s.n = function(t) {
                    var e = t && t.__esModule ? function() {
                        return t.default
                    } : function() {
                        return t
                    };
                    return s.d(e, "a", e), e
                }, s.o = function(t, e) {
                    return Object.prototype.hasOwnProperty.call(t, e)
                }, s.p = "", s(s.s = 3)
            }([function(t, e) {
                t.exports = "precision mediump float;attribute vec3 aPos;attribute vec3 aNorm;uniform mat4 uWorld;uniform mat4 uProj;uniform mat3 uInverse;uniform float uStroke;varying vec4 vPos;varying vec3 vNorm;void main(){vec4 a;a.w=1.0;a.xyz=(aPos+(aNorm*uStroke));vPos=(uWorld*a);vNorm=(uInverse*aNorm);gl_Position=(uProj*vPos);}"
            }, function(t, e) {
                t.exports = "precision mediump float;uniform vec4 uColor;uniform vec3 uLight;varying vec4 vPos;varying vec3 vNorm;void main(){float a;vec3 b;b=normalize((uLight-vPos.xyz));vec3 c;c=normalize(vNorm);vec3 d;d=normalize(-(vPos.xyz));vec3 e;vec3 f;f=-(b);e=(f-(2.0*(dot(c,f)*c)));a=0.0;if((uColor.w>0.0)){a=pow(max(dot(e,d),0.0),uColor.w);}mediump vec4 g;g.w=1.0;g.xyz=(uColor.xyz*((vec3(0.2,0.2,0.2)+(vec3(0.8,0.8,0.8)*a))+(vec3(0.8,0.8,0.8)*max(dot(c,b),0.0))));gl_FragColor=g;}"
            }, function(t, e, s) {
            }, function(t, e, s) {
                var questionBank = {
                    "<em>If you go camping for more than a week, you would make sure you have plenty of food and the <b>gear</b> to cook and eat it with.</em> What is an example of <b>gear</b> in this context?": ["c", 1, "english", "A. a tent", "B. a hammer", "C. a saucepan", "D. a backpack"],
                    "The mass of four boxes are given below: <br> Box A: 4kg <br> Box B: 5kg <br> Box C: 20kg <br> Box D: 6kg <br> Which box requires the smallest force to lift it off the ground?": ["a", 1, "science", "A. Box A", "B. Box B", "C. Box C", "D. Box D"],
                    "Lee rides a bike for 15 minutes at a speed of 16 miles per hour. How far has he gone? ____ miles": ["4", 0, "math"],
                    "Which of these is an agricultural method that the Mayan obtained food?": ["a", 1, "social studies", "A. cutting and burning land to clear fields for planting", "B. picking berries from bushes in the forest", "C. using bows and arrows to hunt animals", "D. getting water from rivers"],
                    /*"Hanukkah is a festival celebrated by _____ people.": ["b", 1, social studies, "A. Christian", "B. Muslim", "C. Jewish", "D. Hindi"],*/
                    "To go from Europe to the United States, people need to cross the _____ Ocean.": ["b", 1, "social studies", "A. Pacific", "B. Atlantic", "C. Indian", "D. Eastern"],
                    "Which U.S. state below does not share a land border with any other U.S. state?": ["c", 1, "social studies", "A. Rhode Island", "B. Florida", "C. Alaska", "D. Delaware"],
                    "Trade happens when people exchange goods and services. Which of the following is an example of a trade?": ["b", 1, "social studies", "A. Tim's father give him a new bike", "B. Joe babysits for a family so he could stay at their house for free", "C. Jane donates her old clothes to the church", "D. Alice picks up 10 dollars on the street"],
                    "Many people around the world celebrate the New Year on January 1. But other people celebrate it on different days. Why is that?": ["c", 1, "social studies", "A. they are confused about what day it is", "B. they want to celebrate in the summer, when it's warmer", "C. they use different calendars", "D. they think celebrating on January 1 is bad luck"],
                    "Fill in the blank: In the beginning, Christopher Columbus thought he could find another route to the Indian Ocean by sailing ____ across the Atlantic Ocean.": ["d", 1, "history", "A. north", "B. south", "C. east", "D. west"],
                    "Fill in the blank: I’m afraid that all the tickets _____ sold when we arrive at the cinema tomorrow.": ["b", 1, "english", "A. were", "B. will have been", "C. had been", "D. are"],
                    "Fill in the blank: By next month, Rick and Morty _____ the house.": ["d", 1, "english", "A. will had furnished", "B. had furnished", "C. furnished", "D. will have furnished"],
                    "During the early 1900s, which part of the world did most Ohio immigrants come from?": ["c", 1, "social studies", "A. Asia", "B. Africa", "C. Europe", "D. South America"],
                    "Mark and his family were traveling from Columbus, Ohio to Cleveland, Ohio. What direction did they travel?": ["a", 1, "social studies", "A. North-east", "B. South", "C. Southwest", "D. North-west"],
                    "Which of the following states does NOT share a border with Ohio?": ["c", 1, "social studies", "A. Kentucky", "B. Pennsylvania", "C. Virginia", "D. West Virginia"],
                    "Fill in the blank: The War of 1812 was fought by the United States, the American Indians, and the _____": ["a", 1, "history", "A. Great Britain", "B. French", "C. Spanish", "D. Portuguese"],
                    "Dasha's grandfather has decided to become an American citizen. What will be one of his new responsibilities as a U.S. citizen?": ["c", 1, "social studies", "A. to enlist in the U.S. military", "B. to go to a U.S. college", "C. to serve on a jury", "D. to have at least 10 American friends"],
                    "Fill in the blank: The U.S. Constitution provides a framework that ____ the powers of government.": ["d", 1, "social studies", "A. removes", "B. increases", "C. abolishes", "D. limits"],
                    "If a historical event happened in the year 1022 CE, how many years ago was this event?": ["1000", 0, "history"],
                    "In this form of government, the people have a say in how the government is run.": ["b", 1, "social studies", "A. dictatorship", "B. democracy", "C. monarchy", "D. colonialism"],
                    "Fill in the blank: A dictatorship is a form of government in which a person or a small group rules with almost unlimited _____.": ["c", 1, "social studies", "A. money", "B. resources", "C. power", "D. time"],
                    "What language was NOT introduced in the Americas as a result of European exploration and colonization?": ["c", 1, "social studies", "A. Spanish", "B. English", "C. Russian", "D. French"],
                    "Fill in the blank: The four early civilizations in the Americas were the Mayan, the Mississipian, the Aztec, and the _____": ["Inca", 0, "social studies"],
                    "Fill in the blank: Latitude and ______ can be used to determine locations on a map": ["longitude", 0, "social science"],
                    "What is 8 x 7 ?": ["56", 0, "math"],
                    "What is 9 x 8 ?": ["72", 0, "math"],
                    "What is 10 x 33 ?": ["330", 0, "math"],
                    "What is 4 x (1 + 2 x 12) ?": ["100", 0, "math"],
                    "What is the first step in the order of operations?": ["d", 1, "social studies", "A. exponents", "B. multiplication", "C. subtraction", "D. parentheses"],
                    "A student views an object in a mirror. Light moves from the ____ to the ____ to the ____.": ["c", 1, "physics", "A. eyes; mirror; object", "B. eyes; object; mirror", "C. object; mirror; eyes", "D. mirror; object; eyes"],
                    "What statement below can explain why seasons change on Earth?": ["a", 1, "space", "A. The earth’s axis is tilted", "B. The distance from Earth to the moon changes", "C. The amount of heat given off by the sun changes throughout the year", "D. The earth has a round shape"],
                    "Hummingbirds feed on the nectar of flowering plants. In this process, they also pollinate the plants. Which symbiotic relationship does this represent?": ["c", 1, "nature", "A. commensalism", "B. predator-prey", "C. mutualism", "D. parasitism"],
                    "Light is sometimes reflected when it strikes an object. Which behavior of sound is similar to light being reflected?": ["a", 1, "science", "A. echoing off a cliff", "B. being absorbed by walls", "C. bending around a building", "D. traveling through air"],
                    "Ticks live on the zebras’ skin and feed off their blood. These ticks can cause infection and spread disease. Which word describes the relationship between zebras and ticks?": ["c", 1, "nature", "A. Predator-prey", "B. Mutualism", "C. Parasitism", "D. Commensalism"],
                    "This object in our solar system is small, cold, and it orbits around a planet. This object is a ____": ["moon", 0, "space"],
                    "It’s currently daytime at Mount Vernon. In 12 hours, it would be nighttime in Mount Vernon. Why is that?": ["d", 1, "space", "A. Earth is tilted on its axis", "B. Earth has a round shape", "C. Earth orbits around the sun", "D. Earth rotates around its axis"],
                    "Julia stacks books on a skateboard and pushes it down a hall. What can she do that would NOT make the skateboard reach the end of the hall faster?": ["b", 1, "science", "A. push it with greater force", "B. replace one of the books with a heavier book", "C. remove one book from the stack", "D. remove all the books"],
                    "‘As on Earth, space food comes in <b>disposable</b> packages. Astronauts must throw their packages away when they have finished eating.’ <br> What does the word ‘disposable’ suggest about the packages?": ["c", 1, "english", "A. They are inconvenient", "B. They are large", "C. They are used once", "D. They are heavy"],
                    "Erika creates a number pattern. Her first term is 1, and the rule is ‘Multiply by 2’. What is the fourth term in her pattern?": ["8", 0, "math"],
                    "In a coordinate plane, point A is located at (1,1). Point B is 1 unit to the right of point A and 1 unit down. Where is point B located?": ["d", 1, "math", "A. (2,2)", "B. (1,0)", "C. (2,1)", "D. (2,0)"],
                    "Select the expression that is NOT equivalent to 12+24": ["b", 1, "math", "A. 3(4+8)", "B. 0(12+24)", "C. 0+(12+24)", "D. 4(3+6)"],
                    "What number below rounds to 82?": ["c", 1, "math", "A. 82.65", "B. 82.50", "C. 81.56", "D. 83.0001"],
                    "A large cube has a volume of 216 cubic meters. It is completely filled with smaller cubes, each with a volume of 8 cubic meters. How many smaller cubes are in the large cube?": ["27", 0, "math"],
                    "The area of Keiko's backyard is 6 acres. She plants a garden that takes up a third of the backyard. What is the area of Keiko's garden?": ["b", 1, "math", "A. 3 acres", "B. 2 acres", "C. 6 acres", "D. 1 acre"],
                    "0.5 x 24 = ?": ["12", 0, "math"],
                    "How many times is 5 greater than 0.05?": ["100", 0, "math"],
                    "What property below is NOT shared by all squares and trapezoids?": ["d", 1, "math", "A. have 4 sides", "B. have 4 angles", "C. have at least 1 pair of parallel sides", "D. have two acute angles"],
                    "What expression below has a value less than 1,000?": ["c", 1, "math", "A. 1,000 x 1", "B. 1,000 x 1.25", "C. 1,000 x 0.25", "D. 500 x 2"],
                    "What is 2+2?": ["4", 0, "math"],
                    "One night while camping, a student observes that the moon and stars appear to move across the sky. Which statement describes why the moon and stars appear to change position?": ["a", 1, "space", "A. Earth rotates", "B. Earth is tilted", "C. Earth orbits the sun", "D. Earth moves away from the sun"],
                    "James bought 5/4 pounds of rice. Which decimal is equivalent to the amount of rice that he bought?": ["1.25", 0, "math"],
                    "What is the smallest planet in the solar system?": ["mercury", 0, "space"],
                    "Ian mowed one fourth of the yard today. This is equivalent to ___ percent.": ["25", 0, "math"],
                    "What celestial body is made of ice and gas?": ["comet", 0, "space"],
                    "5 minutes 34 seconds is ___ seconds": ["334", 0, "math"],
                    "Which motion causes the change from day to night on Earth?": ["b", 1, "space", "A. Earth orbiting the Sun", "B. Earth rotating on its axis", "C. the moon orbiting Earth", "D. the moon rotating on its axis"],
                    "6 feet 10 inches is ___ inches": ["82", 0, "math"],
                    "Fill in the blank: Bees help flowers reproduce by carrying ___ to other flowers.": ["pollen", 0, "nature"],
                    "Mr. Skon has been driving a car at 50 miles per hour for 90 minutes. How many miles has he traveled?": ["75", 0, "math"],
                    "Which of the following is not a carnivore?": ["c", 1, "nature", "A. Cougar", "B. Snake", "C. Giraffe", "D. Lion"],
                    "If Earth has an orbital radius of 150 million kilometers, and Mars has an orbital radius of 228 million kilometers, then does Earth have a <b>shorter</b> or <b>longer</b> year than Mars? ": ["shorter", 0, "space"],
                    "A store only sells 20-pound bags of ice. Over the weekend, the store sells 700 bags of ice, making $2,800. On Monday, the store sells 70 bags of ice.<br>How much (in dollars) does the store make selling ice on Monday? Enter the number in the box.": ["280", 0, "math"],
                    "What number below is larger than 32.42?": ["c", 1, "math", "A. 32.418", "B. 32.399", "C. 32.502", "D. 31.98"],
                    "If a rectangle's area is 3,500 centimeters squared and its length is 100, what is its width? __ cm": ["35", 0, "math"],
                    "If we divide 51 by 9, the result is between... ": ["c", 1, "math", "A. 3 and 4", "B. 4 and 5", "C. 5 and 6", "D. 6 and 7"],
                    "If a cube's side length is 4, what is its volume?": ["64", 0, "math"],
                    "Which number rounds to 3.8?": ["d", 1, "math", "A. 3.73", "B. 3.70", "C. 3.87", "D. 3.82"],
                    "Which of the following organisms operate as decomposers?": ["a", 1, "nature", "A. Bacteria", "B. Plants", "C. Insects", "D. Animals"],
                    "Which of the following years is furthest back in history?": ["b", 1, "math", "A. 100 A.D.", "B. 50 B.C.", "C. 3 B.C.", "D. 18 A.D."],
                    "Which two continents are located completely in the Western Hemisphere?": ["c", 1, "social studies", "A. Asia and Europe", "B. South America and Africa", "C. North America and South America", "D. Antarctica and Asia"]
                };
                const chosenQuestions = [];

                var currentCorrectAnswer = "";
                var longCorrectAnswer = "";
                var wordBank = {
                    math: ["noun", "subject", "arithmetic"],
                    giraffe: ["noun", "animal", "neck"],
                    escalate: ["verb", "increase rapidly", "shopping mall transportation"],
                    influence: ["verb or noun", "impact", "Win Friends and ____ People"],
                    equivalent: ["noun or adjective", "equal", "mean the same thing"],
                    priority: ["noun", "first things first", "____ mail"],
                    decisive: ["adjective", "no hesitation", "able to choose"],
                    entrepreneur: ["noun", "businessperson", "creates a startup company"],
                    environmental: ["adjective", "relating to nature", "eco-friendly"],
                    migration: ["noun", "move to another place", "The Great ____"],
                    resource: ["noun", "something people use or need", "natural ____"],
                    illustrate: ["verb", "show", "exhibit", "draw"],
                    simulation: ["noun", "digital reproduction", "mock reality"],
                    decompose: ["verb", "plants do this when they die", "fall apart"],
                    interaction: ["noun", "exchange", "correspondence"],
                    community: ["noun", "group of people", "sitcom title"],
                    characteristic: ["noun", "feature", "attribute"],
                    obstacle: ["noun", "challenge", "____ course"],
                    stubborn: ["adjective", "like a donkey", "won’t change their mind"],
                    collaborate: ["verb", "a group does this", "work together"],
                    integrate: ["verb", "combine", "math term"],
                    hilarious: ["adjective", "4 syllables", "funny"],
                    horrific: ["adjective", "ghastly", "terrible, very terrible"],
                    effortless: ["adjective", "easy", "requiring little energy"],
                    abolish: ["verb", "eliminate", "usually used in the context of politics"],
                    provide: ["verb", "give", "supply"],
                    summer: ["noun", "hot", "season"]
                };

                var qsscore = 0;
                var hmscore = 0;
                var dayfinalscore = 0;
                var weekfinalscore = 0;
                var monthfinalscore = 0;
                var alltimefinalscore = 0;
                var hangmanWord = ""; // PARTIAL GUESS WORD
                var correctAnswers = 0; // NUMBER OF CORRECT ANSWERS
                var randomlySelectedWord = ""; // GUESS WORD INITIALLY SELECTED BY THE COMPUTER
                const allRandomPositions = []; // ARRAY STORING ALL GENERATED RANDOM NUMBERS
                var incorrectGuesses = 0;
                var guessIsCorrect = false;
                var closeHangman = false;
                /* var cumulativescore=0; */
                "use strict";
                s.r(e);
                s(2);
                var continueGame = 1;
                class i {
                    static on(t, e) {
                        const s = t.match(/[a-zA-Z]+/g);
                        s && s.forEach(t => {
                            t in i.listener || (i.listener[t] = []), i.listener[t].push(e)
                        })
                    }
                    static trigger(t, e) {
                        i.listener.all.forEach(s => {
                            s(t, e)
                        }), t in i.listener && i.listener[t].forEach(s => {
                            s(t, e)
                        })
                    }
                }
                i.listener = {
                    all: []
                };
                const r = {
                        coin: "Collect $ token",
                        power: "Collect $ big token",
                        planet: "Travel to $",
                        fence: "Dodge junk $ time",
                        enemy: "Dodge asteroids $ time",
                        hit: "Destroy $ asteroid"
                    },
                    n = ["Mars", "Jupiter", "Saturn", "Uranus", "Neptune", "Pluto", "Space"];
                class a {
                    constructor(t, e, s = !1) {
                        this.event = t, this.target = e, this.count = 0, this.run = s || "planet" == t, this.done = !1
                    }
                    init() {
                        !this.done && this.run && (this.count = 0)
                    }
                    on(t) {
                        this.done || this.event != t || (this.done = this.target <= ++this.count)
                    }
                    toString() {
                        let t = this.event,
                            e = r[t],
                            s = this.target.toString();
                        return "planet" == t ? s = n[this.target - 1] : (this.target > 1 && (e += "s"), this.run && (e += " on a mission"), !this.done && this.count && (s += " / " + this.count)), e.replace("$", s)
                    }
                }
                window.AudioContext = window.AudioContext || window.webkitAudioContext, window.OfflineAudioContext = window.OfflineAudioContext || window.webkitOfflineAudioContext;
                const o = new AudioContext,
                    h = {},
                    c = {},
                    l = {
                        c: 0,
                        db: 1,
                        d: 2,
                        eb: 3,
                        e: 4,
                        f: 5,
                        gb: 6,
                        g: 7,
                        ab: 8,
                        a: 9,
                        bb: 10,
                        b: 11
                    },
                    u = [];
                let m;
                class d {
                    constructor(t, e, s) {
                        this.type = t, this.length = s, this.curve = Float32Array.from(e)
                    }
                    getTime(t) {
                        return (t < this.length ? t : this.length) - .01
                    }
                }
                class f {
                    constructor(t, e, s) {
                        this.inst = t, this.size = 0, this.length = 0, this.data = [];
                        let i = e.split("|");
                        if (i.length > 1) {
                            e = "";
                            for (let t = 0; t < i.length; t++) e += t % 2 ? ("," + i[t - 1]).repeat(parseInt(i[t]) - 1) : (e ? "," : "") + i[t]
                        }
                        e.split(",").forEach(t => {
                            let e = t.match(/^(\d+)/),
                                i = t.match(/([a-z]+\d+)/g);
                            if (e) {
                                let t = s / parseInt(e[1]),
                                    r = [t];
                                if (this.length += t, i) {
                                    i.length > this.size && (this.size = i.length);
                                    for (let t = 0; t < i.length; t++) {
                                        let e = i[t].match(/([a-z]+)(\d+)/);
                                        e && r.push(u[12 * parseInt(e[2]) + l[e[1]]])
                                    }
                                }
                                this.data.push(r)
                            }
                        })
                    }
                    play(t) {
                        let e = 0;
                        const s = this.inst,
                            i = t.createGain(),
                            r = [];
                        i.connect(t.destination);
                        for (let e = 0; e < this.size; e++) r[e] = t.createOscillator(), r[e].type = s.type, r[e].connect(i);
                        this.data.forEach(t => {
                            s.curve && i.gain.setValueCurveAtTime(s.curve, e, s.getTime(t[0])), r.forEach((s, i) => {
                                s.frequency.setValueAtTime(t[i + 1] || 0, e)
                            }), e += t[0]
                        }), r.forEach(t => {
                            t.start(), t.stop(e)
                        })
                    }
                }
                var p = {
                    async init() {
                        "suspended" === o.state && await o.resume();
                        const t = Math.pow(2, 1 / 12);
                        for (let e = -57; e < 50; e++) u.push(440 * Math.pow(t, e));
                        m = o.createBuffer(1, 88200, 44100);
                        const e = m.getChannelData(0);
                        for (let t = 0; t < 88200; t++) e[t] = 2 * Math.random() - 1
                    },
                    async sound(t, e, s, i) {
                        const r = new OfflineAudioContext(1, 44100 * i, 44100),
                            n = r.createGain(),
                            a = Float32Array.from(s);
                        if (n.connect(r.destination), e.curve && n.gain.setValueCurveAtTime(e.curve, 0, e.getTime(i)), r.addEventListener("complete", e => c[t] = e.renderedBuffer), "custom" == e.type) {
                            const t = r.createBiquadFilter();
                            t.connect(n), t.detune.setValueCurveAtTime(a, 0, i);
                            const e = r.createBufferSource();
                            e.buffer = m, e.loop = !0, e.connect(t), e.start()
                        } else {
                            const t = r.createOscillator();
                            t.type = e.type, t.frequency.setValueCurveAtTime(a, 0, i), t.connect(n), t.start(), t.stop(i)
                        }
                        await r.startRendering()
                    },
                    async music(t, e) {
                        const s = e.reduce((t, e) => e.length > t ? e.length : t, 0),
                            i = new OfflineAudioContext(1, 44100 * s, 44100);
                        i.addEventListener("complete", e => c[t] = e.renderedBuffer), e.forEach((t, e) => t.play(i)), await i.startRendering()
                    },
                    mixer: t => (t in h || (h[t] = o.createGain(), h[t].connect(o.destination)), h[t]),
                    play(t, e = !1, s = "master") {
                        if (t in c) {
                            let i = o.createBufferSource();
                            return i.loop = e, i.buffer = c[t], i.connect(this.mixer(s)), i.start(), i
                        }
                        return null
                    }
                };
                const g = Math.PI / 180;
                class x {
                    constructor(t = 0, e = 0, s = 0) {
                        this.x = t, this.y = e, this.z = s
                    }
                    set(t, e, s) {
                        return t instanceof x ? (this.x = t.x, this.y = t.y, this.z = t.z, this) : ("number" == typeof t && (this.x = t), "number" == typeof e && (this.y = e), "number" == typeof s && (this.z = s), this)
                    }
                    max() {
                        return Math.max(this.x, this.y, this.z)
                    }
                    add(t) {
                        return this.x += t.x, this.y += t.y, this.z += t.z, this
                    }
                    sub(t) {
                        return this.x -= t.x, this.y -= t.y, this.z -= t.z, this
                    }
                    distance(t) {
                        return Math.sqrt((this.x - t.x) * (this.x - t.x) + (this.y - t.y) * (this.y - t.y) + (this.z - t.z) * (this.z - t.z))
                    }
                    dot(t) {
                        return this.x * t.x + this.y * t.y + this.z * t.z
                    }
                    cross(t) {
                        let e = this.x,
                            s = this.y,
                            i = this.z,
                            r = t.x,
                            n = t.y,
                            a = t.z;
                        return this.x = s * a - i * n, this.y = i * r - e * a, this.z = e * n - s * r, this
                    }
                    length() {
                        return Math.sqrt(this.x * this.x + this.y * this.y + this.z * this.z)
                    }
                    scale(t) {
                        return this.x *= t instanceof x ? t.x : t, this.y *= t instanceof x ? t.y : t, this.z *= t instanceof x ? t.z : t, this
                    }
                    normalize() {
                        var t = this.length();
                        return t > 0 && this.scale(1 / t), this
                    }
                    clone() {
                        return new x(this.x, this.y, this.z)
                    }
                    invert() {
                        return this.x = -this.x, this.y = -this.y, this.z = -this.z, this
                    }
                    toArray() {
                        return [this.x, this.y, this.z]
                    }
                }
                class w {
                    constructor(t = [1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1]) {
                        this.data = t
                    }
                    clone() {
                        return new w(this.data)
                    }
                    multiply(t) {
                        const e = this.data,
                            s = e[0],
                            i = e[1],
                            r = e[2],
                            n = e[3],
                            a = e[4],
                            o = e[5],
                            h = e[6],
                            c = e[7],
                            l = e[8],
                            u = e[9],
                            m = e[10],
                            d = e[11],
                            f = e[12],
                            p = e[13],
                            g = e[14],
                            x = e[15],
                            w = t[0],
                            y = t[1],
                            v = t[2],
                            b = t[3],
                            k = t[4],
                            z = t[5],
                            T = t[6],
                            A = t[7],
                            C = t[8],
                            E = t[9],
                            S = t[10],
                            M = t[11],
                            N = t[12],
                            P = t[13],
                            R = t[14],
                            I = t[15];
                        return this.data = [s * w + i * k + r * C + n * N, s * y + i * z + r * E + n * P, s * v + i * T + r * S + n * R, s * b + i * A + r * M + n * I, a * w + o * k + h * C + c * N, a * y + o * z + h * E + c * P, a * v + o * T + h * S + c * R, a * b + o * A + h * M + c * I, l * w + u * k + m * C + d * N, l * y + u * z + m * E + d * P, l * v + u * T + m * S + d * R, l * b + u * A + m * M + d * I, f * w + p * k + g * C + x * N, f * y + p * z + g * E + x * P, f * v + p * T + g * S + x * R, f * b + p * A + g * M + x * I], this
                    }
                    scale(t) {
                        return this.multiply([t.x, 0, 0, 0, 0, t.y, 0, 0, 0, 0, t.z, 0, 0, 0, 0, 1])
                    }
                    translate(t) {
                        return this.multiply([1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, t.x, t.y, t.z, 1])
                    }
                    rotateX(t) {
                        const e = Math.cos(t),
                            s = Math.sin(t);
                        return this.multiply([1, 0, 0, 0, 0, e, s, 0, 0, -s, e, 0, 0, 0, 0, 1])
                    }
                    rotateY(t) {
                        const e = Math.cos(t),
                            s = Math.sin(t);
                        return this.multiply([e, 0, -s, 0, 0, 1, 0, 0, s, 0, e, 0, 0, 0, 0, 1])
                    }
                    rotateZ(t) {
                        const e = Math.cos(t),
                            s = Math.sin(t);
                        return this.multiply([e, s, 0, 0, -s, e, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1])
                    }
                    rotate(t) {
                        return this.rotateX(t.x).rotateY(t.y).rotateZ(t.z)
                    }
                    invert() {
                        let t = this.data,
                            e = t[0],
                            s = t[1],
                            i = t[2],
                            r = t[4],
                            n = t[5],
                            a = t[6],
                            o = t[8],
                            h = t[9],
                            c = t[10],
                            l = c * n - a * h,
                            u = -c * r + a * o,
                            m = h * r - n * o,
                            d = e * l + s * u + i * m;
                        if (!d) return null;
                        const f = 1 / d,
                            p = [l * f, (-c * s + i * h) * f, (a * s - i * n) * f, u * f, (c * e - i * o) * f, (-a * e + i * r) * f, m * f, (-h * e + s * o) * f, (n * e - s * r) * f];
                        return s = p[1], i = p[2], a = p[5], p[1] = p[3], p[2] = p[6], p[3] = s, p[5] = p[7], p[6] = i, p[7] = a, p
                    }
                }
                class y {
                    constructor(t, e = t.scale) {
                        this.transform = t, this.scale = e
                    }
                    getTranslate() {
                        let t = this.transform.translate.clone(),
                            e = this.transform.parent;
                        for (; e;) t.scale(e.scale).add(e.translate), e = e.parent;
                        return t
                    }
                    getScale() {
                        let t = this.scale.clone().scale(.5),
                            e = this.transform.parent;
                        for (; e;) t.scale(e.scale), e = e.parent;
                        return t
                    }
                }
                class v extends y {
                    intersect(t) {
                        let e = null,
                            s = this.getTranslate(),
                            i = t.getTranslate(),
                            r = s.distance(i),
                            n = this.getScale().max() + t.getScale().max();
                        return r < n && (e = i.sub(s).normalize().scale(n - r)), e
                    }
                }
                class b extends y {
                    intersect(t) {
                        let e = this.getTranslate(),
                            s = this.getScale(),
                            i = t.getTranslate(),
                            r = t.getScale().max(),
                            n = new x(Math.max(e.x - s.x, Math.min(i.x, e.x + s.x)), Math.max(e.y - s.y, Math.min(i.y, e.y + s.y)), Math.max(e.z - s.z, Math.min(i.z, e.z + s.z))),
                            a = n.distance(i),
                            o = null;
                        return a < r && (o = i.sub(n).normalize().scale(r - a)), o
                    }
                }
                class k {
                    constructor(t = []) {
                        this.translate = new x(t[0] || 0, t[1] || 0, t[2] || 0), this.rotate = new x(t[3] || 0, t[4] || 0, t[5] || 0), this.scale = new x(t[6] || 1, t[7] || 1, t[8] || 1)
                    }
                    matrix(t) {
                        return (t = t || new w).scale(this.scale).rotate(this.rotate.clone().scale(g)).translate(this.translate), this.parent ? this.parent.matrix(t) : t
                    }
                }
                class z {
                    constructor(t, e, s) {
                        this.mesh = t, this.color = e, this.childs = [], this.active = !0, this.stroke = 0, this.transform = new k(s)
                    }
                    add(t) {
                        return this.childs.push(t), t.transform.parent = this.transform, this
                    }
                }
                class T {
                    constructor(t, e, s) {
                        this.verts = [], this.normals = [], t.addFace(this), e.addFace(this), s.addFace(this), this.verts.push(t, e, s), this.normal = e.clone().sub(t).cross(s.clone().sub(t)).normalize()
                    }
                    calcNormals(t) {
                        return this.verts.forEach((e, s) => {
                            let i;
                            e.faces.forEach(e => {
                                this.normal.dot(e.normal) > t && (i = i ? i.add(e.normal) : e.normal.clone())
                            }), this.normals.push(i ? i.normalize() : this.normal)
                        }), this
                    }
                    pushVerts(t) {
                        return this.verts.forEach(e => {
                            t.push(...e.toArray())
                        }), this
                    }
                    pushNormals(t) {
                        return this.normals.forEach(e => {
                            t.push(...e.toArray())
                        }), this
                    }
                }
                class A extends x {
                    constructor() {
                        super(...arguments), this.faces = []
                    }
                    addFace(t) {
                        return this.faces.push(t), this
                    }
                }
                class C {
                    constructor(t, e, s = [], i = 0, r = 360) {
                        if (e < 2) return;
                        s.length < 2 && (s = this.sphere(s.length > 0 ? s[0] + 2 : Math.ceil(e / 2) + 1));
                        const n = this.createVerts(e, s, 0, r),
                            a = this.createFaces(n, e, s.length / 2),
                            o = Math.cos(i * g),
                            h = [],
                            c = [];
                        a.forEach(t => {
                            t.calcNormals(o).pushVerts(h).pushNormals(c)
                        }), this.verts = t.createBuffer(), t.bindBuffer(t.ARRAY_BUFFER, this.verts), t.bufferData(t.ARRAY_BUFFER, new Float32Array(h), t.STATIC_DRAW), this.normals = t.createBuffer(), t.bindBuffer(t.ARRAY_BUFFER, this.normals), t.bufferData(t.ARRAY_BUFFER, new Float32Array(c), t.STATIC_DRAW), this.length = h.length / 3
                    }
                    sphere(t) {
                        const e = [];
                        if (t < 3) return;
                        let s = Math.PI / (t - 1);
                        for (let i = 1; i < t - 1; i++) {
                            let t = s * i;
                            e.push(Math.sin(t) / 2), e.push(Math.cos(t) / 2)
                        }
                        return e
                    }
                    createVerts(t, e, s, i) {
                        let r = [],
                            n = ((i *= g) - (s *= g)) / t;
                        r.push(new A(0, .5, 0)), r.push(new A(0, -.5, 0));
                        for (let i = 0; i < t; i++) {
                            let t = n * i + s,
                                a = Math.cos(t),
                                o = Math.sin(t);
                            for (let t = 0; t < e.length; t += 2) {
                                let s = new A(a, 0, o);
                                s.scale(e[t]).y = e[t + 1], r.push(s)
                            }
                        }
                        return r
                    }
                    createFaces(t, e, s) {
                        const i = [];
                        let r;
                        for (let n = 1; n < e; ++n) {
                            r = n * s + 2, i.push(new T(t[0], t[r], t[r - s])), i.push(new T(t[1], t[r - 1], t[r + s - 1]));
                            for (let e = 0; e < s - 1; e++) {
                                let n = r + e;
                                i.push(new T(t[n + 1], t[n - s], t[n])), i.push(new T(t[n - s + 1], t[n - s], t[n + 1]))
                            }
                        }
                        i.push(new T(t[0], t[2], t[r])), i.push(new T(t[1], t[r + s - 1], t[s + 1]));
                        for (let e = 0; e < s - 1; e++) {
                            let s = r + e;
                            i.push(new T(t[e + 3], t[s], t[e + 2])), i.push(new T(t[s + 1], t[s], t[e + 3]))
                        }
                        return i
                    }
                }
                class E extends z {
                    update(t) {
                        let e = this.transform.translate;
                        e.z += t;
                        let s = e.z > 2;
                        s && (e.z -= 11);
                        let i = 1;
                        return e.z < -8 ? i = e.z + 9 : e.z > 1 && (i = 2 - e.z), this.transform.scale.set(i, i, i), this.token.update(), this.enemy.update(t, s), s
                    }
                    intersect(t, e = !1) {
                        if (!t.active || t.stroke) return;
                        let s, i = this.fence;
                        return this.token.intersect(t), i.active && (s = i.collider.intersect(t.collider), s && (e && s.x && t.cancel(), t.transform.translate.add(s), t.speed.y += s.y)), this.block.active ? (s = this.block.collider.intersect(t.collider), s && (e && s.x && t.cancel(), t.transform.translate.add(s), t.speed.y += s.y), s) : void 0
                    }
                }
                class S extends z {
                    init(t) {
                        this.active = t, this.stroke = 0, this.explode = 0, this.transform.rotate.set(0, 0, 0), this.transform.translate.set(0, 1, 0)
                    }
                    update(t, e) {
                        if (!this.active) return;
                        if (this.stroke += (this.explode - this.stroke) / 25, this.stroke) return;
                        let s = this.transform.translate,
                            i = this.transform.rotate;
                        s.z = e ? 0 : s.z + t / 2, i.z = (i.z + 5) % 360, i.x = (i.x + 3) % 360
                    }
                    intersect(t) {
                        if (this.active && !this.explode && !t.explode && this.collider.intersect(t.collider)) {
                            if (t.speedTime) return this.explode = 7, void i.trigger("hit", t);
                            t.explode = 7, i.trigger("exp", t)
                        }
                    }

                    done() {
                        this.explode = 1;
                    }
                }
                const M = [1, 1, .3, 30],
                    N = [1, .3, 1, 30];
                class P extends z {
                    constructor() {
                        super(...arguments), this.big = !1
                    }
                    init(t) {
                        this.active = t, this.transform.translate.set(0, 1, 0), this.big = !_.get(50, 0, !0), this.speed = .01
                    }
                    score() {
                        return this.big ? 5 : 1
                    }
                    update() {
                        let t = this.transform.rotate,
                            e = this.transform.scale;
                        t.y = (t.y + 1.5) % 360, this.big ? (e.set(.7, .15, .7), this.color = N) : (e.set(.5, .1, .5), this.color = M)
                    }
                    intersect(t) {
                        let e = this.big ? t.collider : t.tokenCollider;
                        if (this.active && this.collider.intersect(e)) {
                            let e = this.collider.getTranslate();
                            if (e.distance(t.transform.translate) < .5) return this.active = !1, void(this.big ? t.magnetize() : t.coin());
                            this.speed += this.speed, this.transform.translate.add(t.transform.translate.clone().sub(e).scale(this.speed))
                        }
                    }
                }
                var R = s(0),
                    I = s.n(R),
                    F = s(1),
                    O = s.n(F);

                function B(t, e) {
                    return (e || document).querySelector(t)
                }

                function L(t, e, s, i = !1) {
                    t.addEventListener(e, s, i)
                }
                s.d(e, "$", (function() {
                    return B
                })), s.d(e, "on", (function() {
                    return L
                })), s.d(e, "Rand", (function() {
                    return _
                })), s.d(e, "COLOR", (function() {
                    return D
                }));
                class _ {
                    static get(t = 1, e = 0, s = !0) {
                        if (t <= e) return t;
                        _.seed = (9301 * _.seed + 49297) % 233280;
                        let i = e + _.seed / 233280 * (t - e);
                        return s ? Math.round(i) : i
                    }
                }
                _.seed = Math.random();
                const D = {
                    WHITE: [1, 1, 1, 10],
                    GREEN: [.3, 1, .5, 10],
                    /*new color test*/
                    ORANGE: [1, 0.588, 0.380, 10],
                    /*new color test*/
                    AVATAR: [<?= $avcolor1 ?>, <?= $avcolor2 ?>, <?= $avcolor3 ?>, 10],
                    PINK: [1, .3, 1, 30],
                    BLUE: [.3, .3, 1, 30],
                    YELLOW: [1, 1, .3, 30],
                    RED: [1, .3, .3, 0],
                    CYAN: [.3, 1, 1, 30]
                };
                let V, Y = !1,
                    j = B("#game"),
                    U = new class {
                        constructor() {
                            let t = JSON.parse(window.localStorage.getItem("offliner_hi"));
                            this.body = B("body"), this.btn = B("#play"), this.info = document.getElementsByTagName("H3"), this.shop = !0, this.active = !0, this.storage = t && "object" == typeof t && "shop" in t ? t : {
                                score: 0,
                                token: 0,
                                level: 0,
                                shop: [0]
                            }, this.selected = 0, this.heroes = [{
                                name: "SPUTNIK",
                                price: 0
                            }, {
                                name: "VOYAGER",
                                price: 500
                            }, {
                                name: "PIONEER",
                                price: 1e3
                            }, {
                                name: "CASSINI",
                                price: 2500
                            }], this.tasklist = document.getElementsByTagName("H4"), this.scores = document.getElementsByTagName("TD"), this.stats = {}, this.sfxBtn = B("#sfx"), /*this.musicvolume = this.musicvolume,*/ this.hero(), this.bind(), this.init()

                        }
                        level() {
                            return this.storage.level + 1
                        }
                        init() {
                            let t = this.level(),
                                e = [],
                                s = Math.ceil(t / 3);
                            switch (t % 3) {
                                case 1:
                                    e.push(new a("coin", 75 * s));
                                    break;
                                case 2:
                                    e.push(new a("power", s, s % 2 == 0));
                                    break;
                                default:
                                    e.push(new a("coin", 50 * s, !0))
                            }
                            switch (s = Math.ceil(t / 4), t % 4) {
                                case 1:
                                    e.push(s < 8 ? new a("planet", s) : new a("hit", s, !0));
                                    break;
                                case 2:
                                    e.push(s % 2 == 1 ? new a("fence", 5 * s) : new a("fence", 3 * s, !0));
                                    break;
                                case 3:
                                    e.push(s % 2 == 1 ? new a("enemy", 3 * s) : new a("enemy", 2 * s, !0));
                                    break;
                                default:
                                    e.push(new a("hit", s))
                            }
                            this.tasks = e
                        }
                        bind() {
                            L(B("#ok"), "click", () => {
                                i.trigger("end")
                            }), L(this.btn, "click", () => {
                                this.play()
                            }), L(B("#prev"), "click", () => {
                                this.prev()
                            }), L(B("#next"), "click", () => {
                                this.next()
                                // }), L(B("#fs"), "click", () => {
                                //     document.webkitFullscreenElement ? document.webkitExitFullscreen && document.webkitExitFullscreen() : document.documentElement.webkitRequestFullscreen()
                            }), L(this.sfxBtn, "click", () => {
                                let t = this.sfxBtn,
                                    e = p.mixer("music"),
                                    s = p.mixer("master"),
                                    i = s.context.currentTime;
                                try {
                                    switch (t.className) {
                                        default:
                                            /* switch from muted/default to sfx sounds (e = on, s=0) only */
                                            this.musicvolume = 0, this.sfxvolume = 0.1, e.gain.setValueAtTime(this.musicvolume, i), s.gain.setValueAtTime(this.sfxvolume, i), t.className = "sfx";
                                            break;
                                        case "sfx":
                                            /* switch from sfx sounds only to all sounds (e & s = on)*/
                                            this.musicvolume = 0.05, e.gain.setValueAtTime(this.musicvolume, i), s.gain.setValueAtTime(this.sfxvolume, i), t.className = "allsounds";
                                            break;
                                        case "allsounds":
                                            /* switch from all sounds to muted/default (e & s = 0)*/
                                            this.musicvolume = 0, this.sfxvolume = 0, e.gain.setValueAtTime(this.musicvolume, i), s.gain.setValueAtTime(this.sfxvolume, i), t.className = ""
                                            /* this.volume is the music volume used for the fade music function that is called when you die in the game*/
                                    }
                                } catch (t) {}
                            }), i.on("all", t => {
                                t in this.stats ? this.stats[t] += 1 : this.stats[t] = 1, this.tasks.forEach(e => {
                                    e.on(t)
                                })
                            })
                        }
                        input(t) {
                            if (this.active) switch (t) {
                                case 32:
                                    this.shop ? this.play() : i.trigger("end");
                                    break;
                                case 37:
                                    this.prev();
                                    break;
                                case 39:
                                    this.next()
                            }
                        }


                        play() {
                            const chosenQuestions = [];
                            document.getElementById("COINSCORE").classList.remove("displayCoinCount");
                            var currentCorrectAnswer = "";
                            hmscore = 0;
                            qsscore = 0;
                            hangmanWord = ""; // PARTIAL GUESS WORD
                            correctAnswers = 0; // NUMBER OF CORRECT ANSWERS
                            randomlySelectedWord = ""; // GUESS WORD INITIALLY SELECTED BY THE COMPUTER
                            const allRandomPositions = []; // ARRAY STORING ALL GENERATED RANDOM NUMBERS
                            incorrectGuesses = 0;
                            guessIsCorrect = false;
                            closeHangman = false;
                            "PLAY" == this.btn.textContent ? (this.stats = {}, i.trigger("start")) : "" == this.btn.className && (this.storage.token -= this.heroes[this.selected].price, this.storage.shop.push(this.selected), this.store(), this.hero())
                        }
                        hero() {
                            let t = this.storage.token,
                                e = this.heroes[this.selected],
                                s = this.storage.shop.indexOf(this.selected) < 0,
                                i = t >= e.price;
                            this.info.item(0).textContent = e.name,
                                this.info.item(1).textContent = "" /*s ? `₮ ${e.price} / ${t}` : "",*/
                            this.btn.textContent = "PLAY" /*s ? "BUY" : "PLAY",*/
                            this.btn.className = "" /*!s || i ? "" : "disabled"*/
                            /* commented-out code is for avatars that would require money to buy. this change makes every avatar available for "purchase" with no consequences I can see */
                        }
                        prev() {
                            --this.selected < 0 && (this.selected = this.heroes.length - 1), this.hero()
                        }
                        next() {
                            ++this.selected >= this.heroes.length && (this.selected = 0), this.hero()
                        }
                        store() {
                            window.localStorage.setItem("offliner_hi", JSON.stringify(this.storage))
                        }
                        mission(t = !1) {
                            let e = !0;
                            return this.tasks.forEach((s, i) => {
                                t || s.init();
                                let r = this.tasklist.item(i + 1);
                                r.textContent = s.toString(), r.className = s.done ? "done" : "", e = e && s.done
                            }), e && (this.storage.level++, this.store(), this.init()), e
                        }


                        score(t) {
                            let e = this.storage.score || 0,
                                s = this.tasklist.item(0),
                                i = this.scores,
                                r = this.stats.hit || 0,
                                n = (this.stats.planet || 0) + 1,
                                a = this.stats.power || 0,
                                o = this.stats.coin || 0,
                                h = Math.round(t.distance),
                                c = this.mission(!0) ? 1 : 0;

                            i.item(0).textContent = h + "", i.item(1).textContent = qsscore / 100 + " x 100", i.item(2).textContent = hmscore, i.item(3).textContent = o + "", i.item(4).textContent = a + " x 10", i.item(5).textContent = r + " x 50", i.item(6).textContent = n + " x 50", i.item(7).textContent = c + " x 500", h += 500 * c + 50 * n + 50 * r + 10 * a + o + hmscore + qsscore, i.item(8).textContent = h + "", e < h ? (s.textContent = "NEW HIGH SCORE", this.storage.score = h) : s.textContent = "SCORE", this.storage.token += o, this.store(), this.active = !0, this.body.className = "end"
                            ajaxCall(h); /* h = this round's score to be added to the user's cumulative score*/

                        }
                        show() {
                            this.shop = !0, this.body.className = ""
                        }
                        hide() {
                            this.shop = !1, this.active = !1, this.mission(), this.tasklist.item(0).textContent = "MISSION " + this.level(), this.scores.item(4).textContent = this.scores.item(5).textContent = "", this.body.className = "play"
                        }
                    },
                    W = (new Date).getTime(),
                    H = j.getContext("webgl"),
                    q = new x(5, 15, 7),
                    $ = new class {
                        constructor(t = 1, e = 45, s = .1, i = 100) {
                            this.aspect = t, this.fov = e, this.near = s, this.far = i, this.rotate = new x, this.position = new x, this.fov = e, this.aspect = t, this.near = s, this.far = i
                        }
                        transform(t) {
                            return t.matrix().rotate(this.rotate.clone().invert()).translate(this.position.clone().invert())
                        }
                        perspective() {
                            const t = this.near,
                                e = this.far,
                                s = Math.tan(.5 * Math.PI - .5 * this.fov),
                                i = 1 / (t - e);
                            return (new w).multiply([s / this.aspect, 0, 0, 0, 0, s, 0, 0, 0, 0, (t + e) * i, -1, 0, 0, t * e * i * 2, 0])
                        }
                    }(j.width / j.height),
                    G = new class {
                        constructor(t, e, s) {
                            this.gl = t, this.attribs = {}, this.location = {}, this.gl = t, this.program = t.createProgram(), this.indices = t.createBuffer();
                            const i = this.program;
                            t.attachShader(i, this.create(t.VERTEX_SHADER, e)), t.attachShader(i, this.create(t.FRAGMENT_SHADER, s)), t.linkProgram(i), t.getProgramParameter(i, t.LINK_STATUS) || (console.log(t.getProgramInfoLog(i)), t.deleteProgram(i))
                        }
                        create(t, e) {
                            const s = this.gl,
                                i = s.createShader(t);
                            return s.shaderSource(i, e), s.compileShader(i), s.getShaderParameter(i, s.COMPILE_STATUS) || console.log(s.getShaderInfoLog(i)), i
                        }
                        attrib(t, e, s) {
                            const i = this.gl;
                            this.location[t] || (this.location[t] = i.getAttribLocation(this.program, t));
                            const r = this.location[t];
                            return i.bindBuffer(i.ARRAY_BUFFER, e), i.enableVertexAttribArray(r), i.vertexAttribPointer(r, s, i.FLOAT, !1, 0, 0), this
                        }
                        uniform(t, e) {
                            const s = this.gl;
                            this.location[t] || (this.location[t] = s.getUniformLocation(this.program, t));
                            const i = this.location[t];
                            if ("number" == typeof e) return s.uniform1f(i, e), this;
                            switch (e.length) {
                                case 2:
                                    s.uniform2fv(i, e);
                                    break;
                                case 3:
                                    s.uniform3fv(i, e);
                                    break;
                                case 4:
                                    s.uniform4fv(i, e);
                                    break;
                                case 9:
                                    s.uniformMatrix3fv(i, !1, e);
                                    break;
                                case 16:
                                    s.uniformMatrix4fv(i, !1, e)
                            }
                            return this
                        }
                    }(H, I.a, O.a),
                    X = {
                        hero: [new C(H, 10), new C(H, 10, [.5, .15, .5, .1, .5, -.1, .5, -.15]), new C(H, 10, [.2, .5, .48, .2, .5, .1, .2, .1, .2, -.1, .5, -.1, .48, -.2, .2, -.5]), new C(H, 10, [.3, .44, .43, .3, .45, .2, .49, .2, .5, .1, .45, .1, .45, -.1, .5, -.1, .49, -.2, .45, -.2, .43, -.3, .3, -.44])],
                        block: new C(H, 4, [.55, .5, .65, .4, .65, -.4, .55, -.5]),
                        fence: new C(H, 12, [.4, .5, .5, .4, .5, -.4, .4, -.5], 40),
                        token: new C(H, 9, [.45, .3, .45, .5, .5, .5, .5, -.5, .45, -.5, .45, -.3], 30),
                        enemy: new C(H, 6)
                    },
                    K = new class extends z {
                        init(t = !0) {
                            const e = this.transform;
                            e.translate.set(0, 0, 0), e.rotate.set(0, 0, 90), e.scale.set(1, 1, 1), this.color = D.AVATAR, this.active = !0, this.transform = e, this.collider = new v(e), this.tokenCollider = new v(e), this.x = 0, this.rad = .4, this.acc = -.015, this.speed = new x(0, 0, .1), this.speedTime = 0, this.mycoins = 0, this.scale = .8, this.scaleTime = 0, this.continue = 1, this.magnet = new x(5, 5, 5), this.magnetTime = 0, this.explode = 0, this.questionCount = 0, this.correctAnswer = "", this.stroke = 0, t && (this.distance = 0)
                        }
                        left() {
                            this.x >= 0 && (this.x--, i.trigger("move", this))
                        }
                        right() {
                            this.x <= 0 && (this.x++, i.trigger("move", this))
                        }
                        myval() {
                            document.write(xclaim);
                        }
                        jump() {
                            this.collide && (this.acc = .03, i.trigger("jump", this))
                        }
                        boost() {
                            this.speedTime = 75, i.trigger("move", this)
                        }
                        magnetize() {
                            this.magnetTime = 450, i.trigger("power", this)
                        }
                        dash() {
                            this.scaleTime = 40, i.trigger("move", this)
                        }

                        selectWord() {
                            if (randomlySelectedWord == "") {

                                /* get a random integer from 0 to length(wordBank)-1 */
                                var randomWNumber = Math.floor(Math.random() * (Object.keys(wordBank).length));
                                /* var randomWNumber = 0; */
                                /*sets word to "math"*/
                                /* get quesiton (key) */
                                randomlySelectedWord = Object.keys(wordBank)[randomWNumber];
                                /* console.log("randomlySelectedWord",randomlySelectedWord); */
                            }
                            let length = randomlySelectedWord.length;
                            return length;
                        }

                        myFunction() {
                            continueGame = 1;

                        }

                        checkAnswer() {

                            console.log("checkAnswer started");
                            continueGame = 0;
                            if (questionBank[myQuestion][1]) {
                                /*if multiple choice Q...*/
                                /* let enteredAnswer1 = jQuery('input[name=swal2-radio]:checked').val();
                                if (enteredAnswer1 == undefined){enteredAnswer1='0';console.log("enteredAnswer1_undef",enteredAnswer1);} */
                                var getSelectedValue = document.querySelector('input[name="MC"]:checked');
                                if (getSelectedValue != null) {
                                    var enteredAnswer = getSelectedValue.value;
                                } else {
                                    enteredAnswer = '0';
                                }
                            } else {
                                var enteredAnswer = document.getElementById("answer").value;
                            }

                            var newstring = enteredAnswer.trim().toLowerCase()
                            if (enteredAnswer == undefined) {
                                enteredAnswer = '0';
                                console.log("enteredAnswer_undef", enteredAnswer);
                            }

                            console.log("entered answer", newstring);

                            if (newstring == currentCorrectAnswer) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bingo!!!',
                                    text: 'Keep up the good work!',
                                    html: "<button type='button' id='answerIsCorrect' class ='decorateButton' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>BRING IT ON!</button>",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                                correctAnswers = correctAnswers + 1; // NUMBER OF CORRECT ANSWERS THE USER GETS
                                qsscore = qsscore + 100;
                                document.getElementById('answerIsCorrect').addEventListener("click", function() {
                                    setTimeout(function() {
                                        continueGame = 1;
                                    }, 1000);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Not quite...',
                                    html: "<div id ='showCorrectAnswer'> </div><br>" + "<button type='button' class ='decorateButton' id='answerIsIncorrect' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>NO WORRIES!</button>",
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    /* onClose: this.resumegamewithdelay */
                                });
                                document.getElementById('showCorrectAnswer').innerHTML = "The correct answer is <b>" + String(longCorrectAnswer.toUpperCase()) + "</b>"
                                document.getElementById('answerIsIncorrect').addEventListener("click", function() {
                                    setTimeout(function() {
                                        continueGame = 1;
                                    }, 1000);
                                });
                            }
                        }

                        /* resumegamewithdelay(){
                          //
                          setTimeout(this.continueGame, 1000);
                          }
                          /* doesnt work bc setTimeout is weird with this. */

                        /*continuegame(){continueGame=1;} */

                        checkGuess() {
                            // hangmanWord and randomlySelectedWord similarity

                            var enteredGuess = document.getElementById("hangmanAnswer").value;
                            if (enteredGuess.toLowerCase() != randomlySelectedWord.toLowerCase()) {
                                incorrectGuesses = incorrectGuesses + 1;

                            } else if (enteredGuess.toLowerCase() == randomlySelectedWord.toLowerCase()) {
                                hmscore = 200;
                                guessIsCorrect = true;

                            }
                            if (guessIsCorrect == true) {
                                document.getElementById("CORRECT").innerHTML = "VOIL&Agrave; !!! ";
                                document.getElementById("tryGuess2").innerHTML = "<button type='submit' class ='decorateButton' id='FINALWINDOW' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'><b>RESUME GAME!</b></button>";
                                document.getElementById("FINALWINDOW").addEventListener("click", function() {
                                    continueGame = 1;
                                });
                                randomlySelectedWord = "";
                            }

                            if (incorrectGuesses == 1 && guessIsCorrect == false) {
                                document.getElementById("hint1").innerHTML = wordBank[randomlySelectedWord][0];
                            } else if (incorrectGuesses == 1 && guessIsCorrect == true) {
                                hmscore = 150;
                            }

                            if (incorrectGuesses == 2 && guessIsCorrect == false) {
                                document.getElementById("hint1").innerHTML = wordBank[randomlySelectedWord][0];
                                document.getElementById("hint2").innerHTML = wordBank[randomlySelectedWord][1];
                            } else if (incorrectGuesses == 2 && guessIsCorrect == true) {
                                hmscore = 100;
                            }
                            if (incorrectGuesses == 3 && guessIsCorrect == false) {

                                document.getElementById("hint1").innerHTML = wordBank[randomlySelectedWord][0];
                                document.getElementById("hint2").innerHTML = wordBank[randomlySelectedWord][1];
                                document.getElementById("hint3").innerHTML = wordBank[randomlySelectedWord][2];

                            } else if (incorrectGuesses == 3 && guessIsCorrect == true) {
                                hmscore = 50;
                            }

                            if (incorrectGuesses > 3 && guessIsCorrect == false) {
                                hmscore = 0;
                                document.getElementById("revealAnswer").innerHTML = "The correct answer is " + "<b>" + String(randomlySelectedWord) + "</b>";
                                document.getElementById("tryGuess2").innerHTML = "<button type='submit' class ='decorateButton' id='FINALWINDOW' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'><b>RESUME GAME!</b></button>";

                                document.getElementById("FINALWINDOW").addEventListener("click", function() {
                                    continueGame = 1;
                                });
                            }


                            console.log("hangman score", hmscore);
                            console.log("question score", qsscore);



                        }



                        coin() {

                            this.mycoins = this.mycoins + 1;
                            document.getElementById("COINSCORE").classList.add("displayCoinCount"); /* add class to COINSCORE div*/
                            document.getElementById("COINSCORE").innerHTML = "<b> Coins: </b>" + String(this.mycoins); /* add text inside the COINSCORE div*/

                            let wordLength = this.selectWord();
                            /* I declared the variable this.mycoins and this.questionCount above after the class declaration. */
                            console.log("wordLength", wordLength);
                            console.log("questionCount", this.questionCount);
                            if (this.questionCount < wordLength) {
                                /* the order of these two if statements seems not ideal, but if you switch them the game glitches every time you collect a coin*/

                                if (this.mycoins % <?php echo strval($coinsforQ) ?> == 0) {
                                    /* get a random integer from 0 to length(questionBank)-1 (index of last question) */
                                    var randomQNumber = Math.floor(Math.random() * (Object.keys(questionBank).length));



                                    while (chosenQuestions.includes(randomQNumber) == true) {
                                        randomQNumber = Math.floor(Math.random() * (Object.keys(questionBank).length));

                                    }

                                    chosenQuestions.push(randomQNumber);

                                    console.log("randomQNumber", randomQNumber);
                                    /* get quesiton (key) */
                                    myQuestion = (Object.keys(questionBank)[randomQNumber]);
                                    console.log("myQuestion", myQuestion);
                                    /* get answer (value corresponding to that key) */
                                    currentCorrectAnswer = questionBank[myQuestion][0];
                                    /* console.log("currentCorrectAnswer",currentCorrectAnswer); */
                                    longCorrectAnswer = questionBank[myQuestion][0];
                                    /* console.log("longCorrectAnswer",longCorrectAnswer); */
                                    this.questionCount = this.questionCount + 1;
                                    continueGame = 0;


                                    /* multiple choice */
                                    if (questionBank[myQuestion][1]) {
                                        /* inputOptions can be an object or Promise */
                                        /* var inputOptions = new Promise(function(resolve) {
                                            resolve({
                                              'a': questionBank[myQuestion][3],
                                              'b': questionBank[myQuestion][4],
                                              'c': questionBank[myQuestion][5],
                                              'd': questionBank[myQuestion][6]
                                            });
                                        }); */

                                        jQuery(".confirm").attr('disabled', 'disabled');

                                        Swal.fire({
                                            showCancelButton: false,
                                            showConfirmButton: false,

                                            title: '<strong><u>Time for a question!</u></strong>',
                                            padding: '2.2em 20px',
                                            allowOutsideClick: false,
                                            allowEnterKey: false,

                                            /* input: 'radio',
                                            inputOptions: inputOptions, */

                                            html: "<p id = 'question'> </p>" +
                                                "<div class='MCanswer'><input type='radio' id='answer_a' name='MC' value='a' checked> <label for='a' id = 'answerA'> </label><br><input type='radio' id='answer_b' name='MC' value='b'> <label for='b' id = 'answerB'> </label><br><input type='radio' id='answer_c' name='MC' value='c'> <label for='b' id = 'answerC'> </label><br><input type='radio' id='answer_d' name='MC' value='d'> <label for='b' id = 'answerD'> </label></div><br>" +
                                                "<button type='submit' class ='decorateButton' id='checkanswer' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>SUBMIT</button>",
                                            /* inputValidator: (value) => {
                                              if (!value) {
                                                return 'Please enter an answer'
                                              }
                                            }, */

                                            /* submit via enter key anywhere. calls on a global function.) */
                                            /* onOpen: function(){document.addEventListener("keyup", entertrigger, true);}, */

                                            onOpen: function() {
                                                document.getElementById("answer_a").focus();
                                            },

                                            confirmButtonText: "don't click this",
                                            confirmButtonColor: '#e00000',
                                            /*swal has built-in confirm and cancel buttons. the following line attempts to assign ids to them*/
                                            /* onOpen: function() { jQuery('.swal2-confirm').attr('id','btnConfirm'); jQuery('.swal2-cancel').attr('id','btnCancel');} */

                                            showCancelButton: false,
                                            showConfirmButton: false,

                                            /*end swal*/
                                        }).then((result) => {
                                            /* document.removeEventListener("keyup", entertrigger, true); */
                                            this.checkAnswer;
                                            /* let answerr = jQuery('input[name=swal2-radio]:checked').val();
                                            console.log('answerr:', answerr);
                                            console.log(answerr == undefined);
                                            /* if (console.log(answerr == undefined)){continueGame=1;}  */
                                        });

                                        /* submit via submit button click */
                                        document.getElementById("checkanswer").addEventListener("click", console.log("clicked"));
                                        document.getElementById("checkanswer").addEventListener("click", this.checkAnswer);
                                        /* submit via enter key when answer is selected */
                                        document.getElementById("answer_a").addEventListener("keyup", entertrigger, true);
                                        document.getElementById("answer_b").addEventListener("keyup", entertrigger, true);
                                        document.getElementById("answer_c").addEventListener("keyup", entertrigger, true);
                                        document.getElementById("answer_d").addEventListener("keyup", entertrigger, true);


                                        /* jQuery(document).on("click",".swal2-container input[name='swal2-radio']", function() {
                                            var id = jQuery('input[name=swal2-radio]:checked').val();
                                            console.log('id: ' + id);
                                        }); */
                                        /* inputValidator: (value) => { /* should value be result?*/
                                        /* return new Promise(function(resolve, reject) {
                                          if (value) {
                                            resolve();
                                          } else {
                                            reject('You need to select something!');
                                          } */
                                        /* }); */
                                        /* }; */
                                        /* document.getElementById("btnConfirm").addEventListener("click", this.checkAnswer);
                                        /* submit via enter key in answer field */
                                        /* document.addEventListener("keyup", function(event) { */
                                        /* if (event.keyCode === 13) {
                                          event.preventDefault();
                                          document.getElementById("btnConfirm").click();} */
                                        /* }); */

                                        document.getElementById("question").innerHTML = myQuestion;
                                        document.getElementById("answerA").innerHTML = questionBank[myQuestion][3];
                                        document.getElementById("answerB").innerHTML = questionBank[myQuestion][4];
                                        document.getElementById("answerC").innerHTML = questionBank[myQuestion][5];
                                        document.getElementById("answerD").innerHTML = questionBank[myQuestion][6];


                                        /* jQuery(document).on("click",".swal2-container input[name='swal2-radio']",
                                          function() {
                                          	var id = jQuery('input[name=swal2-radio]:checked').val();
                                          	console.log('id: ' + id);
                                            }
                                        ); */


                                        if (currentCorrectAnswer == 'a') {
                                            longCorrectAnswer = questionBank[myQuestion][3];
                                        } else if (currentCorrectAnswer == 'b') {
                                            longCorrectAnswer = questionBank[myQuestion][4];
                                        } else if (currentCorrectAnswer == 'c') {
                                            longCorrectAnswer = questionBank[myQuestion][5];
                                        } else if (currentCorrectAnswer == 'd') {
                                            longCorrectAnswer = questionBank[myQuestion][6];
                                        }

                                    }

                                    /* not multiple choice */
                                    else {
                                        Swal.fire({
                                            title: '<strong><u>Time for a question!</u></strong>',
                                            padding: '2.2em',
                                            /* background: rgba(255,255,255, 0.85), */
                                            /* customClass: {
                                              popup: 'my-swal'
                                            }, */
                                            html: "<p id = 'question'> </p>" +

                                                "<input placeholder='Try your luck here' class='swal2-input' id='answer'>" +

                                                "<button type='submit' class ='decorateButton' id='checkanswer' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>SUBMIT</button>",
                                            /* inputValidator: (value) => {
                                              if (!value) {
                                                return 'Please enter an answer'
                                              }
                                            }, */
                                            showConfirmButton: false,
                                            allowOutsideClick: false
                                        });

                                        document.getElementById("question").innerHTML = myQuestion;
                                        /* submit via submit button click */
                                        document.getElementById("checkanswer").addEventListener("click", this.checkAnswer);
                                        /* submit via enter key in answer field */
                                        document.getElementById("answer").addEventListener("keyup", function(event) {
                                            if (event.keyCode === 13) {
                                                event.preventDefault();
                                                document.getElementById("checkanswer").click();
                                            }
                                        });
                                    }
                                }
                            } else if (this.questionCount == wordLength) {
                                this.questionCount = wordLength + 1; // TO STOP ASKING QUESTIONS
                                continueGame = 0;
                                var randomPosition = 0;
                                var loopCount = 0;
                                var inArray = false;
                                for (let i = 0; i < wordLength; i++) {
                                    hangmanWord = hangmanWord + "-";
                                }
                                while (loopCount < correctAnswers) {
                                    randomPosition = Math.floor(Math.random() * (wordLength));
                                    inArray = allRandomPositions.includes(randomPosition); /* check whether random position is already created or not */
                                    if (!inArray) {
                                        allRandomPositions.push(randomPosition);
                                        hangmanWord = hangmanWord.substring(0, randomPosition) + randomlySelectedWord[randomPosition] + hangmanWord.substring(randomPosition + 1, randomlySelectedWord.length);
                                        loopCount = loopCount + 1;
                                    }
                                }

                                for (let i = 0; i < wordLength; i++) {
                                    hangmanWord = hangmanWord.replace("-", "  _  ");
                                }

                                Swal.fire({
                                    title: '<strong><u> Time for a mystery word! </u></strong>',
                                    padding: '2.2em',

                                    html: "<b><p id = 'question'> </p></b>" + "<input placeholder='Enter your guess word here' class='swal2-input' id='hangmanAnswer'>" + "<p id='tryGuess2'><button type='submit' id='tryGuess' class ='decorateButton' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>TRYING MY LUCK...</button></p>" + "<p id='hint1'></p><p id='hint2'></p><p id='hint3'></p><p id='revealAnswer'></p><p id ='CORRECT'></p><p id ='addEndButton'></p>",
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });

                                document.getElementById("question").innerHTML = hangmanWord;


                                /* should the // lines be commented out or no?*/
                                //while (incorrectGuesses<3 && guessIsCorrect==false)
                                //{
                                /* submit via button click*/
                                document.getElementById("tryGuess").addEventListener('click', this.checkGuess);
                                /* submit via enter key in answer field */
                                document.getElementById("hangmanAnswer").addEventListener("keyup", function(event) {
                                    if (event.keyCode === 13) {
                                        /* if enter key is pressed...*/
                                        event.preventDefault();
                                        /* check if there's a "submit word guess button rn"*/
                                        if (document.getElementById("tryGuess") !== null) {
                                            /* if so, click it*/
                                            document.getElementById("tryGuess").click();
                                        } else {
                                            /* if not, click the button that shows up when you've used all your guess and/or gotten the word right*/
                                            document.getElementById("FINALWINDOW").click();
                                        }
                                    }
                                });
                                //incorrectGuesses = incorrectGuesses * 1;
                                //}


                            }
                            i.trigger("coin", this);
                        }






                        cancel() {
                            this.x = Math.round(this.transform.translate.x)
                        }

                        update() {

                            let t = this.transform.translate,
                                e = this.scale,
                                s = this.transform.rotate,
                                i = (this.speedTime ? .13 : .08) + Math.min(this.distance / 15e3, .04);
                            this.speed.z += ((this.active ? i : 0) - this.speed.z) / 20, this.speedTime -= this.speedTime > 0 ? 1 : 0, this.color = this.magnetTime > 100 || this.magnetTime % 20 > 10 ? D.PINK : D.AVATAR, this.scale += ((this.scaleTime ? .5 : .7) - this.scale) / 5, this.scaleTime -= this.scaleTime > 0 ? 1 : 0, this.magnetTime -= this.magnetTime > 0 ? 1 : 0, this.tokenCollider.scale = this.magnetTime ? this.magnet : this.transform.scale, this.stroke += (this.explode - this.stroke) / 25, this.active = t.y > -10 && this.stroke < 6, this.active && !this.stroke && (this.acc -= this.acc > -.012 ? .003 : 0, s.z = 90 + 25 * (t.x - this.x), s.y = (s.y + 100 * this.speed.z) % 360, this.speed.y += this.acc, this.speed.y < -.25 && (this.speed.y = -.25), t.x += (this.x - t.x) / 7, t.y += this.speed.y, t.z -= t.z / 30, this.transform.scale.set(e, e, e))

                        }

                        preview() {
                            let t = this.transform.rotate;
                            t.y = (t.y + 1) % 360, t.z = (t.z + .7) % 360
                        }
                    }(X.hero[0], D.AVATAR),
                    J = new class extends z {
                        constructor(t, e, s) {
                            super(), this.map = s, this.hero = t, this.add(this.hero), this.planets = document.getElementsByTagName("LI"), this.platforms = [];
                            for (let t = 0; t < 33; t++) {
                                let t = e();
                                this.platforms.push(t), this.add(t)
                            }
                            this.init()
                        }
                        init() {
                            this.row = 9, this.hero.init(), this.map.init();
                            let t = 0;
                            for (let e = -9; e < 2; e++)
                                for (let s = -1; s <= 1; s++) {
                                    let i = this.platforms[t++];
                                    i.transform.translate.set(s, -1, e), i.enemy.active = i.fence.active = i.token.active = !1, i.block.active = !0
                                }
                            for (this.planet = this.planets.length - 1, t = 0; t < this.planets.length; t++) this.planets.item(t).className = ""
                        }
                        next() {
                            this.planet > 0 && (this.planets.item(this.planet--).className = "hide", i.trigger("planet", this.planet))
                        }
                        ended() {
                            return Math.abs(this.hero.speed.z) < .01
                        }
                        input(t) {
                            const e = this.hero;
                            switch (t) {
                                case 37:
                                    e.left();
                                    break;
                                case 39:
                                    e.right();
                                    break;
                                case 38:
                                    e.jump();
                                    break;
                                case 40:
                                    e.dash();
                                    break;
                                case 32:
                                    e.boost()
                            }
                        }
                        updateRow(t) {
                            this.row -= t, this.row <= -.5 && (this.row += 11), this.index = 3 * Math.round(this.row) + Math.round(this.hero.transform.translate.x) + 1
                        }
                        getIndex(t = 0) {
                            let e = this.platforms.length,
                                s = this.index + t;
                            return s < 0 ? s + e : s >= e ? s - e : s
                        }
                        update() {

                            if (continueGame == 1) {
                                this.hero.update();
                                let t = !1,
                                    e = this.hero,
                                    s = e.speed.z,
                                    r = 0,
                                    n = 0;
                                this.platforms.forEach((i, a) => {
                                    if (i.update(s)) {
                                        r += i.fence.active && e.transform.translate.y > -1 ? 1 : 0, n += !i.enemy.active || i.enemy.stroke || e.stroke ? 0 : 1;
                                        let s = this.map.row[a % 3],
                                            o = s >> 2;
                                        i.block.active = (1 & s) > 0, i.transform.translate.y = (2 & s) > 0 ? 0 : -1, i.token.init(1 == o || 4 == o), i.fence.active = 2 == o, i.enemy.init(3 == o), i.token.transform.rotate.y = 45, t = !0
                                    }
                                    i.enemy.intersect(e)
                                }), t && this.map.update() && this.next(), this.updateRow(s), e.collide = this.platforms[this.getIndex()].intersect(e), [-3, 3, -1, 1, -2, 2, -4, 4].forEach(t => {
                                    let s = this.getIndex(t);
                                    this.platforms[s].intersect(e, 1 == t || -1 == t)
                                }), e.distance += s, r > 0 && i.trigger("fence", r), n > 0 && i.trigger("enemy", n)
                            }
                        }
                    }(K, () => {
                        let t = new E,
                            e = new z(X.block, D.BLUE, [, , , , 45]),
                            s = new S(X.enemy, D.CYAN, [, 1, , , , , .7, .7, .7]),
                            i = new P(X.token, D.YELLOW, [, 1, , 90, , , .5, .1, .5]),
                            r = new z(X.fence, D.RED, [, 1.4, , , , , .8, 1, .8]);
                        return e.collider = new b(e.transform), s.collider = new v(s.transform), i.collider = new v(i.transform), r.collider = new b(r.transform), t.block = e, t.token = i, t.fence = r, t.enemy = s, t.add(e).add(i).add(r).add(s)
                    }, new class {
                        constructor(t, e = 7, s = 150) {
                            this.config = t.split("|"), this.length = e, this.flag = 1, this.steps = s
                        }



                        init() {
                            this.row = [1, 1, 1], this.count = 10, this.data = [], this.step = 0, this.min = 0, this.update()
                        }
                        max() {
                            let t = this.min + this.length,
                                e = this.config.length;
                            return t < e ? t : e - 1
                        }
                        update() {

                            if (continueGame == 1) {
                                let t = !1;
                                if (++this.step > this.steps && (t = !0, this.step = 0, this.min + this.length < this.config.length - 1 && this.min++), --this.count > 0) return t;
                                if (!this.data.length) {
                                    this.mirror = _.get() > .5;
                                    let t = _.get(this.max(), this.min, !0);
                                    this.data = this.config[t].match(/.{1,4}/g)
                                }
                                return this.row = this.data.shift().split("").map(t => parseInt(t, 36)), this.count = this.row.shift(), this.mirror && this.row.reverse(), t
                            }
                        }
                    }("311737173711|4111|5711|3111|211135012111|2111|301531513510|311119973111|5111111d|311120003115|551111dd|305130053051|3111139b3511|211130002115|401510004510"));

                function Z() {
                    j.width = j.clientWidth, j.height = j.clientHeight, $.aspect = j.width / j.height, H.viewport(0, 0, j.width, j.height)
                }

                function Q(t, e = 0) {
                    if (t.childs.forEach(t => {
                            Q(t, e)
                        }), !t.active || !t.mesh) return;
                    const s = t.transform.matrix().invert();
                    s && (H.cullFace(e > 0 ? H.FRONT : H.BACK), H.useProgram(G.program), G.attrib("aPos", t.mesh.verts, 3).attrib("aNorm", t.mesh.normals, 3).uniform("uWorld", $.transform(t.transform).data).uniform("uProj", $.perspective().data).uniform("uInverse", s).uniform("uColor", e ? [0, 0, 0, 1] : t.color).uniform("uLight", q.clone().sub($.position).toArray()).uniform("uStroke", e + t.stroke), H.drawArrays(H.TRIANGLES, 0, t.mesh.length))
                }

                function tt() {
                    /* called when you die */
                    if (requestAnimationFrame(tt), H.clear(H.COLOR_BUFFER_BIT), U.shop) return K.mesh = X.hero[U.selected], K.preview(), Q(K), void Q(K, .01);
                    let t = (new Date).getTime();
                    if (t - W > 30 && J.update(), W = t, J.update(), Q(J), Q(J, .01), !K.active && V) {
                        let t = p.mixer("music"),
                            e = t.context.currentTime;
                        /* fade music out */
                        t.gain.setValueCurveAtTime(Float32Array.from([U.musicvolume, 0]), e, .5), V.stop(e + .5), V = null
                    }!U.active && J.ended() && U.score(K)
                }
                async function et() {
                    Y = !0;
                    let t = B("#start");
                    t.className = "disabled",
                        t.textContent = "loading",
                        await p.init(),
                        await Promise.all([p.sound("exp", new d("custom", [5, 1, 0], 1), [220, 0], 1),
                            p.sound("hit", new d("custom", [3, 1, 0], 1), [1760, 0], .3),
                            p.sound("power", new d("square", [.5, .1, 0], 1), [440, 880, 440, 880, 440, 880, 440, 880], .3),
                            p.sound("jump", new d("triangle", [.5, .1, 0], 1), [220, 880], .3),
                            p.sound("coin", new d("square", [.2, .1, 0], .2), [1760, 1760], .2), p.sound("move", new d("custom", [.1, .5, 0], .3), [1760, 440], .3),
                            p.music("music", [new f(new d("sawtooth", [1, .3], .2), "8a2,8a2,8b2,8c3|8|8g2,8g2,8a2,8b2|8|8e2,8e2,8f2,8g2|4|8g2,8g2,8a2,8b2|4|".repeat(4), 1),
                                new f(new d("sawtooth", [.5, .5], 1), "1a3,1g3,2e3,4b3,4c4,1a3c3e3,1g3b3d4,2e3g3b3,4d3g3b3,4g3c4e4|1|" + "8a3,8a3e4,8a3d4,8a3e4|2|8g3,8g3d4,8g3c4,8g3d4|2|8e3,8e3a3,8e3b3,8e3a3,4g3b3,4g3c4|1|".repeat(2), //tune
                                    4)
                            ])
                        ]), B("#load").className = "hide", tt()
                }
                L(window, "load", async () => {
                    K.init(), H.clearColor(0, 0, 0, 0), H.enable(H.CULL_FACE), H.enable(H.DEPTH_TEST), $.rotate.x = -.7, $.position.set(0, 0, 1.2), K.transform.rotate.set(10, 22, 30), Q(K), Q(K, .02), B("link[rel=apple-touch-icon]").href = B("link[rel=icon]").href = j.toDataURL(), $.position.set(0, .5, 5), Z(),
                        function() {
                            let t = 0,
                                e = 0,
                                s = [],
                                r = !1;
                            L(document, "touchstart", s => {
                                let i = s.touches[0];
                                t = i.clientX, e = i.clientY, r = !0
                            }), L(document, "touchmove", i => {
                                if (i.preventDefault(), !r || U.active) return;
                                let n = i.touches[0];
                                !s[39] && n.clientX - t > 15 ? (s[39] = !0, J.input(39), r = !1) : !s[37] && n.clientX - t < -15 ? (s[37] = !0, J.input(37), r = !1) : !s[40] && n.clientY - e > 15 ? (s[40] = !0, J.input(40), r = !1) : !s[38] && n.clientY - e < -15 && (s[38] = !0, J.input(38), r = !1)
                            }, {
                                passive: !1
                            }), L(document, "touchend", t => {
                                r && !U.active && (s[32] = !0, J.input(32)), s[32] = s[37] = s[38] = s[39] = s[40] = r = !1
                            }), L(document, "keydown", t => {
                                if (!s[t.keyCode])
                                    if (s[t.keyCode] = !0, Y) {
                                        if (U.active) return void U.input(t.keyCode);
                                        J.input(t.keyCode)
                                    } else s[32] && et()
                            }), L(document, "keyup", t => {
                                s[t.keyCode] = !1
                            }), L(window, "resize", Z), L(B("#start"), "click", () => {
                                Y || et()
                            }), i.on("all", t => {
                                p.play(t)
                            }), i.on("start", () => {
                                if (U.hide(), J.init(), !V) {
                                    let t = p.mixer("music"),
                                        s = p.mixer("master"),
                                        i = t.context.currentTime;
                                    if (!isFinite(U.musicvolume)) {
                                        U.musicvolume = 0;
                                        U.sfxvolume = 0;
                                    } /* if volume hasn't been set (this is the player's first round of this session, mute everything)*/
                                    t.gain.setValueAtTime(U.musicvolume, i), s.gain.setValueAtTime(U.sfxvolume, i), /* i think it doesn't like (U.volume, i) bc U.volume hasn't been set. idk how to set that before the game begins the first round but not reset it every round. */
                                        V = p.play("music", !0, "music")
                                }
                            }), i.on("end", () => {
                                K.init(!1), U.show()
                            })
                        }()
                }), B("ontouchstart" in window ? "#keys" : "#touch").className = "hide"
            }]);
        </script>
</body>

</html>