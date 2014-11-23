<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-23 12:29:12
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16737845325471c50840b0f0-95738132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb9c5ff4a70ba8d282b4a44f121383e13d943640' => 
    array (
      0 => './templates/index.tpl',
      1 => 1416742067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16737845325471c50840b0f0-95738132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'language' => 0,
    'languages' => 0,
    'short' => 0,
    'label' => 0,
    'user' => 0,
    'navigation' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5471c5084b63b6_93736882',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5471c5084b63b6_93736882')) {function content_5471c5084b63b6_93736882($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Plants for your home</title>
    <link rel="stylesheet" type="text/css" media="screen" href="design.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/design.css"/>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/script.js"><?php echo '</script'; ?>
>
</head>
<body>
<div id="promise">
    <?php echo $_smarty_tpl->tpl_vars['language']->value["OUR_PROMISE"];?>

    <div id="languages">
        <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_smarty_tpl->tpl_vars['short'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->_loop = true;
 $_smarty_tpl->tpl_vars['short']->value = $_smarty_tpl->tpl_vars['label']->key;
?>
            <a href="?lang=<?php echo $_smarty_tpl->tpl_vars['short']->value;?>
">&raquo; <?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</a>
        <?php } ?>
    </div>
</div>
<div id="company">
    <div id="logo_and_slogan">
        <img id="logo" src="pictures/Logo_Plant_Front.png" width="110" height="80" border="0"/>

        <h1>Plants for your home</h1>
    </div>
    <div id="sitemap">
        <div id="login">
            <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
                <?php echo $_smarty_tpl->tpl_vars['language']->value["LOGIN_HELLO"];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value["firstname"];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value["lastname"];?>

                <button type=button onclick="logoutj()">Logout!</button>
            <?php } else { ?>
                <form action="" method="post">
                    <label for="username"><?php echo $_smarty_tpl->tpl_vars['language']->value["LOGIN_FORM_USERNAME"];?>
</label>
                    <input id="username" name="username" type="text"/>
                    <label for="password"><?php echo $_smarty_tpl->tpl_vars['language']->value["LOGIN_FORM_PASSWORD"];?>
</label>
                    <input id="password" name="password" type="password"/>
                    <button type="submit" name="submit"><?php echo $_smarty_tpl->tpl_vars['language']->value["LOGIN_FORM_LOGIN"];?>
</button>
                </form>
            <?php }?>
        </div>
        <div id="shopping_cart">
            <div class="title"><?php echo $_smarty_tpl->tpl_vars['language']->value["SHOPPING_CART_NAME"];?>
</div>
            <!-- TODO : display shopping cart items -->
        </div>
    </div>
</div>
<div id="navigation_pane">
    <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['label']->key;
?>
        <a href="index.php?page=<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="navigation_pane"><?php echo $_smarty_tpl->tpl_vars['label']->value;?>
</a>
    <?php } ?>
</div>
<div id="preview_pane">
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['inner_template']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
</body>
</html><?php }} ?>
