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
CUtil::InitJSCore(array('fx'));
?>

<script src="/bitrix/js/jquery-1.9.1.min.js" type="text/javascript"></script>

  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/bitrix/js/jQuery.print.js"></script>
<link rel="stylesheet" href="/bitrix/js/materialize.css">
<script src="/bitrix/js/materialize.min.js"></script>
<style>
	.collection .collection-item {font-size:11px;}
</style>
<div class="bx-newsdetail">
	<div class="bx-newsdetail-block" id="<?echo $this->GetEditAreaId($arResult['ID'])?>">

	<?if($arParams["DISPLAY_PICTURE"]!="N"):?>
		<?if ($arResult["VIDEO"]):?>
			<div class="bx-newsdetail-youtube embed-responsive embed-responsive-16by9" style="display: block;">
				<iframe src="<?echo $arResult["VIDEO"]?>" frameborder="0" allowfullscreen=""></iframe>
			</div>
		<?elseif ($arResult["SOUND_CLOUD"]):?>
			<div class="bx-newsdetail-audio">
				<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?echo urlencode($arResult["SOUND_CLOUD"])?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
			</div>
		<?elseif ($arResult["SLIDER"] && count($arResult["SLIDER"]) > 1):?>
			<div class="bx-newsdetail-slider">
				<div class="bx-newsdetail-slider-container" style="width: <?echo count($arResult["SLIDER"])*100?>%;left: 0%;">
					<?foreach ($arResult["SLIDER"] as $file):?>
					<div style="width: <?echo 100/count($arResult["SLIDER"])?>%;" class="bx-newsdetail-slider-slide">
						<img src="<?=$file["SRC"]?>" alt="<?=$file["DESCRIPTION"]?>">
					</div>
					<?endforeach?>
					<div style="clear: both;"></div>
				</div>
				<div class="bx-newsdetail-slider-arrow-container-left"><div class="bx-newsdetail-slider-arrow"><i class="fa fa-angle-left" ></i></div></div>
				<div class="bx-newsdetail-slider-arrow-container-right"><div class="bx-newsdetail-slider-arrow"><i class="fa fa-angle-right"></i></div></div>
				<ul class="bx-newsdetail-slider-control">
					<?foreach ($arResult["SLIDER"] as $i => $file):?>
						<li rel="<?=($i+1)?>" <?if (!$i) echo 'class="current"'?>><span></span></li>
					<?endforeach?>
				</ul>
			</div>
		<?elseif ($arResult["SLIDER"]):?>
			<div class="bx-newsdetail-img">
				<img
					src="<?=$arResult["SLIDER"][0]["SRC"]?>"
					width="<?=$arResult["SLIDER"][0]["WIDTH"]?>"
					height="<?=$arResult["SLIDER"][0]["HEIGHT"]?>"
					alt="<?=$arResult["SLIDER"][0]["ALT"]?>"
					title="<?=$arResult["SLIDER"][0]["TITLE"]?>"
					/>
			</div>
		<?elseif (is_array($arResult["DETAIL_PICTURE"])):?>
			<div class="bx-newsdetail-img">
				<img
					src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
					width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
					height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
					title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
					/>
			</div>
		<?endif;?>
	<?endif?>

	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3 class="bx-newsdetail-title"><?=$arResult["NAME"]?></h3>
	<?endif;?>

	<div class="bx-newsdetail-content">
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	</div>

	<?foreach($arResult["FIELDS"] as $code=>$value):?>
		<?if($code == "SHOW_COUNTER"):?>
			<div class="bx-newsdetail-view"><i class="fa fa-eye"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
				<?=intval($value);?>
			</div>
		<?elseif($code == "SHOW_COUNTER_START" && $value):?>
			<?
			$value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($value, CSite::GetDateFormat()));
			?>
			<div class="bx-newsdetail-date"><i class="fa fa-calendar-o"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
				<?=$value;?>
			</div>
		<?elseif($code == "TAGS" && $value):?>
			<div class="bx-newsdetail-tags"><i class="fa fa-tag"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
				<?=$value;?>
			</div>
		<?elseif($code == "CREATED_USER_NAME"):?>
			<div class="bx-newsdetail-author"><i class="fa fa-user"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
				<?=$value;?>
			</div>
		<?elseif ($value != ""):?>
			<div class="bx-newsdetail-other"><i class="fa"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
				<?=$value;?>
			</div>
		<?endif;?>
	<?endforeach;?>
	<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		<?
		if(is_array($arProperty["DISPLAY_VALUE"]))
			$value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
		else
			$value = $arProperty["DISPLAY_VALUE"];
		?>
		<?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT"):?>
			<div class="bx-newsdetail-comments"><i class="fa fa-comments"></i> <?=$arProperty["NAME"]?>:
				<?=$value;?>
			</div>
		<?elseif ($value != ""):?>
			<div class="bx-newsdetail-other"><i class="fa"></i> <?=$arProperty["NAME"]?>:
				<?=$value;?>
			</div>
		<?endif;?>
	<?endforeach;?>
