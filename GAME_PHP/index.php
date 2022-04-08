<?php 
session_start();

    //include("connection.php");
    include("functions.php");
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "login_sample_db";
    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    $user_data = check_login($con);
    $tori = $user_data['user_id'];
   $weeklyQuery = "select * from weeklyleaderboard where id = $tori limit 1";
   $monthlyQuery = "select * from monthlyleaderboard where id = $tori limit 1";
   $alltimeQuery = "select * from alltimeleaderboard where id = $tori limit 1";
    $convertQuery = mysqli_query($con, $weeklyQuery);
    $weeklyResult = mysqli_fetch_assoc($convertQuery);

    $convertmonthQuery = mysqli_query($con, $monthlyQuery);
    $monthlyResult = mysqli_fetch_assoc($convertmonthQuery);

    $convertallQuery = mysqli_query($con, $alltimeQuery);
    $alltimeResult = mysqli_fetch_assoc($convertallQuery);

?>

<!DOCTYPE html><html lang="en"><head><title>SPACECRAFT</title><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="mobile-web-app-capable" content="yes"><link rel="apple-touch-icon" sizes="192x192"><link rel="icon" sizes="192x192">

<!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<style type="text/css">body,canvas,html,li,ul{width:100%;height:100%}#ctrl,body,canvas,h1,h2,h3,h4,html,li,table,td,th,tr,ul{margin:0;padding:0}body,html{overflow:hidden;background-color:#000;color:#fff;font:normal 14px Arial,Helvetica,sans-serif;text-align:center}#ctrl,#game,#hud,#load,#planet{position:absolute;top:0;left:0;right:0;bottom:0}#load{background-image:linear-gradient(#003,#033 50%,#000 0);opacity:1}#load.hide{display:none}#hud,#load{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between}#hud div,#load div{width:100%}#hud div:first-child,#load div:first-child{align-self:flex-start}#hud div:last-child,#load div:last-child{align-self:flex-end}ul{list-style:none}ul>li{position:absolute;letter-spacing:3px;line-height:60px;font-size:24px;font-weight:700}ul>li.hide{opacity:0;transition:opacity 1s}h1{font-size:24px;letter-spacing:5px;line-height:80px}

  .displayCoinCount {
    width:250px;
    height:40px;
    font-size:30px;
    background-color:blue;
    position:absolute;
    left: 20px;
    bottom: 30px;
  }
