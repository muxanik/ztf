<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
$this->setFrameMode(false);

if (!empty($arResult["ERRORS"])):?>	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<?
$arSelect = Array("NAME");
$arFilter = Array("IBLOCK_ID"=>"32", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilter, false, Array("nPageSize"=>1), $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();

}

?> 
<?$az=date("d.m.Y", strtotime($arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"]))?><br>
<?$za=date("d.m.Y", strtotime($arResult["ELEMENT"]["TIMESTAMP_X"]));?>
<?$zz = date("d.m.Y");?>

<?if(!empty($arResult["ELEMENT_PROPERTIES"]["347"]["0"]["VALUE"])):?><?$dvyd=$az;?><?else:?><?$dvyd=$za;?><?endif;?><?$interval=$dvyd-$zz;?>





<script src="/bitrix/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="/bitrix/js/materialize.css">
<script src="/bitrix/js/materialize.min.js"></script>
<form id="calx1" name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
<?$in = 0;?>
	<div class="ceh"> <a class="btn" href="/zakazy/" >Вернуться к заказам</a> 
  <div class="row"> 
    <div class="col s3" id="b<?=$in++;?>"> 
    		<div class="card hoverable" style="height: 280px;;;text-align:center;">
<div class="card-image teal white-text" style="padding:5px;">
	<h6 class="box-title">Выполнен вход:</h6></div> 
    <span data-cell="UP1" class="name_photot"><?
global $USER;
echo $USER->GetFullName();
?></span> <a href="/panel/ceh.php?logout=yes" onmouseover="BX.hint(this, 'Выход пользователя из системы. (&amp;nbsp;Ctrl+Alt+O&amp;nbsp;) ')" >Выйти</a> 
				<br><span data-cell="TN1" id="seychas" style="display:none;"><?$sm="-1";
$time=strtotime("now".$sm." hour");
echo date('H:i:s d.m.Y',$time);?></span>
<div>Заказ № <?=$arResult["ELEMENT"]["NAME"]?> <br>Работы:<br>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"])):?>Покраска<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>Полировка<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["138"]["0"]["VALUE"]) or !empty($arResult["ELEMENT_PROPERTIES"]["137"]["0"]["VALUE"])):?>Ремонт<br><?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["143"]["0"]["VALUE"])):?>Шиномонтаж<br><?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["117"]["0"]["VALUE"])):?><?=$arResult["ELEMENT_PROPERTIES"]["117"]["0"]["VALUE"]?><?endif;?>
</div>
</div></div>
<?$kolesa = array (0,1,2,3,4,5,6,7);?>
<?$koles = $arResult["ELEMENT_PROPERTIES"]["120"]["0"]["VALUE"];?>
<?$shkoles = $arResult["ELEMENT_PROPERTIES"]["156"]["0"]["VALUE"];?>
<?$rmkoles = $arResult["ELEMENT_PROPERTIES"]["154"]["0"]["VALUE"];?>
<?$kol_kolp = $arResult["ELEMENT_PROPERTIES"]["357"]["0"]["VALUE"];?>
<?$svkoles = $arResult["ELEMENT_PROPERTIES"]["155"]["0"]["VALUE"];?>
<?$ii = -1;?>
<?$bg = $arResult["ELEMENT_PROPERTIES"]["140"];?>
<?foreach($bg as $key10 => $bg1[]):?>
	<?$bg2[] = $bg1[$key10]["VALUE_ENUM"];?>
<?endforeach;?>
<?$br = $arResult["ELEMENT_PROPERTIES"]["128"];?>
<?foreach($br as $key11 => $br1[]):?>
	<?$br2[] = $br1[$key11]["VALUE_ENUM"];?>
<?endforeach;?>
<?$bl = $arResult["ELEMENT_PROPERTIES"]["133"];?>
<?foreach($bl as $key12 => $bl1[]):?>
	<?$bl2[] = $bl1[$key12]["VALUE_ENUM"];?>
<?endforeach;?>
<?$klp = $arResult["ELEMENT_PROPERTIES"]["356"];?>
<?foreach($klp as $key17 => $klp1[]):?>
	<?$klp2[] = $klp1[$key17]["VALUE_ENUM"];?>
<?endforeach;?>
<?$bre = $arResult["ELEMENT_PROPERTIES"]["136"];?>
<?foreach($bre as $key13 => $bre1[]):?>
	<?$bre2[] = $bre1[$key13]["VALUE_ENUM"];?>
<?endforeach;?>

<?if($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]+$arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"] > 0 or in_array('требуется фото', $bre2)):?>
	  <?if(empty($arResult["ELEMENT_PROPERTIES"]["198"]["0"]["VALUE"])):?>
	  <?$fotonet = '<b>Внимание, не сделаны фото до!!! Не начинать работу!</b>';?><?endif;?>
<?endif;?> 
<?if($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]+$arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"] > 0 or in_array('требуется фото', $bre2)):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Сделаны фото ДО: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["199"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?if(!empty($arResult["ELEMENT_PROPERTIES"]["198"]["0"]["VALUE"])):?><?$renderImage = CFile::ResizeImageGet($arResult["ELEMENT_PROPERTIES"]["198"]["0"]["VALUE"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
			<div class="card-image">
				<img class="materialboxed" src="<?=$renderImage['src']?>" width="100%">
				<span class="card-title"><?=$arResult["ELEMENT_PROPERTIES"]["199"]["0"]["VALUE"]?> <span style="font-size: 12px;right: 0;position: absolute;color: white;"><?=$arResult["ELEMENT_PROPERTIES"]["200"]["0"]["VALUE"]?></span></span>
			</div><?else:?>
			<input type="hidden" name="PROPERTY[198][0]" value="">
			<input type="file" size="30" name="PROPERTY_FILE_198_0">
			<p class="center-align">
				<input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["198"]["NAME"]?> отмечена', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["198"]["NAME"])?>', 4000)}" id="sdph1" data-cell="PO1" type="checkbox" value="1">
					<label for="sdph1">Сделано фото</label>
			</p>
			<?endif;?>
			<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["198"]["0"]["VALUE"])):?>data-formula="IF(PO1>0,UP1,0)"<?endif;?> type="text" class="property199-0" name="PROPERTY[199][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["199"]["0"]["VALUE"]?>">
			<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["198"]["0"]["VALUE"])):?>data-formula="IF(PO1>0,TN1,0)"<?endif;?> type="text" class="property200-0" name="PROPERTY[200][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["200"]["0"]["VALUE"]?>">
		</div>
	</div>
