<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])):?>

	<table class="title-search-result">
<?$b = 0;?> <?$d = 0;?>
		<colgroup>

			<col width="150px">
			<col width="*">
		</colgroup>
		<tbody>
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<tr>
					<th class="title-search-separator">&nbsp;</th>
					<td class="title-search-separator">&nbsp;</td>
				</tr>

				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				<tr>
					<?if($i == 0):?>
						<th>&nbsp;Выберите клиента</th>
					<?else:?>
						<th>&nbsp;</th>
					<?endif?>

<? $db_props = CIBlockElement::GetProperty($arItem["PARAM2"], $arItem["ITEM_ID"], "sort", "asc", array()); 
$PROPS = array(); 
while($ar_props = $db_props->Fetch()) 
$PROPS[$ar_props['CODE']] = $ar_props['VALUE'];?>


					<?if($category_id === "all"):?>
						<td class="title-search-all"><?echo $arItem["NAME"]?> </td>
					<?elseif(isset($arItem["ICON"])):?>
					<td class="title-search-item nf<?=$d++;?>" style="font-size:11px;">
<?if(!CModule::IncludeModule("iblock"))

return;?> 

<?
$res = CIBlockElement::GetByID($PROPS["COMP"]);
if($ar_res = $res->GetNext())

?>
<script>

$('.nf<?=$b++;?>').click(function(){
    $('#telform').val('<?=$PROPS["TEL"];?>');
    $('#fiof').val('<?if(empty($PROPS["FIO"])):?><?=strip_tags($arItem["NAME"])?><?else:?><?=$PROPS["FIO"];?><?endif;?>');

	$('#partnerf').val('<?if(!empty($PROPS["COMPANY"])):?><?=$PROPS["COMPANY"];?><?else:?><?=$ar_res["NAME"];?><?endif;?>');
	$('#dkart').val('<?=$PROPS["DK"];?>');
	$('#emailf').val('<?=$PROPS["EMAIL"];?>');
	$('#tekskid').text('<?if(!empty($PROPS["SKIDKA"])):?>Текущая скидка: <?endif;?><?=$PROPS["SKIDKA"];?><?if(!empty($PROPS["COMPANY"])):?>от 20% до 25%<?endif;?>');
	$('#SZ1').val('<?=$PROPS["KORDER"];?>');
	$('#SZ2').val('<?=$PROPS["SORDER"];?>');
});


</script>


						<?if(!empty($PROPS["COMPANY"])):?>Компания: <b><?=$PROPS["COMPANY"];?></b><br><?else:?>Компания: <b><?=$ar_res['NAME'];?></b><br><?endif;?>ФИО: <?if(empty($PROPS["FIO"])):?><?=$arItem["NAME"]?><?else:?><?=$PROPS["FIO"];?><?endif;?><br>Тел: <b><?=$PROPS["TEL"];?></b><br><?if(!empty($PROPS["DK"])):?>ДК: <b><?=$PROPS["DK"];?></b><?if(!empty($PROPS["SKIDKA"])):?>-<?=$PROPS["SKIDKA"];?><?endif;?> <?endif;?></td>
					<?else:?>
						<td class="title-search-more"><?echo $arItem["NAME"]?> </td>
					<?endif;?>
				</tr>
				<?endforeach;?>
			<?endforeach;?>
			<tr>
				<th class="title-search-separator">&nbsp;</th>
				<td class="title-search-separator">&nbsp;</td>
			</tr>
		</tbody>
	</table>
<?endif;

?>
