<?php 
/*
 * @Theme Name:WebStack
 * @Theme URI:https://github.com/owen0o0/WebStack
 * @Author: iowen
 * @Author URI: https://www.iowen.cn/
 * @Date: 2019-02-22 21:26:02
 * @LastEditors: iowen
 * @LastEditTime: 2023-04-24 00:42:32
 * @FilePath: \WebStack\footer.php
 * @Description: 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$_icp = '';
if(io_get_option('icp')){
    $_icp .= '<a href="https://beian.miit.gov.cn/" target="_blank" rel="link noopener">' . io_get_option('icp') . '</a>&nbsp;';
}
if ($police_icp = io_get_option('police_icp')) {
    if (preg_match('/\d+/', $police_icp, $arr)) {
        //$_icp .= ' <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=' . $arr[0] . '" target="_blank" class="'.$class.'" rel="noopener">' . $police_icp . '</a>&nbsp;';
        $_icp .= ' <a target="_blank" rel="noopener external nofollow noreferrer" href="https://beian.mps.gov.cn/#/query/webSearch?code=13040302001660"><img class="icp-icon" src="https://beian.mps.gov.cn/web/assets/logo01.6189a29f.png" style="width:25px;height:27px;"> </a><a href="https://beian.mps.gov.cn/#/query/webSearch?code=' . $arr[0] . '" target="_blank" rel="noopener">' . $police_icp . '</a>&nbsp;';
        
    }
}
?>
            <footer class="main-footer sticky footer-type-1">
                <div class="footer-inner">
                    <!---请保留版权说明，谢谢---->
                    <div class="footer-text">
                        Copyright © 2023-<?php echo date('Y') ?> <?php bloginfo('name'); ?> <?php echo $_icp ?>
                       &nbsp;|&nbsp;&nbsp;Page Modify by <a href="https://github.com/owen0o0" target="_blank" style="text-decoration: underline;"><strong>iowen</strong></a> & <a href="https://github.com/fr1g" target="_blank" style="text-decoration: underline;"><strong>fr1g</strong></a> & <a href="https://github.com/CaterMaozi" target="_blank" style="text-decoration: underline;"><strong>Cater</strong></a> &nbsp;&nbsp;|&nbsp;&nbsp;Website By <a href="https://github.com/CaterMaozi" target="_blank" style="text-decoration: underline;"><strong>Cater</strong></a>&nbsp;&nbsp;|&nbsp;
                       <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh-hans" target="_blank" style="text-decoration: underline;"><strong>CC BY-NC-SA 4.0</strong></a>&nbsp;&nbsp;|&nbsp;
                     <div title="MySSL安全认证签章" id="myssl_seal" onclick="window.open('https://myssl.com/seal/detail?domain=mcres.cn','MySSL安全认证签章','height=800,width=470,top=0,right=0,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no')" style="text-align: center;display: inline-block;cursor: pointer"><img src="https://static.myssl.com/res/images/myssl-id1.png" alt="MySSL安全认证签章" style="width: 100px; height: auto;"></div>
                    </div>
                    <!---请保留版权说明，谢谢---->
                </div>
            </footer>
        </div>
    </div>
<?php if (is_home() || is_front_page()): ?>
    <script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function () { 
            if($('a.smooth[href="'+window.location.hash+'"]')[0]){
                $('a.smooth[href="'+window.location.hash+'"]').click();
            } else if(window.location.hash != ''){
                $("html, body").animate({
                    scrollTop: $(window.location.hash).offset().top - 80
                }, {
                    duration: 500,
                    easing: "swing"
                });
            }
        }, 300);
        $(document).on('click', '.has-sub', function(){
            var _this = $(this)
            if(!$(this).hasClass('expanded')) {
                setTimeout(function(){
                    _this.find('ul').attr("style","")
                }, 300);
            } else {
                $('.has-sub ul').each(function(id,ele){
                    var _that = $(this)
                    if(_this.find('ul')[0] != ele) {
                        setTimeout(function(){
                            _that.attr("style","")
                        }, 300);
                    }
                })
            }
        })
        $('.user-info-menu .hidden-xs').click(function(){
            if($('.sidebar-menu').hasClass('collapsed')) {
                $('.has-sub.expanded > ul').attr("style","")
            } else {
                $('.has-sub.expanded > ul').show()
            }
        })
        $("#main-menu li ul li").click(function() {
            $(this).siblings('li').removeClass('active'); // 删除其他兄弟元素的样式
            $(this).addClass('active'); // 添加当前元素的样式
        });
        $("a.smooth").click(function(ev) {
            ev.preventDefault();
            if($("#main-menu").hasClass('mobile-is-visible') != true)
                return;
            public_vars.$mainMenu.add(public_vars.$sidebarProfile).toggleClass('mobile-is-visible');
            ps_destroy();
            $("html, body").animate({
                scrollTop: $($(this).attr("href")).offset().top - 80
            }, {
                duration: 500,
                easing: "swing"
            });
        });
        return false;
    });

    var href = "";
    var pos = 0;
    $("a.smooth").click(function(e) {
        e.preventDefault();
        if($("#main-menu").hasClass('mobile-is-visible') === true)
            return;
        $("#main-menu li").each(function() {
            $(this).removeClass("active");
        });
        $(this).parent("li").addClass("active");
        href = $(this).attr("href");
        pos = $(href).position().top - 100;
        $("html,body").animate({
            scrollTop: pos
        }, 500);
    });
    </script>
<?php endif; ?>
<?php wp_footer(); ?>
<!-- 自定义代码 -->
<?php echo io_get_option('code_2_footer');?>
<!-- end 自定义代码 -->
<div class="go-up">
    <a href="#" rel="go-top">
        <i class="fa fa-angle-up"></i>
    </a>
</div>
<!-- 移动端抽屉菜单：导航分类(左) + 友链(右) -->
<script>
(function(){
    // 桌面端不创建抽屉DOM，避免显示在footer下方
    if(window.innerWidth >= 768) return;

    var bodyOverflow = { set: function(v){ document.body.style.overflow = v; }, reset: function(){ this.set(''); } };

    /**
     * 平滑滚动到锚点（用于导航抽屉点击）
     */
    function smoothScrollToHash(href, callback){
        if(!href || href === '#'){ if(callback) callback(); return; }
        var id = href.split('#')[1];
        if(!id){ if(callback) callback(); return; }
        // 兼容 #term-XXX 和直接 #XXX
        var target = document.getElementById('term-'+id) || document.getElementById(id);
        if(!target){ if(callback) callback(); return; }
        var top = target.getBoundingClientRect().top + window.pageYOffset - 80;
        window.scrollTo({ top: top, behavior: 'smooth' });
        if(callback) setTimeout(callback, 400);
    }

    /* ===== 1. 导航分类抽屉(左侧) ===== */
    (function(){
        var sidebar = document.getElementById('side-bar');
        if(!sidebar) return;
        var menu = sidebar.querySelector('.main-menu');
        if(!menu) return;

        // 遮罩
        var overlay = document.createElement('div');
        overlay.className = 'mobile-drawer-overlay';
        document.body.appendChild(overlay);

        // 抽屉面板
        var drawer = document.createElement('div');
        drawer.className = 'mobile-drawer';
        var header = document.createElement('div');
        header.className = 'mobile-drawer-header';
        header.innerHTML = '<span class="drawer-title">导航分类</span><span class="drawer-close"><i class="fa fa-times"></i></span>';
        drawer.appendChild(header);

        // 克隆菜单
        var menuClone = menu.cloneNode(true);
        menuClone.removeAttribute('id');
        menuClone.style.display = 'block';
        drawer.appendChild(menuClone);
        document.body.appendChild(drawer);

        function toggle(open){
            if(open){
                drawer.classList.add('active');
                overlay.classList.add('active');
                bodyOverflow.set('hidden');
            } else {
                drawer.classList.remove('active');
                overlay.classList.remove('active');
                bodyOverflow.reset();
            }
        }

        overlay.addEventListener('click', function(){ toggle(false); });
        header.querySelector('.drawer-close').addEventListener('click', function(){ toggle(false); });

        // 绑定汉堡按钮
        var sidebarToggle = document.querySelector('#top-nav a[data-toggle="sidebar"]') || document.querySelector('#nav-hamburger');
        if(sidebarToggle){
            sidebarToggle.addEventListener('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                toggle(true);
            });
        }

        // 菜单项交互：有子菜单→展开/折叠，无子菜单→跳转并关闭
        menuClone.querySelectorAll('li').forEach(function(li){
            var sub = li.querySelector('ul');
            var link = li.querySelector(':scope > a');
            if(!link) return;

            if(sub){
                // 有子菜单 → 点击展开/折叠
                sub.style.display = 'none';
                li.classList.add('has-sub');
                link.addEventListener('click', function(e){
                    e.preventDefault();
                    var isOpen = li.classList.contains('opened');
                    // 关闭同级其他展开项
                    li.parentElement.querySelectorAll(':scope > li.opened').forEach(function(sibling){
                        if(sibling !== li){
                            sibling.classList.remove('opened');
                            var sibUl = sibling.querySelector(':scope > ul');
                            if(sibUl) sibUl.style.display = 'none';
                        }
                    });
                    li.classList.toggle('opened');
                    sub.style.display = isOpen ? 'none' : 'block';
                });
            } else {
                // 无子菜单 → 平滑跳转+关闭抽屉
                link.addEventListener('click', function(e){
                    e.preventDefault();
                    var href = link.getAttribute('href');
                    toggle(false);
                    smoothScrollToHash(href);
                });
            }
        });

        // 子菜单项点击跳转
        menuClone.querySelectorAll('li li > a').forEach(function(link){
            var origClick = link._listener;
            link.addEventListener('click', function(e){
                e.preventDefault();
                e.stopPropagation();
                var href = link.getAttribute('href');
                toggle(false);
                smoothScrollToHash(href);
            });
        });
    })();

    /* ===== 2. 友链抽屉(右侧) ===== */
    (function(){
        var flWrap = document.getElementById('fl-wrap');
        if(!flWrap) return;

        // 收集友链数据（从桌面端的图标行）
        var links = [];
        flWrap.querySelectorAll('a.fl-ico-link').forEach(function(a){
            var img = a.querySelector('img.fl-ico');
            var title = a.getAttribute('title') || a.textContent.trim();
            links.push({
                href: a.href,
                title: title,
                imgSrc: img ? img.src : ''
            });
        });
        if(!links.length) return;


        // 遮罩
        var flOverlay = document.createElement('div');
        flOverlay.className = 'fl-drawer-overlay';
        document.body.appendChild(flOverlay);

        // 抽屉面板
        var flDrawer = document.createElement('div');
        flDrawer.className = 'fl-drawer';
        var flHeader = document.createElement('div');
        flHeader.className = 'fl-drawer-header';
        flHeader.innerHTML = '<span><i class="fa fa-globe" style="margin-right:8px;"></i>友情链接</span><span class="fl-drawer-close"><i class="fa fa-times"></i></span>';
        flDrawer.appendChild(flHeader);

        var listDiv = document.createElement('div');
        listDiv.className = 'fl-drawer-list';
        links.forEach(function(lk){
            var item = document.createElement('a');
            item.className = 'fl-drawer-item';
            item.href = lk.href;
            item.target = '_blank';
            item.rel = 'noopener';
            var imgTag = lk.imgSrc ? '<img src="'+lk.imgSrc+'" onerror="this.style.display=\'none\'">' : '';
            item.innerHTML = imgTag + '<span class="fl-name">' + lk.title + '</span>';
            listDiv.appendChild(item);
        });
        flDrawer.appendChild(listDiv);
        document.body.appendChild(flDrawer);

        function toggleFl(open){
            if(open){
                flDrawer.classList.add('active');
                flOverlay.classList.add('active');
                bodyOverflow.set('hidden');
            } else {
                flDrawer.classList.remove('active');
                flOverlay.classList.remove('active');
                bodyOverflow.reset();
            }
        }

        // 暴露全局函数，供header-banner.php的onclick调用

        flOverlay.addEventListener('click', function(){ toggleFl(false); });
        flHeader.querySelector('.fl-drawer-close').addEventListener('click', function(){ toggleFl(false); });
        // 点击友链项关闭抽屉
        listDiv.querySelectorAll('.fl-drawer-item').forEach(function(item){
            item.addEventListener('click', function(){ toggleFl(false); });
        });
    })();

})();
</script>
</body>
</html>