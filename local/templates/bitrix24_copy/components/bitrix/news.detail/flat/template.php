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
<style type="text/css">
 .spoiler_body { display:none; font-style:italic; }
 .spoiler_links { cursor:pointer; font-weight:bold; text-decoration:underline; }
 .blue { color:#000099; }
 .green { color:#009900; }
</style>
<p>
[ <a href="<?=$href?>"><?=GetMessage("FORM_EDIT")?></a> ]
</p>
<?
}
?>
<script type="text/javascript">
$(document).ready(function(){
 $('.spoiler_links').click(function(){
  $(this).next('.spoiler_body').toggle('normal');
  return false;
 });
});
</script>
<div class="spoiler_links blue">Смотреть текущие работы</div>
<div class="row spoiler_body">
<div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">Фото ДО</h4>
                </div>
		<?if($arResult["RESULT"]["SIMPLE_QUESTION_10"]["ANSWER_VALUE"]["0"]["ANSWER_TEXT"] == "ДА"):?>
		<?=$arResult["RESULT"]["SIMPLE_QUESTION_10"]["ANSWER_VALUE"]["0"]["ANSWER_TEXT"]?>: <?=$arResult["RESULT"]["SIMPLE_QUESTION_24"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?><?else:?>НЕТ<?endif;?>
	</div>
	</div>
	<?if($arResult["RESULT"]["SIMPLE_QUESTION_430"]["ANSWER_VALUE"]["0"]["ANSWER_TEXT"] == "комплекс"):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Снятие колес</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_43"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_43"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_44"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_44"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width:39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_61"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_61"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
	</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Мойка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_45"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_45"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_46"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_46"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_62"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_62"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
	</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Демонтаж</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_47"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_47"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_48"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_48"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_63"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_63"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>

<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_430"]["ANSWER_VALUE"] as $key5 => $arWork5):?>
	<?if(in_array("съем" ,$arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Снятие колес</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_43"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_43"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_44"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_44"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_61"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_61"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(in_array("мойка", $arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Мойка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_45"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_45"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_46"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_46"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_62"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_62"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(array_search("демонтаж" , $arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Демонтаж</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_47"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_47"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_48"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_48"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_63"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_63"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
<?endforeach;?>

<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Проверка геометрии</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_26"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_26"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_27"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_27"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_64"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_64"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_320"]["ANSWER_VALUE"]["0"]["USER_TEXT"]) or !empty($arResult["RESULT"]["SIMPLE_QUESTION_881"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	В смывке</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_13"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_13"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_25"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_25"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_65"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_65"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Вышли из смывки</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_14"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_14"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_28"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_28"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_66"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_66"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_394"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Ремонт</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_12"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_12"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_29"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_29"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_67"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_67"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_320_2NxRM"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Маскировка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_41"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_41"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_42"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_42"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_75"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_75"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_881"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>

<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Загружены в грубые</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_16"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_16"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_57"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_57"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_69"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_69"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Вышли из грубых</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_15"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_15"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_40"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_40"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_70"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_70"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Загружены в средние</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_17"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_17"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_56"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_56"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_71"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_71"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Вышли из срених</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_38"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_38"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_39"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_39"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_72"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_72"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Загружены в финишные</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_18"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_18"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_55"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_55"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_73"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_73"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Вышли из финишных</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_20"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_20"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_37"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_37"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_74"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_74"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_320"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Ручная подготовка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_30"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_30"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_31"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_31"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_68"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_68"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Грунтовка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_32"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_32"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_33"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_33"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_76"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_76"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Покраска</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_19"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_19"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_34"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_34"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_77"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_77"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Покрытие лаком</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_35"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_35"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_36"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_36"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_78"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_78"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if($arResult["RESULT"]["SIMPLE_QUESTION_430"]["ANSWER_VALUE"]["0"]["ANSWER_TEXT"] == "комплекс"):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Монтаж</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_49"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_49"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_50"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_50"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_79"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_79"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Балансировка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_51"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_51"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_52"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_52"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_80"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_80"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Установка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_53"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_53"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_54"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_54"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
		<div style="width: 39%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_81"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_81"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_430"]["ANSWER_VALUE"] as $key5 => $arWork5):?>
	<?if(in_array("монтаж" ,$arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Монтаж</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_49"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_49"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_50"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_50"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(in_array("балансировка", $arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Балансировка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_51"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_51"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_52"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_52"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
	<?if(array_search("установка" , $arWork5)):?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Установка</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_53"]["ANSWER_VALUE"] as $key => $arWork1):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_53"]["ANSWER_VALUE"][$key]["ANSWER_TEXT"]?>:<br>
				<?endforeach;?>
		</div>
		<div style="width: 38%;float:left;font-size:10px;">
				<?foreach($arResult["RESULT"]["SIMPLE_QUESTION_54"]["ANSWER_VALUE"] as $key => $arWork2):?>
					<?=$arResult["RESULT"]["SIMPLE_QUESTION_54"]["ANSWER_VALUE"][$key]["USER_TEXT"]?><br>
				<?endforeach;?>
		</div>
	</div>
		</div>
	</div>
	<?endif;?>
<?endforeach;?>
<div class="col-sm-3">

              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title">
	Фото ПОСЛЕ</h4>
                </div>
<div class="row">
				  <div style="width: 14%;float:left;font-size:10px;margin-left: 23px;">
	</div>
</div>
		</div>
		</div>
		</div>
<div style="clear:both;"></div>

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
<div id="row" style="line-height:14px;">

<div class="col-md-9">
<div class="row ele1">
<style>
	body {-webkit-print-color-adjust:exact;}
	.box .nav-stacked>li {font-size:12px;}
	.box-body {padding:5px !important;}
	.col-md-3, .col-md-4, .col-md-5, .col-md-7, .col-md-12 {padding-left:10px !important; padding-right:10px !important;}
	</style>
	<link rel="stylesheet" type="text/css" media="print" href="panel/bootstrap/css/bootstrap.min.css">
<div class="col-md-12">
<div style="text-align: center;">
  <p style="font-size:24px;">Бланк заказа (счет форма)</p>
</div>
	</div>
	<div class="col-md-4" style="width:33%; float:left;"><img src="http://thomifelgen.ru/bitrix/templates/thomifelgen/img/logo.png" width="183" height="70"></div>
	<div class="col-md-4" style="width:33%; float:left;"><div class="box box-primary"><div class="box-header with-border">
		<h3 class="box-title">+7 (495) 979-20-01</h3></div>
<div class="box-body">
	<label>Телефон</label>
		</div>
</div></div>
  <div class="col-md-4" style="width:33%; float:left;">
<div class="box box-primary">
<div class="box-header with-border">
	<h3 class="box-title">Заявка № <?=$arResult["NAME"]?></h3></div>

<div class="box-body">

<label>
	Дата: <?=$arResult["DATE_CREATE"]?></label>

   </div>
	  </div>
	</div>
 <div style="clear:both;"></div>
	<div class="col-md-7" style="width:58%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h3 class="box-title">Контактная информация</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
<?if(!empty($arResult["PROPERTIES"]["PARTNER"]["VALUE"])):?>
	<li>Партнер 

<?=$arResult["PROPERTIES"]["PARTNER"]["VALUE"]?>
	</li>
 <?endif;?>
	<li>Ф.И.О.: <span class="pull-right" ><?=$arResult["PROPERTIES"]["FIO"]["VALUE"]?></span>
	</li>
	<li>Телефон: <span class="pull-right" ><?=$arResult["PROPERTIES"]["TELEPHONE"]["VALUE"]?></span></li>
	<li>Email: <span class="pull-right" ><?=$arResult["PROPERTIES"]["EMAIL"]["VALUE"]?></span></li>
	<?if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
	<li>№ дисконтной карты <span class="pull-right" ><?=$arResult["PROPERTIES"]["DISCOUNT"]["VALUE"]?></span></li><?endif;?>
	<li>Дополнительная информация <span class="pull-right" ><?=$arResult["PROPERTIES"]["PRIM"]["VALUE"]?></span><br>
<?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_320_2NxRM"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?><?else:?>
		<span style="color:red;">МАСКИРОВКА: <?=$arResult["RESULT"]["SIMPLE_QUESTION_4111"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?> </span>
<?endif;?>
</li>
	</ul>
</div>
	</div>
</div>
	<div class="col-md-5" style="width:42%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border">
	<h3 class="box-title">Конфигурация</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
	<li>ТС: <span class="pull-right" ><?=$arResult["PROPERTIES"]["TYPE"]["VALUE"]?> <?=$arResult["PROPERTIES"]["MARKA"]["VALUE"]?></span>
	</li>
	<li>Кол-во дисков/деталей: <span class="pull-right" ><?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?></span></li>
<?if($arResult["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?>
<?else:?>
	<li>Марка дисков: <span class="pull-right" ><?=$arResult["PROPERTIES"]["MARKAD"]["VALUE"]?> <?=$arResult["PROPERTIES"]["DIAMETR"]["VALUE"]?> <?=$arResult["PROPERTIES"]["CHDISK"]["VALUE"]?></span></li><?endif;?>

<?if($arResult["PROPERTIES"]["TYPE"]["VALUE"] == "Другое"):?><?else:?>
	<li>Материал дисков: <span class="pull-right" ><?=$arResult["PROPERTIES"]["MAT"]["VALUE"]?></span></li>
	<li>Колпачки: <span class="pull-right" ><?=$arResult["PROPERTIES"]["KOLP"]["VALUE"]?> (кол-во: <?=$arResult["PROPERTIES"]["KOLPKOL"]["VALUE"]?>)</span></li>

	<li>Ниппель: <span class="pull-right" ><?=$arResult["PROPERTIES"]["NIPP"]["VALUE"]?> (кол-во: <?=$arResult["PROPERTIES"]["NIPKOL"]["VALUE"]?>)</span></li><?endif;?>
	</ul>
</div>
	</div>
</div>
<div style="clear:both;"></div>
    <?if(empty($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
	<div class="box-header with-border" style="background:#3c8dbc;">
	<h3 class="box-title">Покраска</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
<?foreach($arResult["PROPERTIES"]["POKR"]["VALUE"]as $key => $arAnswer):?>
<?if (strlen($arAnswer)>0):?>
<li><?=$arAnswer?></li>
<?endif;?> 
<?endforeach;?> 
	<li>Цвет: <span class="pull-right" ><?=$arResult["PROPERTIES"]["COLOR"]["VALUE"]?><?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_3651"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>+<?=$arResult["RESULT"]["SIMPLE_QUESTION_3651"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?><?endif;?></span>
	</li>
	<li>Лак: <span class="pull-right" ><?=$arResult["PROPERTIES"]["LAKPOK"]["VALUE"]?><?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_3652"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?> <?=$arResult["RESULT"]["SIMPLE_QUESTION_3652"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?><?endif;?></span></li>
<?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_320_2NxRM"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?><?else:?>
	<li>Маскировка <span class="pull-right" >+ <?=$arResult["RESULT"]["SIMPLE_QUESTION_320_2NxRM"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?></span></li>
    <li>Что маскируем <span class="pull-right" ><?=$arResult["RESULT"]["SIMPLE_QUESTION_4111"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?></span></li>
<?endif;?>
	<li>Стоимость: </li>
</ul>
	<div class="external-event bg-light-blue" style="font-size:12px;"><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>(<?endif;?><?=$arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]?><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>+<?endif;?><?=$arResult["PROPERTIES"]["MASK"]["VALUE"]?><?if(!empty($arResult["PROPERTIES"]["MASK"]["VALUE"])):?>)<?endif;?> х <?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?> = <?=($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["MASK"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"]?></div>
</div>
	</div>
</div>
<?endif;?>


<?if(empty($arResult["PROPERTIES"]["PRICEPOL"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border"  style="background:#3c8dbc;">
	<h3 class="box-title">Полировка</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
<?foreach($arResult["PROPERTIES"]["POLIR"]["VALUE"] as $key => $arAnswer):?> 
<?if (strlen($arAnswer)>0):?>
<li><?=$arAnswer?></li>
<?endif;?> 
<?endforeach;?> 
	<li>Лак: <span class="pull-right" ><?=$arResult["PROPERTIES"]["LAKPOL"]["VALUE"]?><?if(!empty($arResult["RESULT"]["SIMPLE_QUESTION_3652"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?> <?=$arResult["RESULT"]["SIMPLE_QUESTION_3652"]["ANSWER_VALUE"]["0"]["USER_TEXT"]?><?endif;?></span>
	</li>

	<li>Стоимость: </li>
</ul>
	<div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"]?> х <?=$arResult["PROPERTIES"]["KOL"]["VALUE"]?> = <?=$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"]*$arResult["PROPERTIES"]["KOL"]["VALUE"]?></div>
</div>
	</div>
</div>
<?endif;?>


<?if($arResult["PROPERTIES"]["REM"]["VALUE"] == "нет" or empty($arResult["PROPERTIES"]["STREM"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border"  style="background:#3c8dbc;">
	<h3 class="box-title">Ремонт</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
<?if(empty($arResult["PROPERTIES"]["STREM"]["VALUE"])):?>
<?else:?>
	<li><?=$arResult["PROPERTIES"]["REM"]["VALUE"]["0"]?><span class="pull-right" ><?=$arResult["PROPERTIES"]["REMKOL"]["VALUE"]?>x<?=$arResult["PROPERTIES"]["STREM"]["VALUE"]?></span></li>

<?if(!empty($arResult["PROPERTIES"]["SVAR"]["VALUE"])):?>
<li>Сварка <span class="pull-right" ><?=$arResult["PROPERTIES"]["SVARKOL"]["VALUE"]?>x<?=$arResult["PROPERTIES"]["SVAR"]["VALUE"]?></span></li>
<?endif;?>
	<li>Стоимость: <span class="pull-right" ></span></li>
<?endif;?>
</ul>
	<div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]+$arResult["PROPERTIES"]["SVAR"]["VALUE"]*$arResult["PROPERTIES"]["SVARKOL"]["VALUE"]?></div>
</div>
	</div>
</div>
<?endif;?>

<?if(empty($arResult["PROPERTIES"]["PRICESHIN"]["VALUE"])):?><?else:?>
	<div class="col-md-3" style="width:25%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background:#3c8dbc;">
	<h3 class="box-title">Шиномонтаж</h3></div>

<div class="box-body">
<ul class="nav nav-stacked">
<?foreach($arResult["PROPERTIES"]["SHINO"]["VALUE"]as $key => $arAnswer):?>
				<?if (strlen($arAnswer) > 0 && $arAnswer != "время записи"):?>
<li><?=$arAnswer?></li>
<?endif;?> 

<?endforeach;?>
	<li>Количество: <span class="pull-right" ><?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]?></span></li>
    <?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_879"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>
	<?else:?>
	<li>Стоимость: <span class="pull-right" ></span></li>
	<?endif;?>
</ul>
	<div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]?> х <?=$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]?> = <?=$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]?></div>
</div>
	</div>
</div>
<?endif;?>
<div style="clear:both;"></div>
<div class="col-md-12">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title">Дополнительные услуги:<?if(!empty($arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]) or !empty($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"])):?>на сумму <?=$arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]+$arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]+$arResult["PROPERTIES"]["SBRZB"]["VALUE"]?><?endif;?></h3></div>

<div class="box-body">
<?if(!empty($arResult["PROPERTIES"]["PRICEDOST"]["VALUE"])):?>
<div class="col-md-3">

	Доставка <div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["PRICEDOST"]["VALUE"]?></div>
	</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"])):?>
<div class="col-md-3">

	Реставрация болтов <div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["PRICEBOLT"]["VALUE"]?></div>
	</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SBRZB"]["VALUE"])):?>
<div class="col-md-3">

	Сборка/разборка дисков <div class="external-event bg-light-blue" style="font-size:12px;"><?=$arResult["PROPERTIES"]["SBRZB"]["VALUE"]?></div>
	</div>
<?endif;?>
	</div>
	</div>
</div>

<div style="clear:both;"></div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title">Калькуляция:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li>Подитог: <span class="pull-right" ><?=$arResult["PROPERTIES"]["ITOGO"]["VALUE"]?></span></li>
<?if(!empty($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]) or !empty($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])):?>
	<li>Сумма скидок: <span class="pull-right" ><?=($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100)+$arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]/100)+$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]*$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]/100)?></span></li>
<?endif;?>
	<li>Предварительная стоимость: <span class="pull-right" ><?=$arResult["PROPERTIES"]["PREDPRICE"]["VALUE"]?></span></li>
	<li>Предоплата: <span class="pull-right" ><?=$arResult["PROPERTIES"]["PREDO"]["VALUE"]?></strong>  
      <?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_900"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>Нет<?else:?>
      <?if($arResult["RESULT"]["SIMPLE_QUESTION_900"]["ANSWER_VALUE"]["1"]["ANSWER_TEXT"] == "Карта?"):?>Карта<?else:?>Нал
      <?endif;?><?endif;?></span></li>
	<li>Доплата: <span class="pull-right" ><?=$arResult["PROPERTIES"]["DOPL"]["VALUE"]?></strong>  
      <?if(empty($arResult["RESULT"]["SIMPLE_QUESTION_9000"]["ANSWER_VALUE"]["0"]["USER_TEXT"])):?>Нет<?else:?>
      <?if($arResult["RESULT"]["SIMPLE_QUESTION_9000"]["ANSWER_VALUE"]["1"]["ANSWER_TEXT"] == "Карта?"):?>Карта<?else:?>Нал
      <?endif;?><?endif;?></span></li>
	<li>Осталось оплатить: <span class="pull-right" ><?=$arResult["PROPERTIES"]["PREDPRICE"]["VALUE"] - $arResult["PROPERTIES"]["PREDO"]["VALUE"] - $arResult["PROPERTIES"]["DOPL"]["VALUE"]?></span></li>
	</ul>
</div>
	</div>
</div>
<div class="col-md-8" style="width:66%;float:left;">
<div class="row">
<?if(!empty($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Скидка на основные услуги:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li><?=$arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]?>% - <?=($arResult["PROPERTIES"]["PRICEPOK"]["VALUE"]+$arResult["PROPERTIES"]["PRICEPOL"]["VALUE"])*$arResult["PROPERTIES"]["KOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDOSN"]["VALUE"]/100)?></li>
	</ul>
</div>
	</div>
</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SKIDREM"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Скидка на ремонт:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li><?=$arResult["PROPERTIES"]["SKIDREM"]["VALUE"]?>% - <?=($arResult["PROPERTIES"]["STREM"]["VALUE"]*$arResult["PROPERTIES"]["REMKOL"]["VALUE"]+$arResult["PROPERTIES"]["SVAR"]["VALUE"]*$arResult["PROPERTIES"]["SVARKOL"]["VALUE"])*($arResult["PROPERTIES"]["SKIDREM"]["VALUE"]/100)?></li>
	</ul>
</div>
	</div>
</div>
<?endif;?>
<?if(!empty($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"])):?>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Скидка на шиномонтаж:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li><?=$arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]?>% - <?=$arResult["PROPERTIES"]["PRICESHIN"]["VALUE"]*$arResult["PROPERTIES"]["SHINKOL"]["VALUE"]*($arResult["PROPERTIES"]["SKIDSHIN"]["VALUE"]/100)?></li>
	</ul>
</div>
	</div>
</div>
<?endif;?>
	<div style="clear:both;"></div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Ориентировочная дата выдачи:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li><?=$arResult["PROPERTIES"]["DATEV"]["VALUE"]?></li>
	</ul>
</div>
	</div>
</div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Подпись заказчика:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li>_____________</li>
	</ul>
</div>
	</div>
</div>
	<div class="col-md-4" style="width:33%;float:left;">
<div class="box box-primary box-solid">
<div class="box-header with-border" style="background-color:#3c8dbc;">
	<h3 class="box-title" style="font-size:13px;">Подпись принимающего:</h3></div>
<div class="box-body">
<ul class="nav nav-stacked">
	<li>_____________<span class="pull-right" >МП</span></li>
	</ul>
</div>
	</div>
</div>

			</div>
		  </div>
 <div style="clear:both;"></div>
	<div class="col-md-12">
<div class="box box-primary box-solid">
<div class="box-body">
<ul class="nav nav-stacked">
	<li>Претензий к качеству выполненных работ и внешнему виду дисков (цвет, блеск и т.п.) не имею<span class="pull-right" >_____________________</span></li>
	</ul>
</div>
	</div>
</div>
 <div style="clear:both;"></div>

	<div class="col-md-12">
<div class="box box-primary box-solid">
<div class="box-body">
<ul class="nav nav-stacked">
	<li>После завершения работ по Вашему заказу, нам будет приятно, если Вы оставите отзыв на нашем сайте в разделе www.thomifelgen.ru/otzyvy. Мы постоянно совершенстуем наши технологии для Вас и нам важно знать Ваше мнение. <br>Спасибо что выбрали мастерскую Thomi Felgen! </li>
	</ul>
</div>
	</div>
</div>

</div>
</div>
<br><br>

<div style="text-align:center"><button class="print-link" onclick="jQuery.print('.ele1')">
                Распечатать
	</button></div>


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
