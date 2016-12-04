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
	<div class="ele1">

<div class="fc">
		<table class="highlight">
<thead>
	<tr>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<th class='fc-day-header fc-widget-header fc-mon'><?=$WDay["FULL"]?></th>
	<?endforeach?>
	</tr>
			</thead>
	<?foreach($arResult["MONTH"] as $arWeek):?>
	<tr>
		<?foreach($arWeek as $arDay):?>
		<td align="left" valign="top" class='<?=$arDay["td_class"]?>' width="14%">
			<span class="center-align btn-floating waves-effect waves-light red <?=$arDay["day_class"]?>"><?=$arDay["day"]?></span>
			<?foreach($arDay["events"] as $arEvent):?>

			<?if(!empty($arEvent["prpol"]) && $arEvent["status"] == "Принят"):?><?=count($arEvent);?><?endif;?>
			<div class="card hoverable <?if(empty($arEvent["prpok"]) and empty($arEvent["prpol"])):?>other<?endif;?> <?if(!empty($arEvent["prpok"]) and empty($arEvent["prpol"])):?>pokr<?endif;?> <?if(!empty($arEvent["prpol"])):?>polir<?endif;?> NewsCalNews fc-day-grid-event fc-h-event fc-event1 fc-start fc-end <?if($arEvent["status"]=="Выдан"):?>vydan<?endif;?> <?if($arEvent["status"]=="Предварительный"):?>otmena<?endif;?>" style="<?if($arEvent["status"]=="Выдан"):?>background:yellow !important;<?endif;?><?if($arEvent["status"]=="Готов"):?>background:green !important;<?endif;?>padding:3px;<?if(preg_match('/ерный/', $arEvent["color"]) == true):?>background:#000000;<?endif;?><?if(preg_match('/емно/', $arEvent["color"]) == true):?>background:#888585;<?endif;?><?if(preg_match('/аводской/', $arEvent["color"]) == true):?>background:#cccccc;<?endif;?>"><?=$arEvent["time"]?>
				<a style="text-decoration:none;<?if(preg_match('/ерный/', $arEvent["color"]) == true or preg_match('/емно/', $arEvent["color"]) == true):?>color:#fff;<?else:?>color:#000;<?endif;?><?if($arEvent["status"]=="Выдан"):?>color:#000 !important;<?endif;?>" href="<?=$arEvent["url"]?>" title="<?=$arEvent["preview"]?>"><b><?=$arEvent["title"]?></b> <?if(!empty($arEvent["prpok"])):?>ПК<?if(!empty($arEvent["color"])):?>, <?=$arEvent["color"]?><?endif;?><?if(!empty($arEvent["color2"])):?>, <?=$arEvent["color2"]?><?endif;?><?if(!empty($arEvent["lakpok"])):?>, <?=$arEvent["lakpok"]?><?endif;?><?if(!empty($arEvent["clakp"])):?>, <?=$arEvent["clakp"]?><?endif;?><?endif;?><?if(!empty($arEvent["prpol"]) and !empty($arEvent["prpok"])):?>+<?endif;?><?if(!empty($arEvent["prpol"])):?>ПЛ<?if(!empty($arEvent["lakpol"])):?>, <?=$arEvent["lakpol"]?><?endif;?><?if(!empty($arEvent["clakpl"])):?>, <?=$arEvent["clakpl"]?><?endif;?><?endif;?><?if($arEvent["status"]=="Готов"):?>- ГОТОВ<?endif;?><?if($arEvent["status"]=="Выдан"):?>- ВЫДАН<?endif;?><?if($arEvent["status"]=="Предварительный"):?>- ПРЕДВ<?endif;?><?if(!empty($arEvent["shino"])):?>, <?if($arEvent["shino"]>0):?>ШНМ<?endif;?><?endif;?> <b>кол-во:<?=$arEvent["kold"]?></b></a></div>
			<?endforeach?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</table>
</div>
</div>
</div>

<a class="btn indigo darken-1 pechat" onclick="jQuery('.ele1').print({globalStyles: false})"><i class="fa fa-print"></i> Распечатать</a> <a href="#nachalo" class="vsev btn trigger yellow black-text">Показать выданные</a> <a href="#nachalo" class="vsez btn trigger1">Показать все</a>
<a class="btn pkrs">Только покраска</a> <a class="btn plrv">Только полировка</a>
<script>

    $(".pkrs").click(function(){
        $(".polir").toggle();
        $(".plrv").toggle();
        $(".vsez").toggle();
        $(".vsev").toggle();
		$(".vydan").hide();
		$(".other").hide();
      $(this).text(function(i, text){
          return text === "Только покраска" ? "Все текущие" : "Только покраска";
      })
    });
    $(".plrv").click(function(){
        $(".pokr").toggle();
        $(".pkrs").toggle();
        $(".vsez").toggle();
        $(".vsev").toggle();
		$(".vydan").hide();
		$(".other").hide();
      $(this).text(function(i, text){
          return text === "Только полировка" ? "Все текущие" : "Только полировка";
      })
    });

</script>

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