<?
if ($arResult["isAccessFormResultEdit"] == "Y" && strlen($arParams["EDIT_URL"]) > 0) 
{
	$href = $arParams["SEF_MODE"] == "Y" ? str_replace("#RESULT_ID#", $arParams["RESULT_ID"], $arParams["EDIT_URL"]) : $arParams["EDIT_URL"].(strpos($arParams["EDIT_URL"], "?") === false ? "?" : "&")."RESULT_ID=".$arParams["RESULT_ID"]."&WEB_FORM_ID=".$arParams["WEB_FORM_ID"];
?>

<p>
[ <a href="<?=$href?>"><?=GetMessage("FORM_EDIT")?></a> ]
</p>
<?
}
?>


<?
if ($arParams["SHOW_STATUS"] == "Y")
{
?>
<p>
<b><?=GetMessage("FORM_CURRENT_STATUS")?></b> [<span class='<?=$arResult["RESULT_STATUS_CSS"]?>'><?=$arResult["RESULT_STATUS_TITLE"]?></span>]
</p>
<?
}
?>
<div class="row" style="line-height:14px;">

<div class="col s9 ele1">

<div class="col s12">
<div style="text-align: center;">
  <p style="font-size:24px;">Бланк заказа (счет форма)</p>
</div>
	</div>
	<div class="col s4" style="width:33%; float:left;"><img src="http://thomifelgen.ru/bitrix/templates/thomifelgen/img/logo.png" width="183" height="70"></div>
	<div class="col s4" style="width:33%; float:left;"><div class="card-content"><div style="border-top:1px solid;">
		<h5 class="box-title">+7 (495) 979-20-01</h5></div>
<div class="box-body">
	<label>Телефон</label>
		</div>
</div></div>
  <div class="col s4" style="width:33%; float:left;">
<div class="card-content"><div style="border-top:1px solid;">
	<h5 class="box-title">Заявка № <?=$arResult["NAME"]?><?if($arResult["PROPERTIES"]["STATUS"]["VALUE"] == "Плюс минус"):?> <span style="color:#a4a4a4">&plusmn;</span><?endif;?></h5></div>

<div class="box-body">

<label>
	Дата: <?=$arResult["ACTIVE_FROM"]?></label>

   </div>
	  </div>
	</div>
 <div style="clear:both;"></div>
	<div class="col s7" style="width:58%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Контактная информация</h5></div>

<div class="box-body">
<ul class="collection">
<?if(!empty($arResult["PROPERTIES"]["PARTNER"]["VALUE"])):?>
	<li class="collection-item">Партнер:

		<span class="right" ><?=$arResult["PROPERTIES"]["PARTNER"]["VALUE"]?></span>
	</li>
 <?endif;?>
	<li class="collection-item">Ф.И.О.: <span class="right" ><?=$arResult["PROPERTIES"]["FIO"]["VALUE"]?></span>
	</li>
	<li class="collection-item">Телефон: <span class="right" ><?=$arResult["PROPERTIES"]["TELEPHONE"]["VALUE"]?></span></li>
	<li class="collection-item">Email: <span class="right" ><?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?></span></li>
	<?if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
	<li class="collection-item">№ дисконтной карты <span class="right" ><?=$arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]?></span></li><?endif;?>
	<li class="collection-item">Дополнительная информация <span class="right" ><?=$arResult["PROPERTIES"]["PRIM"]["VALUE"]?></span><br>
