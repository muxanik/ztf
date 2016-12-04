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

$this->addExternalCss("/bitrix/css/main/font-awesome.css");

?>
<style>
.meter { 
	height: 20px;  /* Can be anything */
	position: relative;
	background: #555;
	-moz-border-radius: 25px;
	-webkit-border-radius: 25px;
	border-radius: 25px;

	box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
}
.meter > span {
  display: block;
  height: 100%;
  border-top-right-radius: 8px;
  border-bottom-right-radius: 8px;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
  background-color: rgb(38, 166, 154);
  background-image: linear-gradient(
    center bottom,
    rgb(43,194,83) 37%,
    rgb(84,240,84) 69%
  );
  box-shadow: 
    inset 0 2px 9px  rgba(255,255,255,0.3),
    inset 0 -2px 6px rgba(0,0,0,0.4);
  position: relative;
  overflow: hidden;
}
</style>
<script src="/bitrix/js/jquery.simplemarquee.js"></script>

<div class="bx-newslist">


<div class="row">
<a href="zakaz.php" class="btn btn-primary waves-effect waves-light">Новый заказ</a> <a href="zakazpr.php" class="btn purple darken-2 waves-effect waves-light">Заказ прочее</a>
	</div>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<div class="row">
<div class="col s12">
<div class="collection">
<?$jj=0;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="collection-item <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан'):?>green lighten-4<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Предварительный'):?>grey lighten-2<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Плюс минус'):?>blue lighten-4<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Готов'):?>orange lighten-4<?endif;?>" style="<?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан'):?>background:url('/upload/medialibrary/f48/vydan.png');<?endif;?> <?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Готов'):?>background:url('http://zakaz.thomifelgen.ru/upload/medialibrary/585/gotov.png');<?endif;?>background-repeat: no-repeat;background-position: center;"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]) or in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?>
<?$r=2;?>
<?else:?>
<?$r=0;?>
<?endif;?>
<?$br=0;?>



<div class="row">
		<div class="col s1" style="text-align: center;font-size: 10px;padding: 0 0.25rem 0 0;">
			<?if($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]>0 and empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"])):?>
				<img class="materialboxed circle" width="100%" src="/upload/medialibrary/7b3/bezfoto.jpg" width="100%">
			<?endif;?>
			<?if(empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]) and !in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?>
				<img class="materialboxed circle"  src="/upload/medialibrary/e47/netreb.jpg" width="100%">
			<?endif;?>
			<?if(($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"])>0 and !empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"])):?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"], Array("width"=>"300", "height"=>"300"), BX_RESIZE_IMAGE_EXACT);?>
				<img class="materialboxed circle" src="<?=$renderImage["src"];?>" width="100%">
			<?endif;?>
			<?if(($arItem["PROPERTIES"]["STREM"]["VALUE"]+$arItem["PROPERTIES"]["SVAR"]["VALUE"])>0 and !empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"]) and in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"], Array("width"=>"300", "height"=>"300"), BX_RESIZE_IMAGE_EXACT);?>
				<img class="materialboxed circle" src="<?=$renderImage["src"];?>" width="100%">
			<?endif;?>
<?=$arItem["PROPERTIES"]["STATUS"]["VALUE"]?><br>
			Заказ принял:<br><?if(!empty($arItem["PROPERTIES"]["OTVETSTV"]["VALUE"])):?><?=$arItem["PROPERTIES"]["OTVETSTV"]["VALUE"];?><?else:?><?=substr(stristr($arItem["CREATED_USER_NAME"], ') '),2);?><?endif;?>