h2{line-height:30px}h2,h3{font-size:18px}h3{height:40px}h4{line-height:20px;font-size:14px}h4.title{line-height:25px;font-size:20px}h4.done{text-decoration:line-through}p{margin:10px 0;padding:0}table{min-width:250px;margin:5px auto 0}th{text-align:left;font-weight:400}td{text-align:right}.total{font-weight:700;font-size:18px;line-height:25px}#quest{padding:10px 0;background:rgba(0,0,0,.7);opacity:1;visibility:hidden}#ctrl{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:center}#ctrl div{flex:1 0 100%}#keys.hide,#touch.hide{display:none}i{position:absolute;display:block;top:12px;width:32px;line-height:32px;font-size:24px;font-style:normal;border-radius:50%;cursor:pointer;color:#999}#sfx{right:10px}#sfx:before{content:"♫"}#sfx.no:before{content:"♪";text-decoration:line-through}#sfx.sfx:before{content:"♪"}#fs{left:10px}#fs:before{content:"☐"}a{display:inline-block;width:50px;line-height:48px;font-weight:700;color:#000;text-shadow:1px 1px 1px #fff;background-image:linear-gradient(#fff,#ccc);border:2px solid #333;border-radius:25px;padding:0 20px;margin:20px 5px;cursor:pointer}a.disabled{color:#999}.cyan{color:#2ff}.pink{color:#f2f}.red{color:#f22}.end #ctrl,.play #ctrl,.play a{visibility:hidden}.end #quest,.play #quest{visibility:visible}.play #quest{opacity:0;transition:opacity 1s;transition-delay:2.5s}.play table{display:none}*{-webkit-tap-highlight-color:rgba(0,0,0,0);-webkit-touch-callout:none;user-select:none}</style></head><body><ul id="planet"><li>SPACE</li><li style="background-image:radial-gradient(circle at 50% 100%, #632, #964 30%, #c96 40%, #000 40%)">PLUTO</li><li style="background-image:radial-gradient(circle at 50% 100%, #013, #025 48%, #046 58%, #013 59%, #000 61%)">NEPTUNE</li><li style="background-image:radial-gradient(circle at 50% 100%, #133, #255 50%, #466 60%, #133 61%, #000 63%)">URANUS</li><li style="background-image:radial-gradient(circle at 50% 100%, #320, #651 50%, #973 60%, #320 61%, #000 63%, #000 73%, #333 75%, #333 88%, #000 90%)">SATURN</li><li style="background-image:radial-gradient(circle at 50% 100%, #420, #641 60%, #852 70%, #420 71%, #000 75%)">JUPITER</li><li style="background-image:radial-gradient(circle at 50% 100%, #300, #510 35%, #630 45%, #310 46%, #000 48%)">MARS</li><li style="background-image:radial-gradient(circle at 50% 100%, #222, #555 30%, #666 40%, #000 40%)">MOON</li></ul><canvas id="game" width="192" height="192"></canvas><div id="hud"><div></div><div id="quest"><h4 class="title"></h4><h4></h4><h4></h4><table><tr><th>Distance travelled</th><td></td></tr><tr><th>Correct answers</th><td></td></tr><tr><th>hangman score</th><td></td></tr><tr><th>Tokens collected</th><td></td></tr><tr><th>Big tokens collected</th><td></td></tr><tr><th>Asteroids destroyed</th><td></td></tr><tr><th>Places visited</th><td></td></tr><tr><th>Mission completed</th><td></td></tr><tr><th class="total">TOTAL</th><td class="total"></td></tr></table></div><div><a id="ok">OK</a></div></div>


<div id = "COINSCORE"> </div>
<div id="ctrl"><h3></h3><div><h3></h3><a id="prev">&lt;</a><a id="play"></a>


    <a id="next">&gt;</a></div></div><div><i id="fs" title="Fullscreen"></i> <i id="sfx" title="Audio"></i></div><div id="load"><div><h1>SPACECRAFT</h1></div><div><p id="keys"><b>JUMP</b> - <b>UP</b> arrow key<br><b>SHRINK</b> - <b>DOWN</b> arrow key<br><b>MOVE</b> - <b>LEFT / RIGHT</b> arrow keys<br><b>BOOST</b> - <b>SPACE</b> key</p><p id="touch"><b>JUMP</b> - Swipe <b>UP</b><br><b>SHRINK</b> - Swipe <b>DOWN</b><br><b>MOVE</b> - Swipe <b>LEFT / RIGHT</b><br><b>BOOST</b> - <b>TAP</b></p><p><b class="pink">BIG TOKENS</b> help you collect small ones.<br>Use <b>SHRINK</b> to go through <b class="red">SPACE JUNK</b>.<br>Use <b>BOOST</b> to destroy <b class="cyan">ASTEROIDS</b>.</p></div><div><a id="start">START</a><script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type = "text/javascript">