<?endif;?>
<?if($arResult["ELEMENT_PROPERTIES"]["322"]["0"]["VALUE_ENUM"] == "Да"):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Макет диска: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["320"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?if(!empty($arResult["ELEMENT_PROPERTIES"]["319"]["0"]["VALUE"])):?><?$renderImage = CFile::ResizeImageGet($arResult["ELEMENT_PROPERTIES"]["319"]["0"]["VALUE"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
			<div class="card-image"><img class="materialboxed" src="<?=$renderImage['src']?>" width="100%"><span class="card-title"><?=$arResult["ELEMENT_PROPERTIES"]["320"]["0"]["VALUE"]?> <span style="font-size: 12px;right: 0;position: absolute;color: white;"><?=$arResult["ELEMENT_PROPERTIES"]["321"]["0"]["VALUE"]?></span></span></div><?else:?><input type="hidden" name="PROPERTY[319][0]" value="">
				<input type="file" size="30" name="PROPERTY_FILE_319_0">
				<p class="center-align"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["319"]["NAME"]?> отмечена', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["319"]["NAME"])?>', 4000)}" id="sdph1" data-cell="MZ1" type="checkbox" value="1">
					<label for="sdph1">Сделано макет диска</label>
				</p>
			<?endif;?>
			<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["319"]["0"]["VALUE"])):?>data-formula="IF(MZ1>0,UP1,0)"<?endif;?> type="text" class="property320-0" name="PROPERTY[320][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["320"]["0"]["VALUE"]?>">
			<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["319"]["0"]["VALUE"])):?>data-formula="IF(MZ1>0,TN1,0)"<?endif;?> type="text" class="property321-0" name="PROPERTY[321][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["321"]["0"]["VALUE"]?>">
		</div>
	</div>
<?endif;?>
<?if($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]+$arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"] > 0 or in_array('требуется фото', $bre2)):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Сделаны фото ПОСЛЕ: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["314"]["NAME"],"тор "),4);?> руб.</h6>
			</div> 
			<div class="center-align">
				<?if(!empty($arResult["ELEMENT_PROPERTIES"]["313"]["0"]["VALUE"])):?><?$renderImage1 = CFile::ResizeImageGet($arResult["ELEMENT_PROPERTIES"]["313"]["0"]["VALUE"], Array("width"=>"400", "height"=>"260"), BX_RESIZE_IMAGE_EXACT);?>
					<div class="card-image"><img class="materialboxed" src="<?=$renderImage1['src']?>" width="100%"><span class="card-title"><?=$arResult["ELEMENT_PROPERTIES"]["314"]["0"]["VALUE"]?> <span style="font-size: 12px;right: 0;position: absolute;color: white;"><?=$arResult["ELEMENT_PROPERTIES"]["315"]["0"]["VALUE"]?></span></span>
					</div>
				<?else:?>
					<input type="hidden" name="PROPERTY[313][0]" value="">
					<input type="file" size="30" name="PROPERTY_FILE_313_0">
				<p class="center-align">
					<input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["313"]["NAME"]?> отмечена', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["313"]["NAME"])?>', 4000)}" id="sdph" data-cell="PD1" type="checkbox" value="1">
						<label for="sdph">Сделано фото</label>
				</p>
				<?endif;?>
				<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["313"]["0"]["VALUE"])):?>data-formula="IF(PD1>0,UP1,0)"<?endif;?> type="text" class="property314-0" name="PROPERTY[314][0]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["314"]["0"]["VALUE"]?>">
				<input hidden <?if(empty($arResult["ELEMENT_PROPERTIES"]["313"]["0"]["VALUE"])):?>data-formula="IF(PD1>0,TN1,0)" type="text" class="property315-0" name="PROPERTY[315][0]" size="25"<?endif;?> value="<?=$arResult["ELEMENT_PROPERTIES"]["315"]["0"]["VALUE"]?>">
			</div>
		</div>
	</div>
<?endif;?>