</div>
<div class="col s2">
<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<h6><b>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					Заказ №<?echo $arItem["NAME"]?><?$jj++;?>
				<?else:?>
					Заказ №<?echo $arItem["NAME"]?>
				<?endif;?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><i class="fa fa-eye"></i></a> <a  href="zakaz<?if($arItem["IBLOCK_SECTION_ID"] == "153"):?>pr<?endif;?>.php?edit=Y&amp;CODE=<?=$arItem["ID"]?>"><i class="fa fa-edit"></i></a></b></h6>
		<?endif;?>
	<p>Дата приема: <?=date('d.m.Y', strtotime($arItem["DATE_ACTIVE_FROM"]))?><br>
		Дата выдачи:<br><span style="font-size: 14px;color: white;border-radius: 20px;padding:2px;font-weight: 800;position:absolute;border: 2px solid #FFF;-webkit-box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75); -moz-box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75); box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75);background:#ff9800"><?=$arItem["DATE_ACTIVE_TO"]?></span><br>
		<?if($arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Готов' or $arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Выдан' or $arItem["PROPERTIES"]["STATUS"]["VALUE"] == 'Предварительный'):?><?else:?><?if(round((strtotime($arItem["DATE_ACTIVE_TO"])-strtotime("now"))/60/60/24) < 0):?><div class="some-el" style="color:red;">Заказ просрочен. Необходимо связаться с заказчиком или проверить актуальность статуса.</div><?else:?><br>Осталось: <?=round((strtotime($arItem["DATE_ACTIVE_TO"])-strtotime("now"))/60/60/24);?> дней<?endif;?><?endif;?>
</p>
	</div>
<div class="col s2">
	<?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"])):?><b>|Покраска|</b><?$r++;?><?if(!empty($arItem["PROPERTIES"]["COLOR2"]["VALUE"])):?>в 2 цвета<?endif;?> - <?=$arItem["PROPERTIES"]["COLOR"]["VALUE"]?><?if(!empty($arItem["PROPERTIES"]["COLOR2"]["VALUE"])):?>+<?endif;?><?=$arItem["PROPERTIES"]["COLOR2"]["VALUE"]?><br><?endif;?>
	<?if(!empty($arItem["PROPERTIES"]["PRICEPOL"]["VALUE"])):?><b>|Полировка|</b><?$r++;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["STREM"]["VALUE"])):?><b>|Ремонт|</b><?$r++;?> <?if(!empty($arItem["PROPERTIES"]["SVAR"]["VALUE"])):?>со сваркой<?endif;?><br><?endif;?>
	<?if(!empty($arItem["PROPERTIES"]["PRICEBOLT"]["VALUE"]) or !empty($arItem["PROPERTIES"]["SBRZB"]["VALUE"])):?><b>|Доп. услуги|</b><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICESHIN"]["VALUE"])):?><b>|Шиномонтаж|</b><?$r++;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICEDOST"]["VALUE"])):?><b>|Доставка|</b><?$r++;?><br><?endif;?>
		</div>
