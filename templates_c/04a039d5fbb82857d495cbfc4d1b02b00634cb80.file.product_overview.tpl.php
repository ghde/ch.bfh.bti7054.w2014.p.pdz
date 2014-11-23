<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-11-23 12:29:12
         compiled from "./templates/product_overview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18883175285471c50857ad86-91336239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04a039d5fbb82857d495cbfc4d1b02b00634cb80' => 
    array (
      0 => './templates/product_overview.tpl',
      1 => 1416742067,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18883175285471c50857ad86-91336239',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'inner_products' => 0,
    'product' => 0,
    'language' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5471c5085d81c0_84881204',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5471c5085d81c0_84881204')) {function content_5471c5085d81c0_84881204($_smarty_tpl) {?><div id="plants">
    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['inner_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
        <div>
            <h3><?php echo $_smarty_tpl->tpl_vars['product']->value["name"];?>
</h3>
            <img class="plant" src="pictures/<?php echo $_smarty_tpl->tpl_vars['product']->value["picture"];?>
" width="200" height="200" border="0">

            <p><?php echo $_smarty_tpl->tpl_vars['product']->value["description"];?>
</p>
            <form action="index.php" method="GET">
                <input type="hidden" name="page" value="order" />
                <input type="hidden" name="plantID" value="<?php echo $_smarty_tpl->tpl_vars['product']->value["id"];?>
" />
                <button type="submit"><?php echo $_smarty_tpl->tpl_vars['language']->value["PRODUCT_BUY_NOW"];?>
</button>
            </form>
        </div>
    <?php } ?>
</div><?php }} ?>
