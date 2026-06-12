<?php
/*
 * @Theme Name:WebStack
 * @Author: iowen
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$friend_links = get_posts(array(
    'post_type' => 'sites',
    'tax_query' => array(
        array('taxonomy' => 'favorites', 'field' => 'term_id', 'terms' => 23)
    ),
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
));
?>
<nav id="top-nav" class="navbar user-info-navbar" role="navigation">

  <div class="topbar-left">
    <a href="#" data-toggle="sidebar" id="nav-hamburger" class="nav-btn" title="导航菜单">
      <i class="fa fa-bars"></i>
    </a>
    <span class="topbar-title" id="nav-site-title">MC灵依资源站</span>
  </div>

  <div id="nav-desktop-content">
    <?php if (!empty($friend_links)) : ?>
    <div id="fl-wrap">
      <span class="fl-label"><i class="fa fa-link" style="font-size:10px;margin-right:4px;"></i>友链</span>
      <?php foreach ($friend_links as $link) :
        $lu = get_post_meta($link->ID, '_sites_link', true);
        $li = get_post_meta($link->ID, '_thumbnail', true);
        $lt = esc_attr($link->post_title);
        if (empty($li)) $li = io_get_option('ico_url') . format_url($lu) . io_get_option('ico_png');
        $fi = strtoupper(mb_substr($lt,0,1,'UTF-8'));
        $fs = 'data:image/svg+xml,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"><rect width="28" height="28" rx="14" fill="#1e1e28"/><text x="14" y="18" text-anchor="middle" font-size="13" font-family="Arial,sans-serif" font-weight="700" fill="#d4af37">'.$fi.'</text></svg>');
      ?>
      <a href="<?php echo esc_url($lu); ?>" target="_blank" title="<?php echo $lt; ?>" class="fl-ico-link">
        <img src="<?php echo esc_attr($li); ?>" class="fl-ico" onerror="this.onerror=null;this.src='<?php echo esc_attr($fs); ?>'">
      </a>
      <?php endforeach; ?>
      <span id="fl-more" title="更多友链">+</span>
      <div id="fl-menu">
        <?php foreach ($friend_links as $link) :
          $lu2 = get_post_meta($link->ID, '_sites_link', true);
          $li2 = get_post_meta($link->ID, '_thumbnail', true);
          if (empty($li2)) $li2 = io_get_option('ico_url') . format_url($lu2) . io_get_option('ico_png');
          $fi2 = strtoupper(mb_substr($link->post_title,0,1,'UTF-8'));
          $fs2 = 'data:image/svg+xml,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"><rect width="24" height="24" rx="12" fill="#1e1e28"/><text x="12" y="16" text-anchor="middle" font-size="12" font-family="Arial,sans-serif" font-weight="700" fill="#d4af37">'.$fi2.'</text></svg>');
          $host2 = parse_url($lu2,PHP_URL_HOST);
        ?>
        <a href="<?php echo esc_url($lu2); ?>" target="_blank" class="fl-menu-item">
          <img src="<?php echo esc_attr($li2); ?>" class="fl-menu-ico" onerror="this.onerror=null;this.src='<?php echo esc_attr($fs2); ?>'">
          <span class="fl-menu-name"><?php echo esc_html($link->post_title); ?></span>
          <span class="fl-menu-host"><?php echo esc_html($host2); ?></span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <script>
    (function(){
      var w=document.getElementById('fl-wrap');if(!w)return;
      var m=document.getElementById('fl-menu'),o=false;
      document.getElementById('fl-more').onclick=function(e){e.preventDefault();e.stopPropagation();o=!o;m.style.display=o?'block':'none';};
      document.addEventListener('click',function(e){if(!w.contains(e.target)){o=false;m.style.display='none';}});
    })();
    </script>
    <?php endif; ?>
    <span class="fl-divider"></span>
    <a href="https://qm.qq.com/cgi-bin/qm/qr?_wv=1027&k=B2G7aGdS6AcwPnV0bw-Uvho23YTAMPo5&authKey=pR840xaXIbq2jlV6aMESl2E%2BnZDuC9vCGGOW8JMf5WjKLdIXq91ZmDM%2BmUEhP7j3&noverify=0&group_code=162358740" target="_blank" id="nav-qq-link">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M21.395 15.035a39.548 39.548 0 0 0-1.51-3.38c.94-2.14 1.34-4.13 1.34-5.85 0-3.42-1.81-6.04-4.59-6.84C15.845 2.84 14.385 2.4 12.775 2.4c-1.61 0-3.07.44-4.36 1.56C5.635 4.76 3.825 7.38 3.825 10.8c0 1.72.4 3.71 1.34 5.85a39.548 39.548 0 0 0-1.51 3.38c-.23.63-.11 1.02.33 1.21.44.2 1.07-.05 1.73-.67.5.72 1.1 1.3 1.77 1.73a7.572 7.572 0 0 0 3.36.77c1.17 0 2.28-.26 3.26-.73.57.35 1.15.54 1.73.54s1.16-.19 1.73-.54c.98.47 2.09.73 3.26.73a7.572 7.572 0 0 0 3.36-.77c.67-.43 1.27-1.01 1.77-1.73.66.62 1.29.87 1.73.67.44-.19.56-.58.33-1.21zM7.545 13.36c-.19 0-.36-.18-.36-.4s.16-.4.36-.4.36.18.36.4-.17.4-.36.4zm9.91 0c-.19 0-.36-.18-.36-.4s.16-.4.36-.4.36.18.36.4-.17.4-.36.4z"/></svg>
      加入QQ群
    </a>
  </div>
</nav>

<style>
/* 
 * 覆盖 nav.css 的所有关键规则：
 * - .user-info-navbar { margin:-30px } → margin:0
 * - nav.navbar { width:calc(100%-250px) } → width:auto (left:0;right:0锚定)
 * - nav.navbar { z-index:2000!important } → z-index:9990!important
 */