function ajaxCall(finalscore){
    var thisusername="<?php echo $user_data['user_name']; ?>";
    var thisuserid = "<?php echo $user_data['user_id'];?>";
    var temp ="<?php echo $weeklyResult['score'];?>";

 
    console.log(temp);
    finalscore = parseInt(temp) + finalscore;
    console.log(finalscore);
     $.ajax(
                {          
                        // Our sample url to make request 
                        url: 
                        'ajaxcall.php',
                        // Type of Request
                        type: "post",
                        data : {username:thisusername, userid: thisuserid, userscore:finalscore},
                        error: function (error) {
                            console.log(`Error ${error}`);
                        }
                });
}
    ! function(t) {

    var e = {};

    var xclaim=2;
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
}, function(t, e, s) {}, function(t, e, s) {
    console.log("hey");
    var questionBank={"What is 2+2?":"4", "What is the 4th planet in the solar system?":"mars"};
    var myAnswer="";
  var qsscore = 0;
  var hmscore = 0;
  var finalscore = 0 ;
    var hangmanWord="";  // PARTIAL GUESS WORD
    var correctAnswers=0;    // NUMBER OF CORRECT ANSWERS
    var randomlySelectedWord="";   // GUESS WORD INITIALLY SELECTED BY THE COMPUTER
    const allRandomPositions=[];  // ARRAY STORING ALL GENERATED RANDOM NUMBERS
    var incorrectGuesses=0;
    var guessIsCorrect = false;
    var closeHangman = false;
    var cumulativescore=0;
    "use strict";
    s.r(e);
    s(2);
    var continueGame=1;
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
            fence: "Dodge junks $ time",
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

        done(){
          this.explode=1;
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
                }], this.tasklist = document.getElementsByTagName("H4"), this.scores = document.getElementsByTagName("TD"), this.stats = {}, this.sfxBtn = B("#sfx"), this.volume = .3, this.hero(), this.bind(), this.init()

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
                }), L(B("#fs"), "click", () => {
                    document.webkitFullscreenElement ? document.webkitExitFullscreen && document.webkitExitFullscreen() : document.documentElement.webkitRequestFullscreen()
                }), L(this.sfxBtn, "click", () => {
                    let t = this.sfxBtn,
                        e = p.mixer("music"),
                        s = p.mixer("master"),
                        i = s.context.currentTime;
                    try {
                        switch (t.className) {
                            case "no":
                                this.volume = .3, e.gain.setValueAtTime(this.volume, i), s.gain.setValueAtTime(1, i), t.className = "";
                                break;
                            case "sfx":
                                s.gain.setValueAtTime(0, i), t.className = "no";
                                break;
                            default:
                                this.volume = 0, e.gain.setValueAtTime(this.volume, i), t.className = "sfx"
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
                document.getElementById("COINSCORE").classList.remove("displayCoinCount");
                var myAnswer="";
                hmscore=0;
                qsscore=0;
                hangmanWord="";  // PARTIAL GUESS WORD
                correctAnswers=0;    // NUMBER OF CORRECT ANSWERS
                randomlySelectedWord="";   // GUESS WORD INITIALLY SELECTED BY THE COMPUTER
            const   allRandomPositions=[];  // ARRAY STORING ALL GENERATED RANDOM NUMBERS
                incorrectGuesses=0;
                guessIsCorrect = false;
                closeHangman = false;
                "PLAY" == this.btn.textContent ? (this.stats = {}, i.trigger("start")) : "" == this.btn.className && (this.storage.token -= this.heroes[this.selected].price, this.storage.shop.push(this.selected), this.store(), this.hero())
            }
            hero() {
                let t = this.storage.token,
                    e = this.heroes[this.selected],
                    s = this.storage.shop.indexOf(this.selected) < 0,
                    i = t >= e.price;
                this.info.item(0).textContent = e.name, this.info.item(1).textContent = s ? `₮ ${e.price} / ${t}` : "", this.btn.textContent = s ? "BUY" : "PLAY", this.btn.className = !s || i ? "" : "disabled"
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

                i.item(0).textContent = h + "", i.item(1).textContent = qsscore/100 + " x 100", i.item(2).textContent = hmscore, i.item(3).textContent = "₮ " + o + " x 10", i.item(4).textContent = a + " x 25", i.item(5).textContent = r + " x 50", i.item(6).textContent = n + " x 100", i.item(7).textContent = c + " x 500", h += 500 * c + 100 * n + 50 * r + 25 * a + 10 * o + hmscore + qsscore, i.item(8).textContent = h + "", e < h ? (s.textContent = "NEW HIGH SCORE", this.storage.score = h) : s.textContent = "SCORE", this.storage.token += o, this.store(), this.active = !0, this.body.className = "end"
                    finalscore = finalscore + h;
                ajaxCall(finalscore);
 
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
                e.translate.set(0, 0, 0), e.rotate.set(0, 0, 90), e.scale.set(1, 1, 1), this.color = D.WHITE, this.active = !0, this.transform = e, this.collider = new v(e), this.tokenCollider = new v(e), this.x = 0, this.rad = .4, this.acc = -.015, this.speed = new x(0, 0, .1), this.speedTime = 0, this.mycoins=0, this.scale = .8, this.scaleTime = 0, this.continue=1, this.magnet = new x(5, 5, 5), this.magnetTime = 0, this.explode = 0, this.questionCount=0, this.correctAnswer="", this.stroke = 0, t && (this.distance = 0)
            }
            left() {
                this.x >= 0 && (this.x--, i.trigger("move", this))
            }
            right() {
                this.x <= 0 && (this.x++, i.trigger("move", this))
            }
            myval(){
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

            selectWord(){

                randomlySelectedWord="abc"; // GUESS WORD INITIALLY SELECTED BY THE COMPUTER
                let length = randomlySelectedWord.length;
                return length;
            }

            myFunction(){
                continueGame=1;

            }

            checkAnswer(){
                continueGame=0;
                var enteredAnswer = document.getElementById("answer").value;
                var newstring = enteredAnswer.trim().toLowerCase()

                if (newstring==myAnswer){

                    Swal.fire({
                      icon: 'success',
                      title: 'Bingo!!!',
                      text: 'Keep up the good work!',
                      html : "<button type='button' id='answerIsCorrect' class ='decorateButton' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>BRING IT ON!</button>",
                      showConfirmButton: false,
                      allowOutsideClick: false
                    });
                    correctAnswers = correctAnswers + 1; // NUMBER OF CORRECT ANSWERS THE USER GETS
          qsscore = qsscore + 100;
                    document.getElementById('answerIsCorrect').addEventListener("click", function(){continueGame=1;});
                }
                else{
                    Swal.fire({
                     icon: 'error',
                     title: 'Uh oh...',
                     html : "<div id ='showCorrectAnswer'> </div><br>" + "<button type='button' class ='decorateButton' id='answerIsIncorrect' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>NO WORRIES!</button>",
                     showConfirmButton: false,
                     allowOutsideClick: false
                    });
                    document.getElementById('showCorrectAnswer').innerHTML = "The correct answer is <b>" + String(myAnswer.toUpperCase()) + "</b>"
                    document.getElementById('answerIsIncorrect').addEventListener("click", function(){continueGame=1;});
                }
            }


            checkGuess(){
                // hangmanWord and randomlySelectedWord similarity

                    var enteredGuess = document.getElementById("hangmanAnswer").value;
                    if (enteredGuess.toLowerCase() != randomlySelectedWord.toLowerCase()){
                        incorrectGuesses = incorrectGuesses + 1;

                    }

                    else if (enteredGuess.toLowerCase() == randomlySelectedWord.toLowerCase()){
            hmscore=200;
                        guessIsCorrect = true;

                    }
                    if (guessIsCorrect == true){
                        document.getElementById("CORRECT").innerHTML = "VOILA !!! ";
                        document.getElementById("tryGuess2").innerHTML = "<button type='submit' class ='decorateButton' id='FINALWINDOW' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'><b>RESUME GAME!</b></button>";
                        document.getElementById("FINALWINDOW").addEventListener("click",function(){continueGame=1;});
                    }

                    if (incorrectGuesses == 1 && guessIsCorrect == false){
                        document.getElementById("hint1").innerHTML = "hint 1";
                    }
          else if (incorrectGuesses == 1 && guessIsCorrect == true){
            hmscore = 150;
          }

                    if (incorrectGuesses==2 && guessIsCorrect == false) {
                        document.getElementById("hint1").innerHTML = "hint 1";
                        document.getElementById("hint2").innerHTML = "hint 2";
                    }

          else if (incorrectGuesses == 2 && guessIsCorrect == true){
            hmscore = 100;
          }
                    if (incorrectGuesses==3 && guessIsCorrect == false){

                        document.getElementById("hint1").innerHTML = "hint 1";
                        document.getElementById("hint2").innerHTML = "hint 2";
                        document.getElementById("hint3").innerHTML = "hint 3";

                    }
          else if (incorrectGuesses == 3 && guessIsCorrect == true){
            hmscore = 50;
          }

                    if (incorrectGuesses>3 && guessIsCorrect == false){
            hmscore=0;
                        document.getElementById("revealAnswer").innerHTML = "The correct answer is " + "<b>" + String(randomlySelectedWord) + "</b>";
                        document.getElementById("tryGuess2").innerHTML = "<button type='submit' class ='decorateButton' id='FINALWINDOW' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'><b>RESUME GAME!</b></button>";

                        document.getElementById("FINALWINDOW").addEventListener("click",function(){continueGame=1;});
                    }


          console.log("hangman score",hmscore);
          console.log("question score", qsscore);



            }



            coin() {

                this.mycoins = this.mycoins + 1;
                document.getElementById("COINSCORE").classList.add("displayCoinCount");
                document.getElementById("COINSCORE").innerHTML="<b> Coins: </b>" + String(this.mycoins);
                let wordLength = this.selectWord();

                // I declared the variable this.mycoins and this.questionCount above after the class declaration.

                if (this.questionCount<wordLength){


                    if (this.mycoins % 100 == 0){
                        var randomNumber = Math.floor(Math.random()*2) + 1;
                        randomNumber = randomNumber - 1;
                        var myQuestion = (Object.keys(questionBank)[randomNumber]);
                        myAnswer = questionBank[myQuestion];
                        this.questionCount=this.questionCount + 1;
                        continueGame=0;
                        Swal.fire({
                          title: '<strong><u> Time for a question!</u></strong>',

                          html: "<p id = 'question'> </p>" + "<input placeholder='Try your luck here' class='swal2-input' id='answer'>" + "<button type='submit' class ='decorateButton' id='checkanswer' onclick='swal.close()' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>SUBMIT</button>",
                          showConfirmButton: false,
                          allowOutsideClick: false
                        });
                        document.getElementById("question").innerHTML = myQuestion;
                        document.getElementById("checkanswer").addEventListener("click", this.checkAnswer);
                    }
                }
                else if (this.questionCount==wordLength){
                    this.questionCount = wordLength + 1;  // TO STOP ASKING QUESTIONS
                    continueGame=0;
                    var randomPosition = 0;
                    var loopCount = 0;
                    var inArray = false;
                    for (let i = 0; i < wordLength; i++) {
                        hangmanWord=hangmanWord + "-";
                    }
                    while (loopCount < correctAnswers){
                        randomPosition = Math.floor(Math.random()*wordLength) + 1;
                        randomPosition = randomPosition - 1;
                        inArray = allRandomPositions.includes(randomPosition);  // check whether random position is already created or not
                        if (!inArray){
                            allRandomPositions.push(randomPosition);
                            hangmanWord = hangmanWord.substring(0, randomPosition) + randomlySelectedWord[randomPosition] + hangmanWord.substring(randomPosition + randomlySelectedWord[randomPosition].length);
                            loopCount = loopCount + 1;
                        }
                    }

                    for (let i = 0 ; i< wordLength ; i ++ ){
                        hangmanWord = hangmanWord.replace("-", "  _  ");
                    }

                    Swal.fire({
                      title: '<strong><u> Time for Hangman! </u></strong>',

                      html: "<b><p id = 'question'> </p></b>" + "<input placeholder='Enter your guess word here' class='swal2-input' id='hangmanAnswer'>" + "<p id='tryGuess2'><button type='submit' id='tryGuess' class ='decorateButton' style = 'background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;'>TRYING MY LUCK...</button></p>" + "<p id='hint1'></p><p id='hint2'></p><p id='hint3'></p><p id='revealAnswer'></p><p id ='CORRECT'></p><p id ='addEndButton'></p>",
                      showConfirmButton: false,
                      allowOutsideClick: false
                    });

                    document.getElementById("question").innerHTML=hangmanWord;



                    //while (incorrectGuesses<3 && guessIsCorrect==false)
                    //{

                    document.getElementById("tryGuess").addEventListener('click',this.checkGuess);
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
                this.speed.z += ((this.active ? i : 0) - this.speed.z) / 20, this.speedTime -= this.speedTime > 0 ? 1 : 0, this.color = this.magnetTime > 100 || this.magnetTime % 20 > 10 ? D.PINK : D.WHITE, this.scale += ((this.scaleTime ? .5 : .7) - this.scale) / 5, this.scaleTime -= this.scaleTime > 0 ? 1 : 0, this.magnetTime -= this.magnetTime > 0 ? 1 : 0, this.tokenCollider.scale = this.magnetTime ? this.magnet : this.transform.scale, this.stroke += (this.explode - this.stroke) / 25, this.active = t.y > -10 && this.stroke < 6, this.active && !this.stroke && (this.acc -= this.acc > -.012 ? .003 : 0, s.z = 90 + 25 * (t.x - this.x), s.y = (s.y + 100 * this.speed.z) % 360, this.speed.y += this.acc, this.speed.y < -.25 && (this.speed.y = -.25), t.x += (this.x - t.x) / 7, t.y += this.speed.y, t.z -= t.z / 30, this.transform.scale.set(e, e, e))

            }

            preview() {
                let t = this.transform.rotate;
                t.y = (t.y + 1) % 360, t.z = (t.z + .7) % 360
            }
        }(X.hero[0], D.WHITE),
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

                if (continueGame==1){
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
                this.config = t.split("|"), this.length = e, this.flag=1,this.steps = s
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

                if (continueGame==1){
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
        if (requestAnimationFrame(tt), H.clear(H.COLOR_BUFFER_BIT), U.shop) return K.mesh = X.hero[U.selected], K.preview(), Q(K), void Q(K, .01);
        let t = (new Date).getTime();
        if (t - W > 30 && J.update(), W = t, J.update(), Q(J), Q(J, .01), !K.active && V) {
            let t = p.mixer("music"),
                e = t.context.currentTime;
            t.gain.setValueCurveAtTime(Float32Array.from([U.volume, 0]), e, .5), V.stop(e + .5), V = null
        }!U.active && J.ended() && U.score(K)
    }
    async function et() {
        Y = !0;
        let t = B("#start");
        t.className = "disabled", t.textContent = "loading", await p.init(), await Promise.all([p.sound("exp", new d("custom", [5, 1, 0], 1), [220, 0], 1), p.sound("hit", new d("custom", [3, 1, 0], 1), [1760, 0], .3), p.sound("power", new d("square", [.5, .1, 0], 1), [440, 880, 440, 880, 440, 880, 440, 880], .3), p.sound("jump", new d("triangle", [.5, .1, 0], 1), [220, 880], .3), p.sound("coin", new d("square", [.2, .1, 0], .2), [1760, 1760], .2), p.sound("move", new d("custom", [.1, .5, 0], .3), [1760, 440], .3), p.music("music", [new f(new d("sawtooth", [1, .3], .2), "8a2,8a2,8b2,8c3|8|8g2,8g2,8a2,8b2|8|8e2,8e2,8f2,8g2|4|8g2,8g2,8a2,8b2|4|".repeat(4), 1), new f(new d("sawtooth", [.5, .5], 1), "1a3,1g3,2e3,4b3,4c4,1a3c3e3,1g3b3d4,2e3g3b3,4d3g3b3,4g3c4e4|1|" + "8a3,8a3e4,8a3d4,8a3e4|2|8g3,8g3d4,8g3c4,8g3d4|2|8e3,8e3a3,8e3b3,8e3a3,4g3b3,4g3c4|1|".repeat(2), 4)])]), B("#load").className = "hide", tt()
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
                            e = t.context.currentTime;
                        t.gain.setValueAtTime(U.volume, e), V = p.play("music", !0, "music")
                    }
                }), i.on("end", () => {
                    K.init(!1), U.show()
                })
            }()
    }), B("ontouchstart" in window ? "#keys" : "#touch").className = "hide"
}]); </script></body > </html>