<div class="col s2">
	<?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]) or in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?><i class="fa fa-camera"></i>ДО:<?if(empty($arItem["PROPERTIES"]["FOTODO"]["VALUE"]["0"])):?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?else:?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?endif;?><br><?endif;?>
	<?if(!empty($arItem["PROPERTIES"]["STREM"]["VALUE"])):?><i class="fa fa-gavel"></i>РЕМ:<?if(count($arItem["PROPERTIES"]["REMTKOL"]["VALUE"]) == $arItem["PROPERTIES"]["REMKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["REMTKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><?if(count($arItem["PROPERTIES"]["REMTKOL"]["VALUE"]) < $arItem["PROPERTIES"]["REMKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["REMTKOL"]["VALUE"])):?>сделано <?=count($arItem["PROPERTIES"]["REMTKOL"]["VALUE"])?> шт<?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"])):?><i class="fa fa-paint-brush"></i>ПКР:<?if(count($arItem["PROPERTIES"]["LAK"]["VALUE"]) == $arItem["PROPERTIES"]["KOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["LAK"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><?if(count($arItem["PROPERTIES"]["LAK"]["VALUE"]) < $arItem["PROPERTIES"]["KOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["LAK"]["VALUE"])):?>сделано <?=count($arItem["PROPERTIES"]["LAK"]["VALUE"])?> шт<?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICEPOL"]["VALUE"])):?><i class="fa fa-paint-brush"></i>ПЛР:<?if(count($arItem["PROPERTIES"]["LAK"]["VALUE"]) == $arItem["PROPERTIES"]["KOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["LAK"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><?if(count($arItem["PROPERTIES"]["LAK"]["VALUE"]) < $arItem["PROPERTIES"]["KOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["LAK"]["VALUE"])):?>сделано <?=count($arItem["PROPERTIES"]["LAK"]["VALUE"])?> шт<?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICESHIN"]["VALUE"])):?><i class="fa fa-paint-brush"></i>ШНМ:
	<?if(end($arItem["PROPERTIES"]["SHINO"]["VALUE"]) == "демонтаж"):?><?if(count($arItem["PROPERTIES"]["DEMKOL"]["VALUE"]) == $arItem["PROPERTIES"]["SHINKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["DEMKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?>
	<?if(end($arItem["PROPERTIES"]["SHINO"]["VALUE"]) == "монтаж"):?><?if(count($arItem["PROPERTIES"]["MKOL"]["VALUE"]) == $arItem["PROPERTIES"]["SHINKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["MKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?>
	<?if(end($arItem["PROPERTIES"]["SHINO"]["VALUE"]) == "балансировка"):?><?if(count($arItem["PROPERTIES"]["BALKOL"]["VALUE"]) == $arItem["PROPERTIES"]["SHINKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["BALKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?>
	<?if(end($arItem["PROPERTIES"]["SHINO"]["VALUE"]) == "установка"):?><?if(count($arItem["PROPERTIES"]["UKOL"]["VALUE"]) == $arItem["PROPERTIES"]["SHINKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["UKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?>
	<?if(end($arItem["PROPERTIES"]["SHINO"]["VALUE"]) == "комплекс"):?><?if(count($arItem["PROPERTIES"]["UKOL"]["VALUE"]) == $arItem["PROPERTIES"]["SHINKOL"]["VALUE"] and !empty($arItem["PROPERTIES"]["UKOL"]["VALUE"])):?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?else:?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?endif;?><?endif;?><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arItem["PROPERTIES"]["PRICEPOL"]["VALUE"]) or in_array('требуется фото', $arItem["PROPERTIES"]["REM"]["VALUE"])):?><i class="fa fa-camera"></i>ПОСЛЕ:<?if(empty($arItem["PROPERTIES"]["FPOS"]["VALUE"]["0"])):?><span style="color:red"><i class="fa fa-exclamation-triangle"></i></span>НЕТ<?else:?><span style="color:green"><i class="fa fa-check-circle"></i></span>ДА<?$br++;?><?endif;?><?endif;?>
<div class="meter">
	<span style="color:#fff;text-align:center;width: <?=$br/$r*100;?>%"><?=round($br/$r*100);?>%</span>
</div>
	</div>
<div class="col s3">
<?if(!empty($arItem["PROPERTIES"]["PARTNER"]["VALUE"])):?><i class="fa fa-building"></i> <?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"];?><br><?endif;?>
<i class="fa fa-user"></i> <?=$arItem["PROPERTIES"]["FIO"]["VALUE"];?><br>
<i class="fa fa-phone"></i> <?=$arItem["PROPERTIES"]["TELEPHONE"]["VALUE"];?><br>
	<?if(!empty($arItem["PROPERTIES"]["EMAIL"]["VALUE"])):?><i class="fa fa-envelope"></i> <a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"];?>"><?=$arItem["PROPERTIES"]["EMAIL"]["VALUE"];?></a><br><?endif;?>
<?if(!empty($arItem["PROPERTIES"]["PRIM"]["VALUE"])):?><i class="fa fa-info-circle"></i> <?=$arItem["PROPERTIES"]["PRIM"]["VALUE"];?><br><?endif;?>
	<?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Автомобиль"):?><i class="fa fa-car"></i><?endif;?><?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Мотоцикл"):?><i class="fa fa-motorcycle"></i><?endif;?><?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?><i class="fa fa-inbox"></i><?endif;?> <?if($arItem["PROPERTIES"]["TYPE"]["VALUE"] = "Автомобиль" or $arItem["PROPERTIES"]["TYPE"]["VALUE"] = "Мотоцикл"):?><?=$arItem["PROPERTIES"]["DIAMETR"]["VALUE"];?> x <?=$arItem["PROPERTIES"]["KOL"]["VALUE"];?> <?=$arItem["PROPERTIES"]["MARKA"]["VALUE"];?><?endif;?>
	</div>
<div class="col s2">
	<span style="font-size:11px;">Без скидки:</span> <b><?=number_format($arItem["PROPERTIES"]["ITOGO"]["VALUE"],0,'',' ');?></b> <?if($arItem["PROPERTIES"]["ITOGO"]["VALUE"] != $arItem["PROPERTIES"]["PREDPRICE"]["VALUE"]):?><span class="deep-orange darken-3" style="display:none;font-size: 11px;color: white;border-radius: 50%;margin: -4px 3px;font-weight: 800;position:absolute;border: 2px solid #FFF;-webkit-box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75); -moz-box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75); box-shadow: 2px 2px 4px 0px rgba(0,0,0,0.75);">-<?=round(100-$arItem["PROPERTIES"]["PREDPRICE"]["VALUE"]/$arItem["PROPERTIES"]["ITOGO"]["VALUE"]*100, 1)?>%</span><?endif;?><br>
	<?if($arItem["PROPERTIES"]["PREDPRICE"]["VALUE"] == $arItem["PROPERTIES"]["ITOGO"]["VALUE"]):?><?else:?><span style="font-size:11px;">Со скидкой:</span> <b><?=number_format($arItem["PROPERTIES"]["PREDPRICE"]["VALUE"],0,'',' ');?></b><br><?endif;?>
	<?if(!empty($arItem["PROPERTIES"]["PREDO"]["VALUE"])):?><?if($arItem["PROPERTIES"]["PREDO"]["VALUE"] == $arItem["PROPERTIES"]["PREDPRICE"]["VALUE"]):?><span style="font-size:11px;color:green;">Оплачен:</span> <?else:?><span style="font-size:11px;">Предоплата:</span><?endif;?> <b><?=number_format($arItem["PROPERTIES"]["PREDO"]["VALUE"],0,'',' ')?></b> <?if($arItem["PROPERTIES"]["OPCAR"]["VALUE"]["0"] != "Р/с" and !empty($arItem["PROPERTIES"]["OPCAR"]["VALUE"]["0"])):?><i class="fa fa-credit-card"></i><?if($arItem["PROPERTIES"]["OPCAR"]["VALUE_ENUM_ID"]["0"] == "510"):?> <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Альфа-Банк">А</span><?endif;?><?if($arItem["PROPERTIES"]["OPCAR"]["VALUE_ENUM_ID"]["0"] == "509"):?> <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Сбербанк">C</span><?endif;?><?else:?><i class="fa fa-rub"></i><?endif;?> <i class="fa fa-clock-o tooltipped" data-position="top" data-delay="50" data-tooltip="<?=$arItem["PROPERTIES"]["DPREDO"]["VALUE"]?>"></i><?endif;?>
	<?if(!empty($arItem["PROPERTIES"]["DOPL"]["VALUE"])):?><span style="font-size:11px;">Доплата:</span> <b><?=number_format($arItem["PROPERTIES"]["DOPL"]["VALUE"],0,'',' ')?></b> <?if($arItem["PROPERTIES"]["DOPCAR"]["VALUE"]["0"] != "Р/с" and !empty($arItem["PROPERTIES"]["DOPCAR"]["VALUE"]["0"])):?><i class="fa fa-credit-card"></i><?if($arItem["PROPERTIES"]["DOPCAR"]["VALUE_ENUM_ID"]["0"] == "513"):?> <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Альфа-Банк">А</span><?endif;?><?if($arItem["PROPERTIES"]["DOPCAR"]["VALUE_ENUM_ID"]["0"] == "512"):?> <span class="tooltipped" data-position="top" data-delay="50" data-tooltip="Сбербанк">C</span><?endif;?><?else:?><i class="fa fa-rub"></i><?endif;?> <i class="fa fa-clock-o tooltipped" data-position="top" data-delay="50" data-tooltip="<?=$arItem["PROPERTIES"]["DDOPL"]["VALUE"]?>"></i><?endif;?><br>
	<?if(!empty($arItem["PROPERTIES"]["REALDATE"]["VALUE"])):?><span style="font-size:11px;">Фактическая дата выдачи:</span><br><b><?$vydacha=explode(" ",$arItem["PROPERTIES"]["REALDATE"]["VALUE"]);?><?=$vydacha[1]?> в <?=$vydacha[0]?></b><?endif;?>

	</div>
		
	</div>

</div>

<?endforeach;?>
</div>
</div></div>
<script>
	$('.some-el').simplemarquee({
		speed: 110,
		cycles: Infinity
	});
</script>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
	<div id="ajax-add-schema"></div>
<div id="schema1" style="display:none;"></div>
<?$arNew = array();?>
<?$arrNew = array();?>
<?$arrrNew = array();?>
<?$arnNew = array();?>
<?$nmonth=date("d.m.Y", strtotime('1 '.date('M').' '.date('Y')));?>
<?$lmonth=date("d.m.Y", strtotime("$nmonth +1 month -1 day"));?>
<?$nowdate = date('d.m.Y', strtotime("now"));?>
<?$wdate = date('d.m.Y', strtotime("$nowdate -1 week"));?>
<?$pdate = date('d.m.Y', strtotime("$nowdate -1 day"));?>
<?$pmdate = date('d.m.Y', strtotime("$nmonth -1 month"));?>
<?$pldate = date('d.m.Y', strtotime("$pmdate +1 month -1 day"));?>
<?=$pmdate;?> 
<?=$pldate;?>
<?
$db_el = CIBlockElement::GetList(
   array('ID' => 'DESC'),
   array("IBLOCK_ID" => '32','!=PROPERTY_STATUS_VALUE' => 'Предварительный',
      '>=DATE_ACTIVE_FROM' => $nmonth,
      '<=DATE_ACTIVE_FROM' => $lmonth . ' 23:59:59'      
   )
);
while($ob = $db_el->GetNextElement()){ 
$arFields = $ob->GetFields();

$arProp = $ob->GetProperties();?>
<?$arNew[$arFields["DATE_ACTIVE_FROM"]] = $arProp["PREDPRICE"];?>

<?}?>
<?foreach($arNew as $key => $arNew1):?>
<?$arNew2[] = $arNew1["VALUE"];?>

<?endforeach;?>


<?
$db_el55 = CIBlockElement::GetList(
   array('ID' => 'DESC'),
   array('IBLOCK_ID' => '32','!=PROPERTY_STATUS_VALUE' => 'Предварительный', 
      '>=TIMESTAMP_X' => $nmonth,
      '<=TIMESTAMP_X' => $lmonth . ' 23:59:59'     
   )
);
while($ob77 = $db_el55->GetNextElement()){ 
$arFields77 = $ob77->GetFields();

$arProp77 = $ob77->GetProperties();?>
<?if(!empty($arProp77["REALDATE"]["VALUE"])):?>
<?$arNew55[] = $arProp77["PREDPRICE"]["VALUE"];?>
<?endif;?>

<?}?>




<?
$db_el8 = CIBlockElement::GetList(
   array('ID' => 'DESC'),
   array("IBLOCK_ID" => '32','!=PROPERTY_STATUS_VALUE' => 'Предварительный',
      '>=DATE_ACTIVE_FROM' => $pmdate,
      '<=DATE_ACTIVE_FROM' => $pldate . ' 23:59:59'      
   )
);
while($ob8 = $db_el8->GetNextElement()){ 
$arFields8 = $ob8->GetFields();

$arProp8 = $ob8->GetProperties();?>
<?$arnNew[$arFields8["DATE_ACTIVE_FROM"]] = $arProp8["PREDPRICE"];?>

<?}?>
<?foreach($arnNew as $key8 => $arNew18):?>
<?$arNew28[] = $arNew18["VALUE"];?>

<?endforeach;?>

<?
$db_el1 = CIBlockElement::GetList(
   array('ID' => 'DESC'),
   array("IBLOCK_ID" => '32','!=PROPERTY_STATUS_VALUE' => 'Предварительный',
      '>=DATE_ACTIVE_FROM' => $wdate,
      '<=DATE_ACTIVE_FROM' => $nowdate      
   )
);
while($ob1 = $db_el1->GetNextElement()){ 
$arFields1 = $ob1->GetFields();

$arProp1 = $ob1->GetProperties();?>
<?$arrNew[$arFields1["DATE_ACTIVE_FROM"]] = $arProp1["PREDPRICE"];?>

<?}?>
<?foreach($arrNew as $key1 => $arNew11):?>
<?$arNew21[] = $arNew11["VALUE"];?>

<?endforeach;?>
<?
$db_el2 = CIBlockElement::GetList(
   array('ID' => 'DESC'),
   array("IBLOCK_ID" => '32','!=PROPERTY_STATUS_VALUE' => 'Предварительный',
      '>=DATE_ACTIVE_FROM' => $pdate,
      '<=DATE_ACTIVE_FROM' => $nowdate      
   )
);
while($ob2 = $db_el2->GetNextElement()){ 
$arFields2 = $ob2->GetFields();

$arProp2 = $ob2->GetProperties();?>
<?$arrrNew[$arFields2["DATE_ACTIVE_FROM"]] = $arProp2["PREDPRICE"];?>

<?}?>
<?foreach($arrrNew as $key2 => $arNew12):?>
<?$arNew22[] = $arNew12["VALUE"];?>

<?endforeach;?>

<div class="col s2" style="position: fixed; top:145px; width: 230px; left: 0; padding: 5px;z-index:1000;">
<div class="card">
<ul class="collapsible" data-collapsible="accordion">
<li><div class="collapsible-header waves-effect waves-teal">
	<i class="fa fa-rub"></i> Показатели</div>

	<div class="collapsible-body" style="padding:10px;line-height:7px;"><p>
За текущий месяц 

		<div class="row" style="margin-bottom:0;">
<div class="col s6">
	<p><label>Принято</label><b><input type="text" value="<?=number_format(array_sum($arNew2),0,'',' ');?>"> </b></p>
	<p><label>Выдано</label><b><input type="text" value="<?=number_format(array_sum($arNew55),0,'',' ');?>"> </b></p>
	</div>
	<div class="col s6"><p><label>Кол-во</label><b><input type="text" value="<?=count($arNew2);?>"></b></p>
   <p><label>Кол-во</label><b><input type="text" value="<?=count($arNew55);?>"></b></p>
   </div></div>
		<span style="font-size:10px;">За прошлый месяц </span>

		<div class="row" style="margin-bottom:0;font-size:10px;">
<div class="col s6">
	<p><label style="font-size:10px;">Сумма</label><b><input type="text" value="<?=number_format(array_sum($arNew28),0,'',' ');?>"> </b></p></div>
	<div class="col s6"><p><label style="font-size:10px;">Кол-во</label><b><input type="text" value="<?=count($arNew28);?>"></b></p></div></div>

   За последнюю неделю: 
		<div class="row" style="margin-bottom:0;">
<div class="col s6">
	<p><label>Сумма</label><b><input type="text" value="<?=number_format(array_sum($arNew21),0,'',' ');?>"> </b></p></div>
	<div class="col s6"><p><label>Кол-во</label><b><input type="text" value="<?=count($arNew21);?>"></b></p></div></div>

   За вчера:	
<div class="row" style="margin-bottom:0;">
	<div class="col s6"><p><label>Сумма</label><b><input type="text" value="<?=number_format(array_sum($arNew22),0,'',' ');?>"> </b></p></div>
	<div class="col s6"><p><label>Кол-во</label><b><input type="text" value="<?=count($arNew22);?>"></b></p></div></div>
<div class="row" style="margin-bottom:0;">
	<div class="col s12"><p><a class="btn" href="/zakazy/calendar.php"><i class="fa fa-calendar"></i></a> <a class="btn" href="/zakazy/oplata.php"><i class="fa fa-money"></i></a></p><a class="btn" href="/zakazy/calendarshin.php"><i class="fa fa-calendar"></i> шнмтж</a></div>
	</div>
	</p></div></li>
<li>
<div class="collapsible-header waves-effect waves-teal">
	<i class="fa fa-clock-o"></i> Сроки</div>

	<div class="collapsible-body" style="padding:10px;">
		Покраска в 1 цвет <span class="right">5 дней</span><br>
		Покраска в 2 цвета <span class="right">10 дней</span><br>
		Комб. полировка <span class="right">15 дней</span><br>
		Полная полировка <span class="right">10 дней</span><br>
		<hr>
		Дополнительно:<br>
		Правка <span class="right">+1 день</span><br>
		Шиномонтаж <span class="right">+1 день</span><br>
		Сборка разборка <span class="right">+2 дня</span><br>
</div>

	</li>
	</ul>
	  </div>
	</div>