<?if(in_array('съем', $bg2) or in_array('комплекс', $bg2)):?>
	<div id="b<?=$in++;?>" class="col s3">
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Снятие колес: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["211"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
				<?foreach($kolesa as $snKol):?>
			<?if($shkoles <= 0):?>
					<?if($snKol < $arResult["ELEMENT_PROPERTIES"]["339"]["0"]["VALUE"]):?>
						<input hidden type="text" class="property210-<?=$snKol;?>" name="PROPERTY[210][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["210"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["210"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["211"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["212"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;">
								<input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["210"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["210"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-210-<?=$snKol;?>" id="property-210-<?=$snKol;?>">
						<?endif;?>
						<label for="property-210-<?=$snKol;?>"> <?=$snKol+1;?> диск<label></p>
						<input hidden type="text" class="property211-<?=$snKol;?>" name="PROPERTY[211][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["211"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property212-<?=$snKol;?>" name="PROPERTY[212][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["212"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?else:?>
					<?if($snKol < $shkoles):?>
						<input hidden type="text" class="property210-<?=$snKol;?>" name="PROPERTY[210][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["210"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["210"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["211"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["212"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;">
								<input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["210"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["210"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-210-<?=$snKol;?>" id="property-210-<?=$snKol;?>">
						<?endif;?>
						<label for="property-210-<?=$snKol;?>"> <?=$snKol+1;?> диск<label></p>
						<input hidden type="text" class="property211-<?=$snKol;?>" name="PROPERTY[211][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["211"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property212-<?=$snKol;?>" name="PROPERTY[212][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["212"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endif;?>
				<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?if(in_array('мойка', $bg2) or in_array('комплекс', $bg2)):?>
	<div id="b<?=$in++;?>" class="col s3 hidde" >
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Мойка колес: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["232"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $shkoles):?>
					<input hidden type="text" class="property231-<?=$snKol;?>" name="PROPERTY[231][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["231"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["231"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["232"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["233"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["231"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["231"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-231-<?=$snKol;?>" id="property-231-<?=$snKol;?>">
					<?endif;?>
					<label for="property-231-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property232-<?=$snKol;?>" name="PROPERTY[232][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["232"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property233-<?=$snKol;?>" name="PROPERTY[233][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["233"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?if(in_array('демонтаж', $bg2) or in_array('комплекс', $bg2)):?>
	<div id="b<?=$in++;?>" class="col s3 hidde" >
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Демонтаж колес: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["214"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
			<?if($shkoles <= 0):?>
				<?if($snKol < $arResult["ELEMENT_PROPERTIES"]["340"]["0"]["VALUE"]):?>
					<input hidden type="text" class="property213-<?=$snKol;?>" name="PROPERTY[213][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["213"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["213"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["214"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["215"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["213"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["213"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-213-<?=$snKol;?>" id="property-213-<?=$snKol;?>">
					<?endif;?>
					<label for="property-213-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property214-<?=$snKol;?>" name="PROPERTY[214][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["214"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property215-<?=$snKol;?>" name="PROPERTY[215][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["215"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?else:?>
				<?if($snKol < $shkoles):?>
					<input hidden type="text" class="property213-<?=$snKol;?>" name="PROPERTY[213][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["213"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["213"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["214"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["215"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["213"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["213"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-213-<?=$snKol;?>" id="property-213-<?=$snKol;?>">
					<?endif;?>
					<label for="property-213-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property214-<?=$snKol;?>" name="PROPERTY[214][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["214"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property215-<?=$snKol;?>" name="PROPERTY[215][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["215"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?if($arResult["ELEMENT_PROPERTIES"]["316"]["0"]["VALUE"] == "чистка смывки"):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Чистка смывки: </h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property365-<?=$snKol;?>" name="PROPERTY[365][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["365"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["365"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["366"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["367"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["365"]["NAME"]?> отмечена для <?=$snKol+1;?> сотрудника', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["365"]["NAME"])?> для <?=$snKol+1;?> сотрудника', 4000)}" type="checkbox" class="property-365-<?=$snKol;?>" id="property-365-<?=$snKol;?>">
					<?endif;?>
					<label for="property-365-<?=$snKol;?>"> <?=$snKol+1;?> сотрудник</label></p>
					<input hidden type="text" class="property366-<?=$snKol;?>" name="PROPERTY[366][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["366"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property367-<?=$snKol;?>" name="PROPERTY[367][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["367"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Проверка геометрии: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["235"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property234-<?=$snKol;?>" name="PROPERTY[234][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["234"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["234"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["235"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["236"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["234"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["234"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-234-<?=$snKol;?>" id="property-234-<?=$snKol;?>">
					<?endif;?>
					<label for="property-234-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property235-<?=$snKol;?>" name="PROPERTY[235][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["235"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property236-<?=$snKol;?>" name="PROPERTY[236][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["236"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
		</div>
	</div>
		<?endif;?>
<?if(empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) && empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?><?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a36/moyki_hd_7_18_c.png);background-position: -20px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Подготовка к смывке: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["202"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property201-<?=$snKol;?>" name="PROPERTY[201][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["201"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["201"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["203"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($_POST['PROPERTY[235][<?=$snKol;?>]']) && empty($_POST['PROPERTY[235][<?=$snKol;?>]'])):?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["201"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["201"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-201-<?=$snKol;?>" id="property-201-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["235"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["235"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить проверку геометрии" data-position="top"<?endif;?> for="property-201-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property202-<?=$snKol;?>" name="PROPERTY[202][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property203-<?=$snKol;?>" name="PROPERTY[203][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["203"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/092/science_chemistry_icon.png);background-position: -100px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">В смывке: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["205"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property204-<?=$snKol;?>" name="PROPERTY[204][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["204"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["204"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["206"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"])):?><?else:?>  data-tooltip="Необходимо выполнить подготовку к смывке"<?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["204"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["204"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-204-<?=$snKol;?>" id="property-204-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["202"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить подготовку к смывке" data-position="top"<?endif;?> for="property-204-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property205-<?=$snKol;?>" name="PROPERTY[205][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property206-<?=$snKol;?>" name="PROPERTY[206][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["206"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/092/science_chemistry_icon.png);background-position: -100px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Вышли из смывки: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["208"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property207-<?=$snKol;?>" name="PROPERTY[207][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["207"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["207"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["209"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["207"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["207"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-207-<?=$snKol;?>" id="property-207-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["205"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо загрузить в смывку" data-position="top"<?endif;?> for="property-207-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property208-<?=$snKol;?>" name="PROPERTY[208][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property209-<?=$snKol;?>" name="PROPERTY[209][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["209"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["146"]["0"]["VALUE"])):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/4b0/251112_4.png);background-position: -163px 26px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Разбор дисков: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["238"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property237-<?=$snKol;?>" name="PROPERTY[237][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["237"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["237"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["239"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["237"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["237"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-237-<?=$snKol;?>" id="property-237-<?=$snKol;?>">
					<?endif;?>
					<label for="property-237-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property238-<?=$snKol;?>" name="PROPERTY[238][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property239-<?=$snKol;?>" name="PROPERTY[239][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["239"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>

<?if(empty($arResult["ELEMENT_PROPERTIES"]["358"]["0"]["VALUE"])):?><?else:?> 
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/32d/remont_litix_diskov.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Изготовление колпачков: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["360"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $kol_kolp):?>
					<input hidden type="text" class="property359-<?=$snKol;?>" name="PROPERTY[359][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["359"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["359"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["360"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["361"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["359"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["359"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-359-<?=$snKol;?>" id="property-359-<?=$snKol;?>">
					<?endif;?>
					<label for="property-359-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property360-<?=$snKol;?>" name="PROPERTY[360][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["360"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property361-<?=$snKol;?>" name="PROPERTY[361][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["361"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>

<?if(empty($arResult["ELEMENT_PROPERTIES"]["137"]["0"]["VALUE"])):?><?else:?> 
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/c9c/argonnaja_svarka_logo.jpg);background-position: -60px 20px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Выполнена сварка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["229"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $svkoles):?>
					<input hidden type="text" class="property228-<?=$snKol;?>" name="PROPERTY[228][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["228"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["228"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["229"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["230"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["228"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["228"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-228-<?=$snKol;?>" id="property-228-<?=$snKol;?>">
						<?endif;?>
						<label for="property-228-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property229-<?=$snKol;?>" name="PROPERTY[229][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["229"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property230-<?=$snKol;?>" name="PROPERTY[230][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["230"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(empty($arResult["ELEMENT_PROPERTIES"]["138"]["0"]["VALUE"])):?><?else:?> 
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/32d/remont_litix_diskov.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Выполнен ремонт: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["226"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $rmkoles):?>
					<input hidden type="text" class="property225-<?=$snKol;?>" name="PROPERTY[225][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["225"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["225"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["226"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["227"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["225"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["225"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-225-<?=$snKol;?>" id="property-225-<?=$snKol;?>">
					<?endif;?>
					<label for="property-225-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property226-<?=$snKol;?>" name="PROPERTY[226][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["226"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property227-<?=$snKol;?>" name="PROPERTY[227][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["227"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>

	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Дополнительные процессы </h6>
			</div>
			<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) and empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>
			<div class="form-group">
				<label>Коррозия</label>
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["152"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["152"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["152"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}?>
											'<p style="text-align:center;"><input type="checkbox" name="PROPERTY[152]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?}?>
			</div>
			<?endif;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		
					<div class="form-group">
				<label>Требуется 2 лак</label>
					<?foreach ($arResult["PROPERTY_LIST_FULL"]["378"]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"]["378"]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"]["378"] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}?>
											'<p style="text-align:center;"><input type="checkbox" name="PROPERTY[378]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label></p>
											<?}?>
			</div>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
			<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) and empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>
<?if($arResult["ELEMENT_PROPERTIES"]["152"]["0"]["VALUE_ENUM"] == "Да"):?>
			<?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Ручная подготовка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["244"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property243-<?=$snKol;?>" name="PROPERTY[243][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["243"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["243"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-243-<?=$snKol;?>" id="property-243-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из смывки" data-position="top"<?endif;?> for="property-243-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property244-<?=$snKol;?>" name="PROPERTY[244][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property245-<?=$snKol;?>" name="PROPERTY[245][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?endif;?>

<?if(!empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"]) and empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"])):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Ручная подготовка для полировки: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["333"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property332-<?=$snKol;?>" name="PROPERTY[332][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["332"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["332"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["334"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["332"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["332"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-332-<?=$snKol;?>" id="property-332-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из смывки" data-position="top"<?endif;?> for="property-332-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property333-<?=$snKol;?>" name="PROPERTY[333][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property334-<?=$snKol;?>" name="PROPERTY[334][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["334"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>

<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Ручная подготовка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["244"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
				<?foreach($kolesa as $snKol):?>
					<?if($snKol < $koles):?>
						<input hidden type="text" class="property243-<?=$snKol;?>" name="PROPERTY[243][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["243"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["243"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-243-<?=$snKol;?>" id="property-243-<?=$snKol;?>">
						<?endif;?>
						<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из смывки" data-position="top"<?endif;?> for="property-243-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property244-<?=$snKol;?>" name="PROPERTY[244][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property245-<?=$snKol;?>" name="PROPERTY[245][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endforeach;?>
				<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Ручная подготовка для полировки: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["333"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property332-<?=$snKol;?>" name="PROPERTY[332][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["332"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["332"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["334"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["332"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["332"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-332-<?=$snKol;?>" id="property-332-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из смывки" data-position="top"<?endif;?> for="property-332-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property333-<?=$snKol;?>" name="PROPERTY[333][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property334-<?=$snKol;?>" name="PROPERTY[334][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["334"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"]) or !empty($arResult["ELEMENT_PROPERTIES"]["152"]["0"]["VALUE_ENUM"])):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Загружены в грубые: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["247"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property246-<?=$snKol;?>" name="PROPERTY[246][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["246"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["246"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["248"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["333"][$snKol]["VALUE"])):?><?else:?> <?endif;?><?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["246"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["246"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-246-<?=$snKol;?>" id="property-246-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить ручную подготовку" data-position="top"<?endif;?> for="property-246-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property247-<?=$snKol;?>" name="PROPERTY[247][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property248-<?=$snKol;?>" name="PROPERTY[248][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["248"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Вышли из грубых: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["250"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property249-<?=$snKol;?>" name="PROPERTY[249][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["249"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["249"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["251"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["249"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["249"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-249-<?=$snKol;?>" id="property-249-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["247"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо загрузить в грубые" data-position="top"<?endif;?> for="property-249-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property250-<?=$snKol;?>" name="PROPERTY[250][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property251-<?=$snKol;?>" name="PROPERTY[251][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["251"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if($arResult["ELEMENT_PROPERTIES"]["152"]["0"]["VALUE_ENUM"] == "Да"):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Ручная подготовка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["244"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property243-<?=$snKol;?>" name="PROPERTY[243][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["243"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input  onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["243"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["243"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-243-<?=$snKol;?>" id="property-243-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["208"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из смывки" data-position="top"<?endif;?> for="property-243-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property244-<?=$snKol;?>" name="PROPERTY[244][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["244"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property245-<?=$snKol;?>" name="PROPERTY[245][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["245"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>
	<?if(in_array('полка', $bl2)):?>
		<div class="col s3" id="b<?=$in++;?>"> 
			<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/24b/3561970_9.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
				<div class="card-image teal white-text" style="padding:5px;">
					<h6 class="box-title">Полировка полки диска: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["253"]["NAME"],"тор "),4);?> руб.</h6>
				</div>
				<?foreach($kolesa as $snKol):?>
					<?if($snKol < $koles):?>
						<input hidden type="text" class="property252-<?=$snKol;?>" name="PROPERTY[252][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["252"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["252"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["253"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["254"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["252"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["252"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-252-<?=$snKol;?>" id="property-252-<?=$snKol;?>">
						<?endif;?>
						<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из грубых" data-position="top"<?endif;?> for="property-252-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property253-<?=$snKol;?>" name="PROPERTY[253][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["253"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property254-<?=$snKol;?>" name="PROPERTY[254][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["254"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endforeach;?>
				<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
			</div>
		</div>   
	<?endif;?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Загружены в средние: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["256"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property255-<?=$snKol;?>" name="PROPERTY[255][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["255"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["255"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["257"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["255"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["255"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-255-<?=$snKol;?>" id="property-255-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["250"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из грубых" data-position="top"<?endif;?> for="property-255-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property256-<?=$snKol;?>" name="PROPERTY[256][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property257-<?=$snKol;?>" name="PROPERTY[257][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["257"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Вышли из средних: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["286"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property285-<?=$snKol;?>" name="PROPERTY[285][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["285"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["285"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["287"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["285"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["285"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-285-<?=$snKol;?>" id="property-285-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["256"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо загрузить в средние" data-position="top"<?endif;?> for="property-285-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property286-<?=$snKol;?>" name="PROPERTY[286][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property287-<?=$snKol;?>" name="PROPERTY[287][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["287"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>   
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Загружены в финишные: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["259"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property258-<?=$snKol;?>" name="PROPERTY[258][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["258"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["258"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["260"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["258"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["258"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-258-<?=$snKol;?>" id="property-258-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["286"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо достать из средних" data-position="top"<?endif;?> for="property-258-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property259-<?=$snKol;?>" name="PROPERTY[259][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property260-<?=$snKol;?>" name="PROPERTY[260][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["260"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>  
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/dab/22322.jpg);background-position: -53px 42px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Вышли из финишных: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["262"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property261-<?=$snKol;?>" name="PROPERTY[261][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["261"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["261"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["263"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["261"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["261"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-261-<?=$snKol;?>" id="property-261-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["259"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо загрузить в финишные" data-position="top"<?endif;?> for="property-261-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property262-<?=$snKol;?>" name="PROPERTY[262][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property263-<?=$snKol;?>" name="PROPERTY[263][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["263"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(empty($arResult["ELEMENT_PROPERTIES"]["132"]["0"]["VALUE"])):?><?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/1fe/69557_big.jpg);background-position: -118px 20px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Маскировка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["265"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property264-<?=$snKol;?>" name="PROPERTY[264][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["264"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["264"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["266"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["264"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["264"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-264-<?=$snKol;?>" id="property-264-<?=$snKol;?>"><?endif;?><label for="property-264-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property265-<?=$snKol;?>" name="PROPERTY[265][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property266-<?=$snKol;?>" name="PROPERTY[266][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["266"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"])):?><?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/ee8/12.jpg);background-position: -190px 44px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Хроматирование: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["268"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property267-<?=$snKol;?>" name="PROPERTY[267][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["267"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["267"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["268"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["269"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["267"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["267"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-267-<?=$snKol;?>" id="property-267-<?=$snKol;?>"><?endif;?><label for="property-267-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property268-<?=$snKol;?>" name="PROPERTY[268][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["268"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property269-<?=$snKol;?>" name="PROPERTY[269][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["269"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/e86/pic-1.jpg);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Грунтовка: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["271"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property270-<?=$snKol;?>" name="PROPERTY[270][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["270"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["270"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["272"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["270"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["270"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-270-<?=$snKol;?>" id="property-270-<?=$snKol;?>"><?endif;?><label for="property-270-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property271-<?=$snKol;?>" name="PROPERTY[271][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property272-<?=$snKol;?>" name="PROPERTY[272][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["272"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/38e/podlinnaya_3_m_nazhdachnaya_bumaga_401q_ace_avtomobilnaya_kraska_spetsialnyy_nazhdachnaya_bumaga_1500_vody_nazhdachnaya_bumaga.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Шлифовка грунта: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["274"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property273-<?=$snKol;?>" name="PROPERTY[273][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["273"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["273"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["275"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["273"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["273"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-273-<?=$snKol;?>" id="property-273-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["271"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить грунтовку" data-position="top"<?endif;?> for="property-273-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property274-<?=$snKol;?>" name="PROPERTY[274][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property275-<?=$snKol;?>" name="PROPERTY[275][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["275"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
	<?if(in_array('колпачки', $bl2) || in_array('отполировать',$klp2)):?>
		<div id="b<?=$in++;?>" class="col s3 hidde" >
			<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
				<div class="card-image teal white-text" style="padding:5px;">
					<h6 class="box-title">Полировка колпачков: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["330"]["NAME"],"тор "),4);?> руб.</h6>
				</div>
				<?foreach($kolesa as $snKol):?>
					<?if($snKol < $koles):?>
						<input hidden type="text" class="property329-<?=$snKol;?>" name="PROPERTY[329][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["329"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["329"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["330"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["330"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["329"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["329"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-329-<?=$snKol;?>" id="property-329-<?=$snKol;?>"><?endif;?><label for="property-329-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property330-<?=$snKol;?>" name="PROPERTY[330][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["330"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property331-<?=$snKol;?>" name="PROPERTY[331][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["331"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>

<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) or !empty($arResult["ELEMENT_PROPERTIES"]["358"]["0"]["VALUE"])):?>
	<?if(in_array('колпачки', $br2) or in_array('покрасить',$klp2)):?>
		<div id="b<?=$in++;?>" class="col s3 hidde" >
			<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
				<div class="card-image teal white-text" style="padding:5px;">
					<h6 class="box-title">Покраска колпачков <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["327"]["NAME"],"тор "),4);?> руб.</h6>
				</div>
				<?foreach($kolesa as $snKol):?>
					<?if($snKol < $koles):?>
						<input hidden type="text" class="property326-<?=$snKol;?>" name="PROPERTY[326][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["326"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["326"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["327"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["327"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["326"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["326"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-326-<?=$snKol;?>" id="property-326-<?=$snKol;?>"><?endif;?><label for="property-326-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property327-<?=$snKol;?>" name="PROPERTY[327][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["327"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property328-<?=$snKol;?>" name="PROPERTY[328][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["328"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>
<?if(in_array('нанести лого',$klp2) or in_array('нанести лого',$br2)):?>
			<?if(in_array('нанести лого',$klp2)):?><?$perem_kol = $kol_kolp;?><?else:?><?$perem_kol = $koles;?><?endif;?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/32d/remont_litix_diskov.jpg);background-position: -127px 21px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Нанести лого: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["363"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $perem_kol):?>
					<input hidden type="text" class="property362-<?=$snKol;?>" name="PROPERTY[362][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["362"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["362"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["363"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["364"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["362"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["362"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-362-<?=$snKol;?>" id="property-362-<?=$snKol;?>">
					<?endif;?>
					<label for="property-362-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property363-<?=$snKol;?>" name="PROPERTY[363][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["363"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property364-<?=$snKol;?>" name="PROPERTY[364][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["364"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"])):?><?else:?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/da8/price_wheels.2.png);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Покраска:<div class="chip"><?=$arResult["ELEMENT_PROPERTIES"]["129"]["0"]["VALUE"]?></div> <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["277"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property276-<?=$snKol;?>" name="PROPERTY[276][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["276"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["276"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["278"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["276"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["276"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-276-<?=$snKol;?>" id="property-276-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["274"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить шлифовку грунта" data-position="top"<?endif;?> for="property-276-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property277-<?=$snKol;?>" name="PROPERTY[277][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property278-<?=$snKol;?>" name="PROPERTY[278][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["278"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	<?endif;?>
	<?if(!empty($arResult["ELEMENT_PROPERTIES"]["190"]["0"]["VALUE"])):?>
		<div class="col s3" id="b<?=$in++;?>"> 
			<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/eb3/diski_y.png);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
				<div class="card-image teal white-text" style="padding:5px;">
					<h6 class="box-title">Покраска 2 цвет:<div class="chip"><?=$arResult["ELEMENT_PROPERTIES"]["190"]["0"]["VALUE"]?></div> <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["280"]["NAME"],"тор "),4);?> руб.</h6>
				</div>
				<?foreach($kolesa as $snKol):?>
					<?if($snKol < $koles):?>
						<input hidden type="text" class="property279-<?=$snKol;?>" name="PROPERTY[279][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["279"][$snKol]["VALUE"]?>">
						<?if(!empty($arResult["ELEMENT_PROPERTIES"]["279"][$snKol]["VALUE"])):?>
							<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["280"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["281"][$snKol]["VALUE"]?></span>
						<?else:?>
							<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["279"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["279"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-279-<?=$snKol;?>" id="property-279-<?=$snKol;?>">
						<?endif;?>
						<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["265"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо выполнить маскировку" data-position="top"<?endif;?> for="property-279-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
						<input hidden type="text" class="property280-<?=$snKol;?>" name="PROPERTY[280][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["280"][$snKol]["VALUE"]?>">
						<input hidden type="text" class="property281-<?=$snKol;?>" name="PROPERTY[281][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["281"][$snKol]["VALUE"]?>">
					<?endif;?>
				<?endforeach;?>
				<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
			</div>
		</div>
	<?endif;?>
<?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["131"]["0"]["VALUE"]) or !empty($arResult["ELEMENT_PROPERTIES"]["153"]["0"]["VALUE"])):?>

	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/868/prozrachnyiy_steklyannyiy_shar_smotrovuyu_ploschadku_timesunioncom_101.jpg);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Подготовка к лаку: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["380"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property379-<?=$snKol;?>" name="PROPERTY[379][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["379"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["379"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["380"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["381"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?> <?endif;?><?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["379"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["379"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-379-<?=$snKol;?>" id="property-379-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо покрасить или достать из финишных" data-position="top"<?endif;?><?endif;?> for="property-379-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property380-<?=$snKol;?>" name="PROPERTY[380][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["380"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property381-<?=$snKol;?>" name="PROPERTY[381][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["381"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
	
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/868/prozrachnyiy_steklyannyiy_shar_smotrovuyu_ploschadku_timesunioncom_101.jpg);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Покрытие лаком: <div class="chip"><?=$arResult["ELEMENT_PROPERTIES"]["130"]["0"]["VALUE_ENUM"];?> <?=$arResult["ELEMENT_PROPERTIES"]["134"]["0"]["VALUE_ENUM"];?> <?=$arResult["ELEMENT_PROPERTIES"]["304"]["0"]["VALUE"]?> <?=$arResult["ELEMENT_PROPERTIES"]["305"]["0"]["VALUE"]?></div> <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["283"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property282-<?=$snKol;?>" name="PROPERTY[282][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["282"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["282"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["283"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["284"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?> <?endif;?><?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["282"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["282"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-282-<?=$snKol;?>" id="property-282-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо покрасить или достать из финишных" data-position="top"<?endif;?><?endif;?> for="property-282-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property283-<?=$snKol;?>" name="PROPERTY[283][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["283"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property284-<?=$snKol;?>" name="PROPERTY[284][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["284"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?else:?>
<?endif;?>
<?if($arResult["ELEMENT_PROPERTIES"]["378"]["0"]["VALUE_ENUM"] == "Да"):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/868/prozrachnyiy_steklyannyiy_shar_smotrovuyu_ploschadku_timesunioncom_101.jpg);background-position: -125px 27px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Покрытие вторым лаком:  <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["336"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property335-<?=$snKol;?>" name="PROPERTY[335][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["282"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["335"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["336"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["337"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?> <?endif;?><?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["335"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["335"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-335-<?=$snKol;?>" id="property-335-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["277"][$snKol]["VALUE"])):?><?else:?><?if(isset($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["262"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо покрасить или достать из финишных" data-position="top"<?endif;?><?endif;?> for="property-335-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property336-<?=$snKol;?>" name="PROPERTY[336][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["336"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property337-<?=$snKol;?>" name="PROPERTY[337][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["337"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(!empty($arResult["ELEMENT_PROPERTIES"]["146"]["0"]["VALUE"])):?>
	<div class="col s3" id="b<?=$in++;?>"> 
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/4b0/251112_4.png);background-position: -163px 26px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Сборка дисков: <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["241"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
				<?if($snKol < $koles):?>
					<input hidden type="text" class="property240-<?=$snKol;?>" name="PROPERTY[240][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["240"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["240"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["241"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["242"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input <?if(isset($arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"])):?><?else:?> <?endif;?> onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["240"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["240"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-240-<?=$snKol;?>" id="property-240-<?=$snKol;?>">
					<?endif;?>
					<label <?if(isset($arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"]) and !empty($arResult["ELEMENT_PROPERTIES"]["238"][$snKol]["VALUE"])):?><?else:?>class="tooltipped" data-tooltip="Необходимо разобрать диски" data-position="top"<?endif;?> for="property-240-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property241-<?=$snKol;?>" name="PROPERTY[241][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["241"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property242-<?=$snKol;?>" name="PROPERTY[242][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["242"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
			<p style="bottom: 0;position: absolute;color: red;padding:5px;text-align:center;"><?=$fotonet;?></p>
		</div>
	</div>
<?endif;?>
<?if(in_array('монтаж', $bg2) or in_array('комплекс', $bg2)):?>
	<div class="col s3" id="b<?=$in++;?>">
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Монтаж колес <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["217"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
			<?if($shkoles <= 0):?>
				<?if($snKol < $arResult["ELEMENT_PROPERTIES"]["342"]["0"]["VALUE"]):?>
					<input hidden type="text" class="property216-<?=$snKol;?>" name="PROPERTY[216][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["216"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["216"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["217"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["218"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["216"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["216"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-216-<?=$snKol;?>" id="property-216-<?=$snKol;?>"><?endif;?><label for="property-216-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property217-<?=$snKol;?>" name="PROPERTY[217][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["217"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property218-<?=$snKol;?>" name="PROPERTY[218][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["218"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?else:?>
				<?if($snKol < $shkoles):?>
					<input hidden type="text" class="property216-<?=$snKol;?>" name="PROPERTY[216][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["216"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["216"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["217"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["218"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["216"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["216"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-216-<?=$snKol;?>" id="property-216-<?=$snKol;?>"><?endif;?><label for="property-216-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property217-<?=$snKol;?>" name="PROPERTY[217][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["217"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property218-<?=$snKol;?>" name="PROPERTY[218][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["218"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?if(in_array('балансировка', $bg2) or in_array('комплекс', $bg2)):?>
	<div id="b<?=$in++;?>" class="col s3" >
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Балансировка колес <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["220"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
			<?if($shkoles <= 0):?>
				<?if($snKol < $arResult["ELEMENT_PROPERTIES"]["343"]["0"]["VALUE"]):?>
					<input hidden type="text" class="property219-<?=$snKol;?>" name="PROPERTY[219][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["219"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["219"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["220"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["221"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input  onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["219"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["219"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-219-<?=$snKol;?>" id="property-219-<?=$snKol;?>">
					<?endif;?>
					<label for="property-219-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property220-<?=$snKol;?>" name="PROPERTY[220][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["220"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property221-<?=$snKol;?>" name="PROPERTY[221][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["221"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?else:?>
				<?if($snKol < $shkoles):?>
					<input hidden type="text" class="property219-<?=$snKol;?>" name="PROPERTY[219][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["219"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["219"][$snKol]["VALUE"])):?>
						<span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["220"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["221"][$snKol]["VALUE"]?></span>
					<?else:?>
						<p style="text-align:center; margin-bottom:-15px;"><input  onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["219"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["219"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-219-<?=$snKol;?>" id="property-219-<?=$snKol;?>">
					<?endif;?>
					<label for="property-219-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property220-<?=$snKol;?>" name="PROPERTY[220][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["220"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property221-<?=$snKol;?>" name="PROPERTY[221][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["221"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<?if(in_array('установка', $bg2) or in_array('комплекс', $bg2)):?>
	<div id="b<?=$in++;?>" class="col s3" >
		<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
			<div class="card-image teal white-text" style="padding:5px;">
				<h6 class="box-title">Установка колес <?=substr(stristr($arResult["PROPERTY_LIST_FULL"]["223"]["NAME"],"тор "),4);?> руб.</h6>
			</div>
			<?foreach($kolesa as $snKol):?>
			<?if($shkoles <= 0):?>
				<?if($snKol < $arResult["ELEMENT_PROPERTIES"]["344"]["0"]["VALUE"]):?>
					<input hidden type="text" class="property222-<?=$snKol;?>" name="PROPERTY[222][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["222"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["222"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["223"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["224"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["222"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["222"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-222-<?=$snKol;?>" id="property-222-<?=$snKol;?>"><?endif;?><label for="property-222-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property223-<?=$snKol;?>" name="PROPERTY[223][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["223"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property224-<?=$snKol;?>" name="PROPERTY[224][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["224"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endif;?>
				<?if($snKol < $shkoles):?>
					<input hidden type="text" class="property222-<?=$snKol;?>" name="PROPERTY[222][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["222"][$snKol]["VALUE"]?>">
					<?if(!empty($arResult["ELEMENT_PROPERTIES"]["222"][$snKol]["VALUE"])):?><span style="color:green;"><?=$arResult["ELEMENT_PROPERTIES"]["223"][$snKol]["VALUE"]?></span><span style="font-size: 9px;margin: 15px -9px;position: absolute;color: red;"><?=$arResult["ELEMENT_PROPERTIES"]["224"][$snKol]["VALUE"]?></span><?else:?><p style="text-align:center; margin-bottom:-15px;"><input onchange="if (this.checked) {Materialize.toast('<?=$arResult["PROPERTY_LIST_FULL"]["222"]["NAME"]?> отмечена для <?=$snKol+1;?> диска', 4000)} else {Materialize.toast('Отменена <?=mb_strtolower($arResult["PROPERTY_LIST_FULL"]["222"]["NAME"])?> для <?=$snKol+1;?> диска', 4000)}" type="checkbox" class="property-222-<?=$snKol;?>" id="property-222-<?=$snKol;?>"><?endif;?><label for="property-222-<?=$snKol;?>"> <?=$snKol+1;?> диск</label></p>
					<input hidden type="text" class="property223-<?=$snKol;?>" name="PROPERTY[223][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["223"][$snKol]["VALUE"]?>">
					<input hidden type="text" class="property224-<?=$snKol;?>" name="PROPERTY[224][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["224"][$snKol]["VALUE"]?>">
				<?endif;?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
<div id="b<?=$in++;?>" class="col s3" >
	<div class="card hoverable" style="height: 280px;;;text-align:center;background-image: url(/upload/medialibrary/a9f/monty_1000.png);background-position: -19px 10px;background-repeat: no-repeat;background-size: contain;">
		<div class="card-image teal white-text" style="padding:5px;">
			<h6 class="box-title">Прочее (любая другая работа) </h6>
		</div>
		<?$bb = 0;?>
		<?$bc = 0;?>
		<?$bd = 0;?>
		<?foreach($kolesa as $snKol):?>
			<?if($snKol < 8):?>
				<div class="col s2"><?=$snkol++;?></div><div class="col s10">

		<input <?if(!empty($arResult["ELEMENT_PROPERTIES"]["323"][$snKol]["VALUE"])):?>readonly<?else:?>data-cell="LL<?=$bb++;?>"<?endif;?>  type="text" class="property323-<?=$snKol;?>" name="PROPERTY[323][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["323"][$snKol]["VALUE"]?>"><?endif;?><span><?=$arResult["ELEMENT_PROPERTIES"]["324"][$snKol]["VALUE"];?></span></div>
					<input  <?if(empty($arResult["ELEMENT_PROPERTIES"]["323"][$snKol]["VALUE"])):?>data-formula="IF(LL<?=$bc++;?><>0,UP1,0)"<?endif;?> hidden type="text" class="property324-<?=$snKol;?>" name="PROPERTY[324][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["324"][$snKol]["VALUE"]?>">
					<input  <?if(empty($arResult["ELEMENT_PROPERTIES"]["323"][$snKol]["VALUE"])):?>data-formula="IF(LL<?=$bd++;?><>0,TN1,0)"<?endif;?> hidden type="text" class="property325-<?=$snKol;?>" name="PROPERTY[325][<?=$snKol;?>]" size="25" value="<?=$arResult["ELEMENT_PROPERTIES"]["325"][$snKol]["VALUE"]?>">

		<?endforeach;?>
	</div>
</div>
</div>


</div>

<input class="btn" type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input class="btn" type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input class="btn"
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>"
						>
					<?endif?>
</div>
</form>


<div style="clear:both"></div>

<?$mas = array (201,204,207,210,213,216,219,222,225,228,231,234,237,240,243,246,249,252,255,258,261,264,267,270,273,276,279,282,285,326,329,332,359,362,365,335,379);?>
<?$k1 = 0; ?>

<?foreach ($mas as $rkey):?>
<script>
$('.property-<?=$rkey?>-0').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-0').val('Да');
        $('.property<?=$rkey+1?>-0').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-0').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-0').val('');
        $('.property<?=$rkey+1?>-0').val('');
		$('.property<?=$rkey+2?>-0').val('');
    }
});
$('.property-<?=$rkey?>-1').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-1').val('Да');
        $('.property<?=$rkey+1?>-1').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-1').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-1').val('');
        $('.property<?=$rkey+1?>-1').val('');
		$('.property<?=$rkey+2?>-1').val('');
    }
});
$('.property-<?=$rkey?>-2').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-2').val('Да');
        $('.property<?=$rkey+1?>-2').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-2').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-2').val('');
        $('.property<?=$rkey+1?>-2').val('');
		$('.property<?=$rkey+2?>-2').val('');
    }
});
$('.property-<?=$rkey?>-3').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-3').val('Да');
        $('.property<?=$rkey+1?>-3').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-3').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-3').val('');
        $('.property<?=$rkey+1?>-3').val('');
		$('.property<?=$rkey+2?>-3').val('');
    }
});
$('.property-<?=$rkey?>-4').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-4').val('Да');
        $('.property<?=$rkey+1?>-4').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-4').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-4').val('');
        $('.property<?=$rkey+1?>-4').val('');
		$('.property<?=$rkey+2?>-4').val('');
    }
});
$('.property-<?=$rkey?>-5').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-5').val('Да');
        $('.property<?=$rkey+1?>-5').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-5').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-5').val('');
        $('.property<?=$rkey+1?>-5').val('');
		$('.property<?=$rkey+2?>-5').val('');
    }
});
$('.property-<?=$rkey?>-6').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-6').val('Да');
        $('.property<?=$rkey+1?>-6').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-6').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-6').val('');
        $('.property<?=$rkey+1?>-6').val('');
		$('.property<?=$rkey+2?>-6').val('');
    }
});
$('.property-<?=$rkey?>-7').change(function(){
    if($(this).is(":checked")) {
        $('.property<?=$rkey?>-7').val('Да');
        $('.property<?=$rkey+1?>-7').val($('.name_photot').text());
		$('.property<?=$rkey+2?>-7').val($('#seychas').text());
    } else {
        $('.property<?=$rkey?>-7').val('');
        $('.property<?=$rkey+1?>-7').val('');
		$('.property<?=$rkey+2?>-7').val('');
    }
});
</script> 

<?endforeach;?>  
<script src="/bitrix/js/jquery-calx-2.2.5.min.js" type="text/javascript"></script>
<script src="/bitrix/js/numeral.min.js" type="text/javascript"></script>
<script>
$( document ).ready(function ()
{
	$('#calx1').calx(); 
	});
</script>


