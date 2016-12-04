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
<script src="/bitrix/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="/bitrix/js/jquery.countdown.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/bitrix/js/materialize.css">
<script src="/bitrix/js/materialize.min.js"></script>
<?CUtil::InitJSCore(array('ajax', 'jquery'/*Если не подключена ранее*/, 'popup'));// Подключаем библиотеку?>
<style>
<!--
#ajax-add-schema {display:none; width:1024px; min-height:578px;}
-->
</style>
<script type="text/javascript">
<!--
BX.ready(function(){
   var schema = new BX.PopupWindow("schema", null, {
      content: BX('ajax-add-schema'),//Контейнер
      closeIcon: {right: "20px", top: "10px"},//Иконка закрытия
      titleBar: {content: BX.create("span", {html: '<b>Схема проъезда</b>', 'props': {'className': 'access-title-bar'}})},//Название окна 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: true},//Окно можно перетаскивать на странице
      /*Если потребуется, можно использовать кнопки управления формой        
        buttons: [
         new BX.PopupWindowButton({
            text: "Отправить",
            className: "popup-window-button-accept",
            events: {click: f unction(){
               BX.ajax.submit(BX("myForm"), f unction(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                  BX('ajax-add-schema').innerHTML = data;
                });
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: f unction(){
               this.popupWindow.close();// закрытие окна
            }}
         })
         ]
   */}); 

   $('.loading').click(function(){
	   BX.ajax.insertToNode('zakaz.php', BX('ajax-add-schema'));//ajax-загрузка контента из url, у меня он помещён в "Короткие ссылки" /bitrix/admin/short_uri_admin.php?lang=ru
      //Можно использовать такой адрес /include/schema.php      
      schema.show(); //отображение окна
   });
});
//-->
</script>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="col s3" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="height:330px;">
		<div class="card"><div class="card-image">
			<div style="position:absolute;top:0;bottom:0;right:0;left:0;z-index:1;<?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан'):?>background:url('/upload/medialibrary/f48/vydan.png');<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Готов'):?>background:url('http://zakaz.thomifelgen.ru/upload/medialibrary/585/gotov.png');<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Предварительный'):?>background:url('/upload/medialibrary/dab/otmenen.png');<?endif;?>background-position:center;background-repeat:no-repeat;"></div>
			<?if($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]>0 and empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"])):?>
				<img class="materialboxed" width="100%" src="/upload/medialibrary/edb/fotonet.jpg">
			<?endif;?>
			<?if($arItem["PROPERTIES"]["PRUSLN"]["VALUE"] == "чистка смывки"):?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
				<img class="materialboxed" src="<?=$renderImage["src"];?>" width="100%">
			<?else:?>
			<?if(empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]) and !in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?>
				<img src="/upload/medialibrary/81e/fotonetr.jpg">
			<?endif;?>
			<?endif;?>
			<?if($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]>0 and !empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"])):?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
				<img class="materialboxed" src="<?=$renderImage["src"];?>" width="100%">
			<?endif;?>
			<?if($arItem["PROPERTIES"]["STREM"]["VALUE"]+$arItem["PROPERTIES"]["SVAR"]["VALUE"]>0 and !empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"]) and in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
				<img class="materialboxed" src="<?=$renderImage["src"];?>" width="100%">
			<?endif;?>

			<span class="card-title" style="background:rgba(0, 0, 0, 0.65);padding:5px;"><?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Автомобиль"):?><i class="fa fa-car"></i><?endif;?><?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Мотоцикл"):?><i class="fa fa-motorcycle"></i><?endif;?><?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?><i class="fa fa-inbox"></i><?endif;?> <?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] = "Автомобиль" or $arItem["PROPERTIES"]["TYPE"]["VALUE"] = "Мотоцикл"):?><?=$arItem["PROPERTIES"]["DIAMETR"]["VALUE"];?> x <?=$arItem["PROPERTIES"]["KOL"]["VALUE"];?> <?=$arItem["PROPERTIES"]["MARKA"]["VALUE"];?><?endif;?></span>
			<span class="card-title" style="top:0;bottom:inherit;background:rgba(0, 0, 0, 0.65);padding:5px;"><?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>

				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				Заказ №<?echo $arItem["NAME"]?>	<span style="font-size:14px;"><?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"])):?><b>|ПК|</b><?endif;?> <?if(!empty($arItem["PROPERTIES"]["PRICEPOL"]["VALUE"])):?><b>|ПЛ|</b><?endif;?> <?if(!empty($arItem["PROPERTIES"]["STREM"]["VALUE"])):?><b>|РЕМ|</b><?endif;?> <?if(!empty($arItem["PROPERTIES"]["PRICESHIN"]["VALUE"])):?><b>|ШНМ|</b><?endif;?></span>
				<?else:?>
					<?echo $arItem["NAME"]?>
				<?endif;?>
			</span></div><?if(!empty($arItem["PROPERTIES"]["REALDATE"]["VALUE"])):?><?$dvyd=$arItem["PROPERTIES"]["REALDATE"]["VALUE"];?><?else:?><?$dvyd=$arItem["TIMESTAMP_X"];?><?endif;?><?$interval=date("d.m.Y", strtotime($dvyd))-date("d.m.Y");?><?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан' or $arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Предварительный' or $arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Готов'):?><?if($interval < 0):?><span style="width:100%;" class="btn btn-xs light-green darken-4">Заказ закрыт</span><?else:?><a style="width:100%;" class="btn btn-primary btn-xs" href="zakazc.php?edit=Y&amp;CODE=<?=$arItem["ID"]?>"><?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан'):?>Заказ закроется через: <span style="font-weight:800" data-countdown="<?=date("Y/m/d", strtotime("$dvyd +1 day"));?>"></span><?endif;?></a><?endif;?><?else:?><a style="width:100%;" class="btn btn-primary btn-xs" href="<?if($arItem["IBLOCK_SECTION_ID"] == "153"):?>zakazpc.php<?else:?>zakazc.php<?endif;?>?edit=Y&amp;CODE=<?=$arItem["ID"]?>">Отметить выполненное</a><?endif;?>

		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="bx-newslist-content">
			<?echo $arItem["PREVIEW_TEXT"];?>
			</div>
		<?endif;?>


		<div class="row">
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="col-xs-5">
				<div class="bx-newslist-date">Дата выдачи заказ <i class="fa fa-calendar-o"></i> <?=$arItem["DATE_ACTIVE_TO"]?></div>
			</div>
		<?endif?>
		<?if($arParams["USE_RATING"]=="Y"):?>
			<div class="col-xs-7 text-right">
				<?$APPLICATION->IncludeComponent(
					"bitrix:iblock.vote",
					"flat",
					Array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"ELEMENT_ID" => $arItem["ID"],
						"MAX_VOTE" => $arParams["MAX_VOTE"],
						"VOTE_NAMES" => $arParams["VOTE_NAMES"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
						"SHOW_RATING" => "N",
					),
					$component
				);?>
			</div>
		<?endif?>
		</div>
		<div class="row">

		<?
		if ($arParams["USE_SHARE"] == "Y")
		{
			?>
			<div class="col-xs-7 text-right">
				<noindex>
				<?
				$APPLICATION->IncludeComponent("bitrix:main.share", $arParams["SHARE_TEMPLATE"], array(
						"HANDLERS" => $arParams["SHARE_HANDLERS"],
						"PAGE_URL" => $arItem["~DETAIL_PAGE_URL"],
						"PAGE_TITLE" => $arItem["~NAME"],
						"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
						"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
						"HIDE" => $arParams["SHARE_HIDE"],
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				?>
				</noindex>
			</div>
			<?
		}
		?>
		</div>
	</div>
	</div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
	<div id="ajax-add-schema"></div>
<div id="schema1" style="display:none;"></div>
<script>
 $('[data-countdown]').each(function() {
   var $this = $(this), finalDate = $(this).data('countdown');
   $this.countdown(finalDate, function(event) {
     $this.html(event.strftime('%H:%M:%S'));
   });
 });
</script>
