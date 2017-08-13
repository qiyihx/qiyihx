{php !defined('IN_MANAGE') && exit('Access Denied!');use phpWeChat\Form;use phpWeChat\Banner;use phpWeChat\MySql;}

<!doctype html>

<html>

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>奇异幻想后台管理-广告</title>

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

          <div class="crumb-list"><i class="picurln-font"></i><a href="{__PW_PATH__}{__ADMIN_FILE__}?file=index&action=main">管理首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><a href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}">广告</a></span></div>

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

                        <th width="6%">序号</th>
                        <th width="16%">标题</th>
                        <th width="12%">图片</th>
                        <th width="20%">跳转地址</th>
                        <th width="6%">类型</th>
                        <th width="6%">状态</th>
                        <th width="12%">创建时间</th>

              <th width="11%">管理</th>

                    </tr>


                   {loop Banner::bannerList() $r}
                      <tr>
                          <td>{$r['sort']}</td>
                          <td>{$r['name']}</td>
                          <td>{if $r['picurl']}<img src="{$r['picurl']}" style="max-width:55px; max-height:55px;">{/if}</td>
                          <td>{$r['url']}</td>
                          <td>{$r['type']}</td>
                          <td>{$r['status']}</td>
                          <td>{$r['createtime']}</td>
                          <td>
                              <a href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}&id={$r['id']}">编辑</a>
                              &nbsp;&nbsp;&nbsp;
                              <a onClick="if(!confirm('确定要删除该广告吗？删除后不可恢复！')){return false;}" href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}&job=delete&id={$r['id']}">删除</a>
                          </td>
                      </tr>
                     {/loop}
                  </table>

              </div>

          </form>

       <form action="" method="post" name="mysubmitform" id="mysubmitform" enctype="multipart/form-data">

              <input type="hidden" value="1" name="dosubmit">

                <input type="hidden" value="{$id}" name="id">

                <div class="config-items" style="margin-top:8px">

                    <div class="config-title">

                        <h1><a href="{__PW_PATH__}{__ADMIN_FILE__}?mod={$mod}&file={$file}&action={$action}"><i class="picurln-font">&#xe026;</i>{if $id}编辑{else}添加{/if}分类</a></h1>

                    </div>

                    <div class="result-content">

                        <table width="100%" class="insert-tab">

                            <tbody>

                              <tr class="formtr">

                                    <th class="formth"><i class="require-red">*</i>标题：</th>

                                    <td class="formtd">

                                  <input type="text" class="common-text" name="info[name]" value="{$data['name']}" size="36" />

                                    </td>

                                </tr>

                <tr class="formtr">

                                    <th class="formth"><i class="require-red">*</i>图片：</th>

                                    <td class="formtd">

                                  {Form::image('等级图标','picurl',$data['picurl'])}

                                    </td>

                                </tr>

                <tr class="formtr">

                                    <th class="formth"><i class="require-red">*</i>跳转地址：</th>

                                    <td class="formtd">

                                  <input type="text" class="common-text" name="info[url]" size="64" value="{$data['url']}" />
                                    </td>

                                </tr>
                <tr class="formtr">
                                    <th class="formth"><i class="require-red">*</i>序号：</th>

                                    <td class="formtd">

                                  <input type="text" class="common-text" name="info[sort]" size="2" value="{$data['sort']}" />
                                    </td>

                                </tr>
                 <tr class="formtr">

                                    <th class="formth"><i class="require-red">*</i>类型：</th>

                                    <td class="formtd">

                                 <select name="info[type]">
                                        <label>
                                              <option value="0" <?php if($data[type] == '0') echo"selected"; ?>>通用</option>
                                              <option value="1" <?php if($data[type] == '1') echo"selected"; ?>>微信小程序</option>
                                              <option value="2" <?php if($data[type] == '2') echo"selected"; ?>>PC端</option>
                                              <option value="3" <?php if($data[type] == '3') echo"selected"; ?>>移动端</option>
                                         </label>

                                    </select>
                                    </td>

                                </tr>
                  <tr class="formtr">

                              <th class="formth" width="20%"><i class="require-red">*</i>状态：</th>

                              <td class="formtd">
                                  <select name="info[status]">
                                        <label>
                                              <option value="0" <?php if($data[status] == '0') echo"selected"; ?>>隐藏</option>
                                              <option value="1" <?php if($data[status] == '1') echo"selected"; ?>>显示</option>
                                         </label>

                                    </select>
                                </td>

                                </tr>

                                <tr class="formtr">

                                    <th class="formth"></th>

                                    <td class="formtd">

                                        <input type="button" onClick="doSubmit('mysubmitform','')" value="提 交" class="submit-button">

                                        <input type="button" value="返 回" onClick="history.go(-1)" class="reset-button">

                                    </td>

                                </tr>

                            </tbody></table>

                    </div>

                </div>

            </form>

      </div>

  </div>

    <div class="statics-footer"> Powered by QiyiHx V{__PHPWECHAT_VERSION__}{__PHPWECHAT_RELEASE__} © , Processed in {php echo microtime()-$PW['time_start'];} second(s) , {MySql::$mQuery} queries <a href="#">至顶端↑</a></div>

</body>

</html>