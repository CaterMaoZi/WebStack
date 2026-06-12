<?php
include "./wp-load.php";
$url = $_GET['url'] ?? '';
$b = $url ? base64_decode($url) : '';
$host = $b ? parse_url($b, PHP_URL_HOST) : '';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<meta http-equiv="refresh" content="2;url=<?php echo htmlspecialchars($b); ?>">
<meta name="robots" content="noindex,follow">
<link rel="shortcut icon" href="/favicon.ico">
<title>资源站 · 跳转中</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:#0a0a0f;font-family:-apple-system,BlinkMacSystemFont,"SF Pro Display","PingFang SC",sans-serif;overflow:hidden}
canvas{position:fixed;top:0;left:0;width:100%;height:100%;z-index:0;pointer-events:none}
.card{position:relative;z-index:10;max-width:420px;width:90%;background:rgba(255,255,255,.04);border:1px solid rgba(212,175,55,.2);border-radius:20px;padding:48px 36px 40px;text-align:center;backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);box-shadow:0 24px 80px rgba(0,0,0,.5),0 0 60px rgba(212,175,55,.06);animation:cardIn .6s cubic-bezier(.22,1,.36,1) both}
@keyframes cardIn{from{opacity:0;transform:translateY(30px) scale(.96)}to{opacity:1;transform:none}}
.icon-wrap{width:72px;height:72px;margin:0 auto 24px;border-radius:50%;background:linear-gradient(135deg,rgba(212,175,55,.15),rgba(212,175,55,.03));border:1px solid rgba(212,175,55,.25);display:flex;align-items:center;justify-content:center;animation:pulse 2s ease-in-out infinite}
@keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(212,175,55,.2)}50%{box-shadow:0 0 0 12px rgba(212,175,55,0)}}
.icon-wrap svg{width:32px;height:32px}
h2{font-size:20px;font-weight:700;color:#d4af37;margin-bottom:8px;letter-spacing:.5px}
.dest{font-size:13px;color:rgba(255,255,255,.45);margin-bottom:28px;word-break:break-all;line-height:1.5}
.progress-wrap{width:100%;height:4px;background:rgba(255,255,255,.06);border-radius:2px;overflow:hidden;margin-bottom:20px}
.progress-bar{height:100%;width:0%;background:linear-gradient(90deg,#d4af37,#f0c040);border-radius:2px;transition:width .3s linear}
.timer{font-size:14px;color:rgba(212,175,55,.6);margin-bottom:24px}
.btn-goto{display:inline-flex;align-items:center;gap:8px;padding:12px 32px;background:linear-gradient(135deg,rgba(212,175,55,.15),rgba(212,175,55,.05));border:1px solid rgba(212,175,55,.3);border-radius:12px;color:#d4af37;text-decoration:none;font-size:15px;font-weight:600;backdrop-filter:blur(12px);transition:all .3s;cursor:pointer}
.btn-goto:hover{background:linear-gradient(135deg,rgba(212,175,55,.25),rgba(212,175,55,.1));box-shadow:0 0 24px rgba(212,175,55,.2);transform:translateY(-2px)}
.btn-goto svg{width:16px;height:16px;transition:transform .3s}
.btn-goto:hover svg{transform:translateX(3px)}
.footer{text-align:center;font-size:11px;color:rgba(255,255,255,.2);position:relative;z-index:10;margin-top:20px}
</style>
</head>
<body>
<canvas id="c"></canvas>
<div class="card">
  <div class="icon-wrap">
    <svg viewBox="0 0 24 24" fill="none" stroke="#d4af37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
  </div>
  <h2>正在跳转</h2>
  <div class="dest"><?php echo htmlspecialchars($host ?: $b); ?></div>
  <div class="progress-wrap"><div class="progress-bar" id="bar"></div></div>
  <div class="timer" id="timer">即将离开资源站...</div>
  <a href="<?php echo htmlspecialchars($b); ?>" class="btn-goto" id="btn">
    立即前往
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
  </a>
</div>
<div class="footer">资源站 · mcres.cn</div>
<script>
(function(){var c=document.getElementById("c"),x=c.getContext("2d"),W,H;function r(){W=c.width=innerWidth;H=c.height=innerHeight}r();addEventListener("resize",r);var ms=[];setInterval(function(){ms.push({x:Math.random()*W*1.5,y:-10,l:Math.random()*80+40,s:Math.random()*6+4,o:Math.random()*.4+.2})},450);function d(){x.clearRect(0,0,W,H);for(var i=ms.length-1;i>=0;i--){var m=ms[i];var g=x.createLinearGradient(m.x,m.y,m.x+m.l*.3,m.y+m.l);g.addColorStop(0,"rgba(212,175,55,0)");g.addColorStop(1,"rgba(212,175,55,"+m.o+")");x.beginPath();x.moveTo(m.x,m.y);x.lineTo(m.x+m.l*.3,m.y+m.l);x.strokeStyle=g;x.lineWidth=1.5;x.stroke();x.beginPath();x.arc(m.x+m.l*.3,m.y+m.l,1.5,0,6.28);x.fillStyle="rgba(212,175,55,"+m.o+")";x.fill();m.x+=m.s*.4;m.y+=m.s;if(m.y>H+100)ms.splice(i,1)}requestAnimationFrame(d)}d();
var bar=document.getElementById("bar"),t=document.getElementById("timer"),s=0,limit=2000,start=Date.now();
function tick(){s=Date.now()-start;var p=Math.min(s/limit*100,100);bar.style.width=p+"%";var left=Math.max(0,Math.ceil((limit-s)/1000));t.textContent="将在 "+left+"s 后自动跳转";if(s<limit)requestAnimationFrame(tick)}tick();
})();
</script>
</body>
</html>
