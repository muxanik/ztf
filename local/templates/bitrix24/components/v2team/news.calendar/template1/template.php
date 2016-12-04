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
?><link rel="stylesheet" href="/bitrix/js/fullcalendar.min.css">
<script src="/bitrix/js/jQuery.print.js"></script>
<div class="news-calendar" id="nachalo">
	<?if($arParams["SHOW_CURRENT_DATE"]):?>
		<p align="right" class="NewsCalMonthNav"><b><?=$arResult["TITLE"]?></b></p>
	<?endif?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="NewsCalMonthNav" align="left">
				<?if($arResult["PREV_MONTH_URL"]):?>
					<a href="<?=$arResult["PREV_MONTH_URL"]?>" title="<?=$arResult["PREV_MONTH_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_PR_M")?></a>
				<?endif?>
				<?if($arResult["PREV_MONTH_URL"] && $arResult["NEXT_MONTH_URL"] && !$arParams["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
				<?endif?>
				<?if($arResult["SHOW_MONTH_LIST"]):?>
					&nbsp;&nbsp;
					<select onChange="b_result()" name="MONTH_SELECT" id="month_sel">
						<?foreach($arResult["SHOW_MONTH_LIST"] as $month => $arOption):?>
							<option value="<?=$arOption["VALUE"]?>" <?if($arResult["currentMonth"] == $month) echo "selected";?>><?=$arOption["DISPLAY"]?></option>
						<?endforeach?>
					</select>
					&nbsp;&nbsp;
					<script language="JavaScript" type="text/javascript">
					<!--
					function b_result()
					{
						var idx=document.getElementById("month_sel").selectedIndex;
						<?if($arParams["AJAX_ID"]):?>
							BX.ajax.insertToNode(document.getElementById("month_sel").options[idx].value, 'comp_<?echo CUtil::JSEscape($arParams['AJAX_ID'])?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
						<?else:?>
							window.document.location.href=document.getElementById("month_sel").options[idx].value;
						<?endif?>
					}
					-->
					</script>
				<?endif?>
				<?if($arResult["NEXT_MONTH_URL"]):?>
					<a href="<?=$arResult["NEXT_MONTH_URL"]?>" title="<?=$arResult["NEXT_MONTH_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_N_M")?></a>
				<?endif?>
			</td>
			<?if($arParams["SHOW_YEAR"]):?>
			<td class="NewsCalMonthNav" align="right">
				<?if($arResult["PREV_YEAR_URL"]):?>
					<a href="<?=$arResult["PREV_YEAR_URL"]?>" title="<?=$arResult["PREV_YEAR_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_PR_Y")?></a>
				<?endif?>
				<?if($arResult["PREV_YEAR_URL"] && $arResult["NEXT_YEAR_URL"]):?>
					&nbsp;&nbsp;|&nbsp;&nbsp;
				<?endif?>
				<?if($arResult["NEXT_YEAR_URL"]):?>
					<a href="<?=$arResult["NEXT_YEAR_URL"]?>" title="<?=$arResult["NEXT_YEAR_URL_TITLE"]?>"><?=GetMessage("IBL_NEWS_CAL_N_Y")?></a>
				<?endif?>
			</td>
			<?endif?>
		</tr>
	</table>
	<br />
	<div class="ele1" style="font-size:7px;">
<style>
	.NewsCalNews {
		font-size:7px;
}
</style>
<div class="fc">
		<table>
<thead>
	<tr>
<?$q=0;?>
<?$q1=0;?>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<th class='fc-day-header fc-widget-header fc-mon'><?=$WDay["FULL"]?></th>
	<?endforeach?>
	</tr>
			</thead>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<tr style="border:1px solid #B3B3B3;">
		<?foreach($arWeek as $arDay):?>
		<td style="border:1px solid #B3B3B3;position:relative;padding-bottom: 18px;" align="left" valign="top" class='<?=$arDay["td_class"]?>' width="14%">
			<span style="padding-bottom:20px;" class="<?=$arDay["day_class"]?>"><?=$arDay["day"]?></span> <div style="position:absolute;top:0;right:0"><span id="vremya<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>" style="font-size:10px;">выберите время</span><br><a id="<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>" style="background: #3c9dbf;color: #fff;padding: 2px;border-radius: 50%;" href="/zakazy/zakaz.php?time=11-00&date=<?=date("d.m.Y", strtotime(implode("-", array($arDay["day"], $arResult["currentMonth"], $arResult["currentYear"]))))?>">11</a> <a id="<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>13" style="background: #3c9dbf;color: #fff;padding: 2px;border-radius: 50%;" href="/zakazy/zakaz.php?time=13-00&date=<?=date("d.m.Y", strtotime(implode("-", array($arDay["day"], $arResult["currentMonth"], $arResult["currentYear"]))))?>">13</a> <a id="<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>16" style="background: #3c9dbf;color: #fff;padding: 2px;border-radius: 50%;" href="/zakazy/zakaz.php?time=16-00&date=<?=date("d.m.Y", strtotime(implode("-", array($arDay["day"], $arResult["currentMonth"], $arResult["currentYear"]))))?>">16</a> <a id="<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>18" style="background: #3c9dbf;color: #fff;padding: 2px;border-radius: 50%;" href="/zakazy/zakaz.php?time=18-00&date=<?=date("d.m.Y", strtotime(implode("-", array($arDay["day"], $arResult["currentMonth"], $arResult["currentYear"]))))?>">18</a></div>

			<?foreach($arDay["events"] as $arEvent):?>

			<div class="NewsCalNews fc-day-grid-event fc-h-event fc-event1 fc-start fc-end <?if($arEvent["status"]=="Выдан" or empty($arEvent["vrzap"])):?>vydan<?endif;?> <?if($arEvent["status"]=="Предварительный"):?><?endif;?>" style="<?if($arEvent["status"]=="Выдан"):?>background:yellow !important;<?endif;?><?if($arEvent["status"]=="Готов"):?>background:green !important;<?endif;?>border:1px solid;padding:5px;<?if(preg_match('/ерный/', $arEvent["color"]) == true):?>background:#000000;<?endif;?><?if(preg_match('/емно/', $arEvent["color"]) == true):?>background:#888585;<?endif;?><?if(preg_match('/аводской/', $arEvent["color"]) == true):?>background:#cccccc;<?endif;?>"><?=$arEvent["time"]?><a  style="text-decoration:none;<?if(preg_match('/ерный/', $arEvent["color"]) == true or preg_match('/емно/', $arEvent["color"]) == true):?>color:#fff;<?else:?>color:#000;<?endif;?><?if($arEvent["status"]=="Выдан"):?>color:#000 !important;<?endif;?>" href="<?=$arEvent["url"]?>" title="<?=$arEvent["preview"]?>"><b><?=$arEvent["title"]?></b> <?=$arEvent["fio"]?><br><?=$arEvent["telephone"]?><br>ШНМ на <span id="vr-<?=$arEvent["title"]?>"><?=$arEvent["vrzap"]?></span></a></div>
<?if(!empty($arEvent["vrzap"])):?>
<script>
if ($('#vr-<?=$arEvent["title"]?>').text() == "11-00") {
    $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>').hide();
}
if ($('#vr-<?=$arEvent["title"]?>').text() == "13-00") {
    $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>13').hide();
}
if ($('#vr-<?=$arEvent["title"]?>').text() == "16-00") {
    $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>16').hide();
}
if ($('#vr-<?=$arEvent["title"]?>').text() == "18-00") {
    $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>18').hide();
}

			</script>
<?endif;?>
			<?endforeach?>
<script>

if ($('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>').css('display') == 'none' && $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>13').css('display') == 'none' && $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>16').css('display') == 'none' && $('#<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>18').css('display') == 'none') {
	$('#vremya<?=$arDay["day"]?>-<?=$arResult["currentMonth"]?>').html('<b style="color:red">Мест нет</b>');
};
			</script>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>
</div>
</div>

<a class="btn indigo darken-1" onclick="jQuery('.ele1').print({globalStyles: false})"><i class="fa fa-print"></i> Распечатать</a> <a href="/zakazy/" class="btn indigo darken-1">Вернуться к заказам</a>


<script>
$('.trigger').click(function() {
   $('.NewsCalNews').toggleClass('vydan', 2000, "easeOutBounce" );
});
</script>
<script>
$('.trigger1').click(function() {
   $('.NewsCalNews').toggleClass('vse', 2000, "easeOutBounce" );
});
</script>