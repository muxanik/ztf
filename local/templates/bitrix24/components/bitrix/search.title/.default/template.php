<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
?>

<div style="margin-top:-46px;" class="header-search<?if (!IsModuleInstalled("timeman") || (CModule::IncludeModule('bitrix24') && SITE_ID == "ex")):?> timeman-simple<?endif?>" id="<?=$CONTAINER_ID?>"><form method="get" name="search-form" action="<?=$arResult["FORM_ACTION"]?>"><input  data-formula="P17&P18" name="q" id="<?=$INPUT_ID?>" type="text" autocomplete="off" value="<?=GetMessage("CT_BST_SEARCH_HINT")?>" class="header-search-input" /></form></div>

<? $frame = $this->createFrame()->begin(""); ?>

<script type="text/javascript">
new B24.SearchTitle({
	'AJAX_PAGE' : '<?=CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
	'CONTAINER_ID': '<?=$CONTAINER_ID?>',
	'INPUT_ID': '<?=$INPUT_ID?>',
	'MIN_QUERY_LEN': 2
});
</script>
<? $frame->end(); ?>
