<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
?>
<div class="bx-newslist">

<?CUtil::InitJSCore(array('ajax', 'jquery'/*Если не подключена ранее*/, 'popup'));// Подключаем библиотеку?>
<style>
<!--
#ajax-add-schema {display:none; width:1024px; min-height:578px;}
-->
</style>


<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row">
<div class="bx-newslist-container col-sm-6 col-md-4">
<div class="bx-newslist-block">
<?$name1 = CUser::GetFullName();?>
<?$avtor = array ('PSMYVA'=>1,'VSMYVA'=>1,'ISMYVA'=>1,'SNKOLA'=>1,'DEMKOLA'=>1,'MKOLA'=>1,'BALKOLA'=>1,'UKOLA'=>1,'REMTKOLA'=>1,'SVARKA'=>1,'MOYKAA'=>1,'PRGEOA'=>1,'RAZDA'=>1,'SBDA'=>1,'RPODA'=>1,'VGRBA'=>1,'IGRBA'=>1,'SHKOMA'=>1,'VSRDA'=>1,'VFINA'=>1,'IFINA'=>1,'MASKIA'=>1,'CHORMA'=>1,'GRUNTA'=>1,'SHGRA'=>1,'POKRSA'=>1,'POKR2A'=>1,'LAKA'=>1,'ISREDA'=>1);?>
<?$iu=0;?>
<?foreach ($arResult["ITEMS"] as $arRes => $arNew1):?>
	<?foreach ($arNew1["PROPERTIES"] as $key2 => $arNew2):?>
<?$arNew[] = $arNew2["VALUE"];?>


<?endforeach;?>
<?endforeach;?>
<pre>

</pre>




		</div></div>


</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
	<div id="ajax-add-schema"></div>
<div id="schema1" style="display:none;"></div>
<?

$arGroupAvalaible = array(1);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect = array_intersect($arGroupAvalaible, $arGroups);
if(!empty($result_intersect)):

echo "<pre>";
   print_r($arResult);
echo "</pre>";

endif;

?>