<?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_320_2NxRM"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?><?else:?>
		<span style="color:red;">МАСКИРОВКА: <?=$arResult["RESULT"]["SIMPLE_QUESTION_4111"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?> </span>
<?endif;?>
</li>
	</ul>
</div>
	</div>
</div>
	<div class="col s5" style="width:42%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Конфигурация</h5></div>

<div class="box-body">
<ul class="collection">
	<li class="collection-item">ТС: <span class="right" ><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?> <?=$arResult["PROPERTIES"]["MARKA"]["VALUE"]?></span>
	</li>
	<li class="collection-item">Кол-во дисков/деталей: <span class="right" ><?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?></span></li>
<?if($arResult["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?>
<?else:?>
	<li class="collection-item">Марка дисков: <span class="right" ><?=$arResult["PROPERTIES"]["MARKAD"]["VALUE"]?> <?=$arResult["PROPERTIES"]["DIAMETR"]["VALUE"]?> <?=$arResult["PROPERTIES"]["CHDISK"]["VALUE"]?></span></li><?endif;?>

<?if($arResult["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?><?else:?>
	<?if(!empty($arResult["PROPERTIES"]["MAT"]["VALUE"])):?><li class="collection-item">Материал дисков: <span class="right" ><?=$arResult["PROPERTIES"]["MAT"]["VALUE"]?></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["KOLP"]["VALUE"])):?><li class="collection-item">Колпачки: <span class="right" ><?=$arResult["PROPERTIES"]["KOLP"]["VALUE"]?> (кол-во: <?=$arResult["PROPERTIES"]["KOLPKOL"]["VALUE"]?>)</span></li><?endif;?>

	<?if(!empty($arResult["PROPERTIES"]["NIPP"]["VALUE"])):?><li class="collection-item">Ниппель: <span class="right" ><?=$arResult["PROPERTIES"]["NIPP"]["VALUE"]?> <?if($arResult["PROPERTIES"]["NIPP"]["VALUE"] == "Нет"):?>(кол-во: <?=$arResult["PROPERTIES"]["NIPKOL"]["VALUE"]?>)<?endif;?></span></li><?endif;?><?endif;?>
	</ul>
</div>
	</div>
</div>
<div style="clear:both;"></div>
	<hr style="margin:2px 0 !important">
    <?if(!empty($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]) or !empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>
	<div class="col s3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
	<div class="box-header with-border">
	<h5>Покраска</h5></div>

<div class="box-body">
<ul class="collection">
<?foreach($arResult["PROPERTIES"]["POKR"]["VALUE"]as $key => $arAnswer):?>
<?if (strlen($arAnswer)>0):?>
<li class="collection-item"><?=$arAnswer?></li>
<?endif;?> 
<?endforeach;?> 
	<li class="collection-item"><span>Ц1:<span class="right" ><?=$arResult["PROPERTIES"]["COLOR"]["VALUE"]?></span></span>
	</li>
<?if(!empty($arResult["PROPERTIES"]["COLOR2"]["VALUE"])):?><li class="collection-item"><span>Ц2:<span class="right" ><?=$arResult["PROPERTIES"]["COLOR2"]["VALUE"]?></span></span><?endif;?>
	<li class="collection-item">Лак: <span class="right" >

<?=$arResult["PROPERTIES"]["LAKPOK"]["VALUE"]?><?if(!empty($arResult["PROPERTIES"]["CLAKP"]["VALUE"])):?> <?=$arResult["PROPERTIES"]["CLAKP"]["VALUE"]?><?endif;?></span></li>
<?if(empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?><?else:?>
	<li class="collection-item">Маскировка <span class="right" >+ <?=$arResult["PROPERTIES"]["MASK"]["VALUE"]?></span></li>
    
<?endif;?>
	<li class="collection-item">Стоимость: </li>

	<li class="collection-item"><div class="external-event bg-light-blue"><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>(<?endif;?><?=number_format($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>+<?endif;?><?=number_format($arResult["PROPERTIES"]["MASK"]["VALUE"],0,""," ")?><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?> <i class="fa fa-rub"></i><?endif;?><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>)<?endif;?> х <?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?> = <?=number_format(($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["MASK"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></div>
	</li></ul></div>
	</div>
</div>
<?endif;?>


<?if(empty($arResult["PROPERTIES"]["PRICEPOL"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Полировка</h5></div>

<div class="box-body">
<ul class="collection">
<?foreach($arResult["PROPERTIES"]["POLIR"]["VALUE"] as $key => $arAnswer):?> 
<?if (strlen($arAnswer)>0):?>
<li class="collection-item"><?=$arAnswer?></li>
<?endif;?> 
<?endforeach;?> 
	<li class="collection-item">Лак: <span class="right" >

<?=$arResult["PROPERTIES"]["LAKPOL"]["VALUE"]?> <?if(!empty($arResult["PROPERTIES"]["CLAKPL"]["VALUE"])):?> <?=$arResult["PROPERTIES"]["CLAKPL"]["VALUE"]?><?endif;?></span>

	</li>

	<li class="collection-item">Стоимость: </li>

	<li class="collection-item"><div class="external-event bg-light-blue"><?=number_format($arResult["PROPERTIES"]["PRICEPOL"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i> х <?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?> = <?=number_format(($arResult["PROPERTIES"]["PRICEPOL"]["VALUE"]*$arResult["PROPERTIES"]["KOL"]["VALUE"]),0,""," ")?> <i class="fa fa-rub"></i></div>
	</li></ul></div>
	</div>
</div>
<?endif;?>



	<?if(in_array('возможно',$arResult["PROPERTIES"]["REM"]["VALUE"]) or in_array('клиент отказался',$arResult["PROPERTIES"]["REM"]["VALUE"]) or !empty($arResult["PROPERTIES"]["STREM"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SVAR"]["VALUE"])):?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Ремонт</h5></div>

<div class="box-body">
<ul class="collection">

<?foreach($arResult["PROPERTIES"]["REM"]["VALUE"] as $key => $arAnswer):?> 
<?if (strlen($arAnswer)>0):?>
<li class="collection-item"><?=$arAnswer?></li>
<?endif;?>
<?endforeach;?> 
	<li class="collection-item"><?=$arResult["PROPERTIES"]["REMKOL"]["VALUE"]?>x<?=$arResult["PROPERTIES"]["STREM"]["VALUE"]?></li>

<?if(!empty($arResult["PROPERTIES"]["SVAR"]["VALUE"])):?>
<li class="collection-item">Сварка <span class="right" ><?=$arResult["PROPERTIES"]["SVARKOL"]["VALUE"]?>x<?=$arResult["PROPERTIES"]["SVAR"]["VALUE"]?></span></li>
<?endif;?>
	<li class="collection-item">Стоимость: <span class="right" ></span></li>


	<li class="collection-item"><div class="external-event bg-light-blue"><?=number_format(($arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]+$arResult["PROPERTIES"]["SVAR"]["VALUE"]*$arResult["PROPERTIES"]["SVARKOL"]["VALUE"]),0,""," ")?> <i class="fa fa-rub"></i></div>
	</li></ul></div>
	</div>
</div>
<?endif;?>

<?if(empty($arResult["PROPERTIES"]["PRICESHIN"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Шиномонтаж</h5></div>

<div class="box-body">
<ul class="collection">
<?$bf=0;?>
<?foreach($arResult["PROPERTIES"]["SHINO"]["VALUE"]as $key => $arAnswer):?>
				<?if (strlen($arAnswer) > 0 && $arAnswer != "время записи"):?>
	<li class="collection-item"><?=$arAnswer?> х <?if(!empty($arResult["PROPERTIES"]["SHINKOL"]["VALUE"])):?><?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]?><?else:?><?if($arAnswer == "съем"):?><?=$arResult["PROPERTIES"]["KOLSHR0"]["VALUE"]?><?endif;?><?if($arAnswer == "демонтаж"):?><?=$arResult["PROPERTIES"]["KOLSHR1"]["VALUE"]?><?endif;?><?if($arAnswer == "мойка"):?><?=$arResult["PROPERTIES"]["KOLSHR2"]["VALUE"]?><?endif;?><?if($arAnswer == "монтаж"):?><?=$arResult["PROPERTIES"]["KOLSHR3"]["VALUE"]?><?endif;?><?if($arAnswer == "балансировка"):?><?=$arResult["PROPERTIES"]["KOLSHR4"]["VALUE"]?><?endif;?><?if($arAnswer == "установка"):?><?=$arResult["PROPERTIES"]["KOLSHR5"]["VALUE"]?><?endif;?><?endif;?></li>
<?endif;?> 

<?endforeach;?>
	<?if(!empty($arResult["PROPERTIES"]["SHINKOL"]["VALUE"])):?><li class="collection-item">Количество: <span class="right" ><?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]?></span></li><?endif;?>
    <?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_879"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
	<?else:?>
	<li class="collection-item">Стоимость: <span class="right" ></span></li>
	<?endif;?>

	<li class="collection-item"><div class="external-event bg-light-blue"><?if(!empty($arResult["PROPERTIES"]["SHINKOL"]["VALUE"])):?><?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]?> х <?endif;?><?=number_format($arResult["PROPERTIES"]["PRICESHIN"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i><?if(!empty($arResult["PROPERTIES"]["SHINKOL"]["VALUE"])):?> = <?=number_format(($arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]),0,""," ")?> <i class="fa fa-rub"></i><?endif;?></div>
	</li></ul></div>
	</div>
</div>
<?endif;?>
	<?foreach($arResult["PROPERTIES"]["DOSTAV"]["VALUE"] as $dos_key => $arDos[]):?>

<?endforeach;?>

<div style="clear:both;"></div>
	<hr style="margin:2px 0 !important">
<?if(!empty($arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]) or !empty($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SBRZB"]["VALUE"]) or !empty($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]) or !empty($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"]) or in_array("Партнерская", $arDos)):?>
<div class="">
<div class="box box-primary box-solid">
<div class="box-header with-border">

<?$sumpr = $arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]+$arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]+$arResult["PROPERTIES"]["SBRZB"]["VALUE"]+$arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]+$arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"];?>
	<h6>Дополнительные услуги: на сумму <?=$sumpr?></h6></div>
	<?if(!empty($sumpr)  or in_array("Партнерская", $arDos)):?>
<div class="box-body">

<div class="col s3" style="position:relative;width:33.33333%;float:left;">


<ul class="collection">
	<?if(!empty($arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]) or in_array("Партнерская",$arDos)):?><li class="collection-item">Доставка <?if(in_array("Партнерская",$arDos)):?>(партнерская)<?endif;?><span class="right" style="background:#fff;color:#000;font-weight:300;"><?=number_format($arResult["PROPERTIES"]["PRICEDOST"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"])):?><li class="collection-item">Реставрация болтов <span class="right" style="background:#fff;color:#000;font-weight:300;"><?=number_format($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["SBRZB"]["VALUE"])):?><li class="collection-item">Сборка/разборка дисков <span class="right" style="background:#fff;color:#000;font-weight:300;"><?=number_format($arResult["PROPERTIES"]["SBRZB"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PRUSLP"]["VALUE"])):?><li class="collection-item"><?=$arResult["PROPERTIES"]["PRUSLN"]["VALUE"];?><span class="right" style="background:#fff;color:#000;font-weight:300;"><?if($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["0"]>$arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]):?><?=number_format(($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]*100/(100-$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])),0,""," ")?><?else:?><?=number_format($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"],0,""," ")?><?endif;?> <i class="fa fa-rub"></i></span></li><?endif;?>
	</ul>
	</div>

<?if(!empty($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"])):?>
<div class="col s3" style="position:relative;width:33.33333%;float:left;">
<ul class="collection">
<li class="collection-item"><b>Изготовление колпачков</b></li>
<?foreach($arResult["PROPERTIES"]["M_KOLP"]["VALUE"] as $key => $arAnswer):?> 
<?if (strlen($arAnswer)>0):?>
<li class="collection-item"><?=$arAnswer?></li>
<?endif;?>
<?endforeach;?>
	<li class="collection-item">Стоимость:</li>
	<li  class="collection-item"> <div class="external-event bg-light-blue" style="font-size:12px;"><?=number_format($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"]/$arResult["PROPERTIES"]["KOL_KOLP"]["VALUE"], 0, ""," ")?> <i class="fa fa-rub"></i> х <?=$arResult["PROPERTIES"]["KOL_KOLP"]["VALUE"];?> = <?=number_format($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></div></li>
	</ul>
	</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]) and !empty($sumpr)):?>
<div class="col s3" style="position:relative;width:33.33333%;float:left;">
<ul class="collection">
<li class="collection-item"><b>Скидка на дополнительные услуги</b></li>
	<?if($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["0"]>$arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]):?><?$prusp = $arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["0"];?><?$prusdisc = $arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]*100/(100-$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])-$arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"];?><?else:?><?$prusp = 0;?><?$prusdisc = $arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"];?><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"])):?><li class="collection-item">Реставрация болтов (-<?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"];?>%): <span class="right"><?=number_format(($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]*$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["SBRZB"]["VALUE"])):?><li class="collection-item">Сборка/разборка (-<?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"];?>%): <span class="right"><?=number_format(($arResult["PROPERTIES"]["SBRZB"]["VALUE"]*$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if(!empty($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"])):?><li class="collection-item">Изгот. колпачков (-<?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"];?>%): <span class="right"><?=number_format(($arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"]*$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?>
	<?if($arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["0"]>$arResult["PROPERTIES"]["PRUSLP"]["VALUE"]["1"]):?><?if(!empty($arResult["PROPERTIES"]["PRUSLP"]["VALUE"])):?><li class="collection-item"><?=$arResult["PROPERTIES"]["PRUSLN"]["VALUE"];?> (-<?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"];?>%)<span class="right" style="background:#fff;color:#000;font-weight:300;"><?=number_format($prusdisc,0,""," ")?> <i class="fa fa-rub"></i></span></li><?endif;?><?endif;?>
	<li  class="collection-item">Итого скидка: <span class="right"><?$prusalld = (($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]+$arResult["PROPERTIES"]["SBRZB"]["VALUE"]+$arResult["PROPERTIES"]["PRICE_KOLP"]["VALUE"]+$prusp)*$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100)?><?=number_format($prusalld, 0, ""," ");?> <i class="fa fa-rub"></i></span></li>
	</ul>
	</div>
<?endif;?>
	</div>
<?endif;?>
	</div>
</div>

<?endif;?>
<div style="clear:both;"></div>
<hr style="margin:2px 0 !important">
	<div class="col s4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h5>Калькуляция:</h5></div>
<div class="box-body">
<ul class="collection">
	<li class="collection-item">Подитог: <span class="right" ><?=number_format($arResult["PROPERTIES"]["ITOGO"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></span></li>
<?if(!empty($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])):?>
	<li class="collection-item">Сумма скидок: <span class="right" ><?=number_format((($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"]+$arResult["PROPERTIES"]["MASK"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100)+$arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]/100)+$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]*$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*$arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]/100+$prusalld),0,""," ")?> <i class="fa fa-rub"></i></span></li>
<?endif;?>
	<li class="collection-item">Пред. стоимость: <span class="right" ><?=number_format($arResult["PROPERTIES"]["PREDPRICE"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i></span></li>
	<li class="collection-item">Предоплата: <span class="right" ><?if(!empty($arResult["PROPERTIES"]["PREDO"]["VALUE"])):?><?=number_format($arResult["PROPERTIES"]["PREDO"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i><?endif;?>  
      <?if(empty($arResult["PROPERTIES"]["PREDO"]["VALUE"])):?>Нет<?else:?>
		<?if($arResult["PROPERTIES"]["OPCAR"]["VALUE"]["0"] == "Да"  or $arResult["PROPERTIES"]["OPCAR"]["VALUE"]["0"] == "Карта А" or $arResult["PROPERTIES"]["OPCAR"]["VALUE"]["0"] == "Карта С"):?>Карта<?else:?><?if($arResult["PROPERTIES"]["OPCAR"]["VALUE"]["0"] == "Счет Ю/Л"):?>Счет Ю/Л<?else:?>Нал<?endif;?>
      <?endif;?><?endif;?></span></li>
	<li class="collection-item">Доплата: <span class="right" ><?if(!empty($arResult["PROPERTIES"]["DOPL"]["VALUE"])):?><?=number_format($arResult["PROPERTIES"]["DOPL"]["VALUE"],0,""," ")?> <i class="fa fa-rub"></i><?endif;?>
      <?if(empty($arResult["PROPERTIES"]["DOPL"]["VALUE"])):?>Нет<?else:?>
      <?if($arResult["PROPERTIES"]["DOPCAR"]["VALUE"]["0"] == "Да" or $arResult["PROPERTIES"]["DOPCAR"]["VALUE"]["0"] == "Карта А" or $arResult["PROPERTIES"]["DOPCAR"]["VALUE"]["0"] == "Карта С"):?>Карта<?else:?><?if($arResult["PROPERTIES"]["DOPCAR"]["VALUE"]["0"] == "Счет Ю/Л"):?>Счет Ю/Л<?else:?>Нал<?endif;?>
      <?endif;?><?endif;?></span></li>
	<li class="collection-item">Осталось оплатить: <span class="right" ><?=number_format(($arResult["PROPERTIES"]["PREDPRICE"]["VALUE"] - $arResult["PROPERTIES"]["PREDO"]["VALUE"] - $arResult["PROPERTIES"]["DOPL"]["VALUE"]),0,""," ")?> <i class="fa fa-rub"></i></span></li>
	</ul>
</div>
	</div>
</div>
<div class="col-md-8" style="width:66%;float:left;">
<div class="row">
<?if(!empty($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<ul class="collection">
	<li class="collection-item">Скидка на основные услуги:</li>


	<li class="collection-item"><?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]?>% - <?=number_format((($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"]+$arResult["PROPERTIES"]["MASK"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"]*$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i></li>
	</ul>

	</div>
</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SKIDREM"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<ul class="collection">
	<li class="collection-item">Скидка на ремонт:</li>


	<li class="collection-item"><?=$arResult["PROPERTIES"]["SKIDREM"]["VALUE"]?>% - <?=number_format(($arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]+$arResult["PROPERTIES"]["SVAR"]["VALUE"]*$arResult["PROPERTIES"]["SVARKOL"]["VALUE"])*($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i></li>
	</ul>

	</div>
</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<ul class="collection">
<li class="collection-item">Скидка на шиномонтаж:</li>


	<li class="collection-item"><?if(!empty($arResult["PROPERTIES"]["SHINKOL"]["VALUE"])):?><?=$arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]?>% - <?=number_format($arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]*$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]/100),0,""," ")?> <i class="fa fa-rub"></i><?else:?><?=$arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]?>% - <?=$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]*($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]/100)?><?endif;?></li>
	</ul>

	</div>
</div>
<?endif;?>
	<div style="clear:both;"></div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<ul class="collection">
<li class="collection-item">Ориентировочная дата выдачи:</li>


	<li class="collection-item"><?=$arResult["DATE_ACTIVE_TO"]?></li>
	</ul>

	</div>
</div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<ul class="collection">
<li class="collection-item">Подпись заказчика:</li>

	<li class="collection-item">_____________</li>
	</ul>
</div>

</div>
	<div class="col-md-4" style="width:33%;float:left;">

<div class="box box-primary box-solid">
<ul class="collection">
<li class="collection-item">Подпись принимающего:</li>

	<li class="collection-item">_____________<span class="right" >МП</span></li>
	</ul>
</div>

</div>

			</div>
		  </div>
 <div style="clear:both;"></div>
	<div class="col-md-12">
<div class="box box-primary box-solid">
<div class="box-body">
<ul class="collection">
<li class="collection-item">Претензий к качеству выполненных работ и внешнему виду дисков (цвет, блеск и т.п.) не имею<span class="right" >_____________________</span></li>
	</ul>
</div>
	</div>
</div>
 <div style="clear:both;"></div>

	<div class="col-md-12">
<div class="box box-primary box-solid">
<div class="box-body">
<ul class="collection">
	<li class="collection-item" style="font-size:10px;line-height:12px;">Итоговая стоимость услуг определяется после снятия старого лакокрасочного покрытия. Возможные дополнительные работы (аргоновая сварка, правка, восстановление геометриидиска и проч.) выполняются строго после согласования с заказчиком. Из-за проведения дополн. работ срок исполнения заказа может измениться. При окраске дисков с сильной степенью коррозии возможно образование неровностей и кратеров на поверхности, что не является дефектом покраски. Дефекты, неразличимые при дневном освещении на растоянии 1 метр не являются поводом для претензий. На отслоение порошкового покрытия колесных дисков предоставляется гарантия 3 года. На полированные диски, покрытые лаком, срок гарантии 1 год. Через 30 календарных дней после уведомления заказчика о готовности заказа (телефонный звонок, sms, email), за каждый последующий день заказчик оплачивает услуги по хранению из расчета 100 (сто) рублей за каждый день хранения.</li>
	</ul>
	<?if(empty($sumpr) and !in_array("Партнерская", $arDos)):?>
<img src="/upload/medialibrary/d2f/nezabud.jpg" style="width:100%;"><?endif;?>
</div>
	</div>
</div>

</div>

<br><br>

<div style="position: fixed;right: 50px;top: 300px;">
	<p><a class="btn indigo darken-1" onclick="jQuery.print('.ele1')"><i class="fa fa-print"></i> Распечатать</a></p><p><a class="btn btn-warning" href="/zakazy/zakaz.php?edit=Y&CODE=<?=$arResult["ID"];?>"><i class="fa fa-edit"></i> Изменить</a></p><p><a class="btn orange" href="/zakazy/"><i class="fa fa-arrow-circle-left"></i> Вернуться к заказам</a></p></div>


	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="bx-newsdetail-date"><i class="fa fa-calendar-o"></i> <?echo $arResult["DISPLAY_ACTIVE_FROM"]?></div>
	<?endif?>
	<?if($arParams["USE_RATING"]=="Y"):?>
		<div class="bx-newsdetail-separator">|</div>
		<div class="bx-newsdetail-rating">
			<?$APPLICATION->IncludeComponent(
				"bitrix:iblock.vote",
				"flat",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"ELEMENT_ID" => $arResult["ID"],
					"MAX_VOTE" => $arParams["MAX_VOTE"],
					"VOTE_NAMES" => $arParams["VOTE_NAMES"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
					"SHOW_RATING" => "Y",
				),
				$component
			);?>
		</div>
	<?endif?>

	<div class="row">
		<div class="col-xs-5">
		</div>
	<?
	if ($arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="col-xs-7 text-right">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", $arParams["SHARE_TEMPLATE"], array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
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
<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'bx-newsdetail-slider-container',
			leftArrowClassName: 'bx-newsdetail-slider-arrow-container-left',
			rightArrowClassName: 'bx-newsdetail-slider-arrow-container-right',
			controlContainerClassName: 'bx-newsdetail-slider-control'
		});
	});
</script>
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
