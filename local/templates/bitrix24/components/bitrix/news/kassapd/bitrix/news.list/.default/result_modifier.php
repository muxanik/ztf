<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?foreach($arResult['ITEMS'] as $key => $arItem):?>
<?$d= 0;?>

<?if(!empty($arItem["PROPERTIES"]["DDOPL"]["VALUE"])):?>
<?array_push($arResult['ITEMS'], array("ID"=>$d++,"NAME"=>$arItem["NAME"],"DISPLAY_ACTIVE_FROM"=>date("d.m.Y",strtotime($arItem["PROPERTIES"]["DDOPL"]["VALUE"])),"ACTIVE_FROM"=>$arItem["PROPERTIES"]["DDOPL"]["VALUE"],"PROPERIES"=>array("DOPL"=>array("VALUE"=>$arItem["PROPERTIES"]["DOPL"]["VALUE"]))));?>
<?endif;?>
<?$arItem["ACTIVE_FROM"] = $arItem["PROPERTIES"]["DPREDO"]["VALUE"];?>
<?$arItem["DISPLAY_ACTIVE_FROM"] = date("d.m.Y",strtotime($arItem["PROPERTIES"]["DPREDO"]["VALUE"]));?>
<?endforeach;?>