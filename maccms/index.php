<?php
/*
������ƣ�MacCMS
'�������ߣ�MagicBlack    �ٷ���վ��http://www.maccms.com/
'--------------------------------------------------------
'���ñ���������ѭ CC BY-ND ���Э��
'�ⲻ��һ�������������ֻ���ڲ�������ҵĿ�ĵ�ǰ���¶Գ����������޸ĺ�ʹ�ã�
'������Գ���������κ���ʽ�κ�Ŀ�ĵ��ٷ�����
'--------------------------------------------------------
*/
?>
<?php
	require_once ("inc/config.php");
	if(app_install==0){ header("Location:install/index.php" );	}
	require_once ("inc/conn.php");
    $page = be("all", "page");
    if (!isNum($page)){ $page = 1;} else { $page = intval($page);}
    if ($page < 1){ $page = 1;}
    
    if (app_vodviewtype < 2 || app_vodviewtype == 3){
        attemptCacheFile ("app", "index".$page);
        $template->html = getFileByCache("template_index", root ."template/" . app_templatedir . "/" . app_htmldir . "/index.html");
        
        $mac["page"] = $page;
        $cacheName = "vodindex".$page;
        if (chkCache($cacheName)){
            $template->html = getCache($cacheName);
        }
        else{
            $template->mark();
            $template->vodpagelist();
            $template->pageshow();
            $template->ifEx();
            setCache ($cacheName, $template->html,0);
        }
        setCacheFile ("app", "index".$page, $template->html);
        $template->run();
        echo $template->html;
    }
    else{
        redirect ( $template->getIndexLink() );
    }
    dispseObj();
?>