#top-nav,
#top-nav.navbar,
#top-nav.user-info-navbar {
  display: flex !important;
  align-items: center !important;
  justify-content: flex-start;
  margin: 0 !important;
  padding: 0 24px;
  height: 50px !important;
  min-height: 50px !important;
  position: fixed !important;
  top: 0 !important;
  left: 250px !important;
  right: 0 !important;
  width: auto !important;
  max-width: none !important;
  z-index: 9990 !important;
  background: rgba(14,14,20,.88) !important;
  backdrop-filter: blur(20px) saturate(1.6) !important;
  -webkit-backdrop-filter: blur(20px) saturate(1.6) !important;
  border-bottom: 2px solid rgba(212,175,55,.3) !important;
  box-shadow: 0 4px 24px rgba(0,0,0,.25), 0 1px 8px rgba(212,175,55,.06) !important;
  box-sizing: border-box;
}

/* 左分组：汉堡+站点名 */
.topbar-left {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-shrink: 0;
}

/* 站点名 */
.topbar-title {
  font-size: 16px;
  font-weight: 600;
  color: #d4af37;
  letter-spacing: .5px;
  white-space: nowrap;
}

/* 按钮通用 */
.nav-btn {
  display: flex !important;
  align-items: center !important;
  justify-content: center;
  width: 42px;
  height: 42px;
  flex-shrink: 0;
  color: rgba(255,255,255,.75);
  font-size: 18px;
  border-radius: 10px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.08);
  transition: all .2s;
  cursor: pointer;
  text-decoration: none;
  -webkit-tap-highlight-color: transparent;
}
.nav-btn:active {
  background: rgba(212,175,55,.15) !important;
  color: #d4af37 !important;
}

