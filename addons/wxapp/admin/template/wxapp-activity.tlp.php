{php !defined('IN_MANAGE') && exit('Access Denied!');use phpWeChat\Form;use phpWeChat\Activity;use phpWeChat\MySql;}

<!doctype html>

<html>

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>奇异幻想后台管理-活动</title>

    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}admin/template/css/common.css"/>

    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}admin/template/css/main.css"/>

    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}statics/core.css"/>

    <link rel="stylesheet" type="text/css" href="{__PW_PATH__}statics/reveal/reveal.css"/>

    <script language="javascript" type="text/javascript">

    var PW_PATH='{__PW_PATH__}';

  </script>

  <script src="{__PW_PATH__}statics/jquery/jquery-1.12.2.min.js" language="javascript"></script>

    <script src="{__PW_PATH__}statics/reveal/jquery.reveal.js" language="javascript"></script>

  <script src="{__PW_PATH__}statics/core.js" language="javascript"></script>

    <script type="text/javascript" src="{__PW_PATH__}admin/template/js/libs/modernizr.min.js"></script>

    <script language="javascript" type="text/javascript">

  $(document).ready(function(){

    $('#parentid').val({$data['parentid']});

  });

  </script>

</head>

<body>

<div class="ifame-main-wrap">

      <div class="crumb-wrap">

          <div class="crumb-list"><i class="picurln-font"></i><a href="{__PW_PATH__}{__ADMIN_FILE__}?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><a href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}">活动</a></span></div>

      </div>

      <div class="result-wrap">

          <form name="myform" id="myform" action="" method="post">

              <input type="hidden" value="delete" name="job" id="job">

              <div class="result-title">

                  <div class="result-list">

                      <a href="###" onClick="if(isCheckboxChecked()){$('#job').val('delete');$('#myform').submit();}else{alert('请选择要'+$(this).text()+' 的项目！')}"><i class="picurln-font">&#xe037;</i>批量删除</a>

                  </div>

              </div>

              <div class="result-content">

                  <table class="result-tab" width="100%">

                      <tr>
                        <th width="5%">图片</th>
                        <th width="16%">名称</th>
                        <th width="10%">时间</th>
                        <th width="10%">地点</th>
                        <th width="5%">发起人</th>
                        <th width="5%">类型</th> 
                        <th width="5%">状态</th>
                        <th width="10%">最近修改时间</th>

              <th width="11%">管理</th>

                    </tr>


                   {loop Activity::activityList() $r}
                      <tr>
                          <td>{if $r['picurl']}<img src="{$r['picurl']}" style="max-width:55px; max-height:55px;">{/if}</td>
                          <td>{$r['title']}</td>
                          <td>{$r['date']} {$r['time']}</td>
                          <td>{$r['location']}</td>
                          <td>{$r['user_name']}</td>
                          <td>
                            <?php if($r['type'] == '0') echo"旅行"; ?>
                            <?php if($r['type'] == '1') echo"运动"; ?>
                            <?php if($r['type'] == '2') echo"会议"; ?>
                            <?php if($r['type'] == '3') echo"聚会"; ?>
                            <?php if($r['type'] == '4') echo"晚会"; ?>
                            <?php if($r['type'] == '5') echo"娱乐"; ?>
                          </td>
                          <td>
                            <?php if($r['status'] == '0') echo"发布中"; ?>
                            <?php if($r['status'] == '1') echo"通过"; ?>
                            <?php if($r['status'] == '2') echo"不通过"; ?>
                          </td>
                          <td>{date("Y-m-d H:i",$r['update_time'])}</td>
                          <td>  
                              {if $r['status'] != '1'}<a onClick="if(!confirm('确定要通过该活动吗？')){return false;}" href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}&job=across&id={$r['id']}">通过</a>{/if}
                              {if $r['status'] != '2'}<a onClick="if(!confirm('确定要不通过该活动吗？')){return false;}" href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}&job=noacross&id={$r['id']}">不通过</a>{/if}
                              &nbsp;&nbsp;&nbsp;
                              <a onClick="if(!confirm('确定要删除该活动吗？删除后不可恢复！')){return false;}" href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}&job=delete&id={$r['id']}">删除</a>
                          </td>
                      </tr>
                     {/loop}
                  </table>

              </div>

          </form>


      </div>

  </div>

    <div class="statics-footer"> Powered by QiyiHx V{__PHPWECHAT_VERSION__}{__PHPWECHAT_RELEASE__} © , Processed in {php echo microtime()-$PW['time_start'];} second(s) , {MySql::$mQuery} queries <a href="#">至顶端↑</a></div>

</body>

</html>