/* 桌面友链样式 */
.fl-label{font-size:12px;font-weight:600;letter-spacing:1px;margin-right:12px;color:#d4af37;background:linear-gradient(135deg,rgba(212,175,55,.12) 0%,rgba(212,175,55,.03) 100%);border:1px solid rgba(212,175,55,.15);border-radius:4px;padding:3px 8px 3px 6px;display:inline-flex;align-items:center;}
.fl-ico-link{display:inline-flex;margin-left:-2px;transition:transform .15s;position:relative;z-index:1;}
.fl-ico-link:first-of-type{margin-left:0;}
.fl-ico-link:hover{transform:translateY(-3px);z-index:2;}
.fl-ico{width:30px;height:30px;border-radius:50%;object-fit:cover;background:#1e1e28;border:2px solid rgba(30,30,40,.5);transition:border-color .2s;}
.fl-ico-link:hover .fl-ico{border-color:rgba(212,175,55,.5);}
#fl-more{cursor:pointer;margin-left:6px;width:26px;height:26px;border-radius:50%;background:rgba(212,175,55,.06);border:1px solid rgba(212,175,55,.12);display:inline-flex;align-items:center;justify-content:center;color:rgba(212,175,55,.45);font-size:12px;transition:all .2s;}
#fl-more:hover{background:rgba(212,175,55,.15);color:#d4af37;border-color:rgba(212,175,55,.3);}
.fl-divider{width:1px;height:20px;background:rgba(212,175,55,.1);margin:0 14px;flex-shrink:0;display:block;}
#fl-wrap{display:inline-flex;align-items:center;gap:0;position:relative;margin-right:12px;}
#fl-menu{display:none;position:absolute;top:calc(100% + 8px);right:0;background:rgba(12,12,18,.96);backdrop-filter:blur(16px);border:1px solid rgba(212,175,55,.1);border-radius:10px;min-width:280px;z-index:9999;overflow:hidden;box-shadow:0 16px 48px rgba(0,0,0,.55),0 0 1px rgba(212,175,55,.1);padding:6px 0;}
.fl-menu-item{display:flex;align-items:center;gap:10px;padding:9px 16px;color:rgba(255,255,255,.65);text-decoration:none;transition:background .15s;}
.fl-menu-item:hover{color:#fff;}
.fl-menu-ico{width:22px;height:22px;border-radius:5px;object-fit:cover;background:#1e1e28;flex-shrink:0;border:1px solid rgba(212,175,55,.08);}
.fl-menu-name{font-size:13px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.fl-menu-host{margin-left:auto;font-size:11px;color:rgba(212,175,55,.25);flex-shrink:0;}
#nav-qq-link{display:inline-flex;align-items:center;gap:6px;color:rgba(212,175,55,.6);font-size:13px;text-decoration:none;transition:color .2s;padding:8px 10px;}
#nav-qq-link:hover{color:#d4af37;}

/* 隐藏友情链接分类 */
#term-23,.fav-section-23{display:none!important;}.friendlink,.friendlinks,#friendlink{display:none!important;}

/* ===== 桌面端 ===== */
@media screen and (min-width: 768px){
  #nav-site-title { display: none !important; }
  #nav-desktop-content {
    display: flex !important;
    align-items: center;
    flex: 1;
    justify-content: flex-end;
  }
  /* 侧边栏折叠态 banner left 适配 */
  body.sidebar-collapsed #top-nav {
    left: 80px !important;
  }
}

/* ===== 移动端 ===== */
@media screen and (max-width: 767px){
  #top-nav,
  #top-nav.navbar,
  #top-nav.user-info-navbar {
    padding: 0 14px !important;
    height: 56px !important;
    min-height: 56px !important;
  }
  #nav-site-title { display: inline-block !important; font-size: 14px; }
  #nav-desktop-content { display: none !important; }
  /* 地球按钮加大点击区域 */
}
</style>
<script>
/* 侧边栏折叠联动 Banner */
(function(){
  if(window.innerWidth < 768) return;
  var sidebar = document.querySelector('.sidebar-menu');
  var body = document.body;
  if(!sidebar) return;
  if(localStorage.getItem('sidebar-collapsed') === '1'){
    sidebar.classList.add('collapsed');
    body.classList.add('sidebar-collapsed');
  }
  window.syncSidebarState = function(){
    if(sidebar.classList.contains('collapsed')){
      body.classList.add('sidebar-collapsed');
      localStorage.setItem('sidebar-collapsed', '1');
    } else {
      body.classList.remove('sidebar-collapsed');
      localStorage.removeItem('sidebar-collapsed');
    }
  };
  window.syncSidebarState();
  /* 桌面端汉堡按钮：切换侧边栏折叠态 */
  var hamburger = document.querySelector('#top-nav a[data-toggle="sidebar"]') || document.querySelector('#nav-hamburger');
  if(hamburger){
    hamburger.addEventListener('click', function(e){
      e.preventDefault();
      sidebar.classList.toggle('collapsed');
      window.syncSidebarState();
    });
  }
})();
</script>
