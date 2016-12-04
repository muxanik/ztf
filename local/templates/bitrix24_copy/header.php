<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($_GET["RELOAD"]) && $_GET["RELOAD"] == "Y")
{
	return; //Live Feed Ajax
}
else if (strpos($_SERVER["REQUEST_URI"], "/historyget/") > 0)
{
	return;
}
else if (isset($_GET["IFRAME"]) && $_GET["IFRAME"] == "Y" && !isset($_GET["SONET"]))
{
	//For the task iframe popup
	$APPLICATION->SetPageProperty("BodyClass", "task-iframe-popup");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/interface.css", true);
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bitrix24.js", true);
	return;
}

CModule::IncludeModule("intranet");

$APPLICATION->GroupModuleJS("im","pull");
$APPLICATION->GroupModuleJS("timeman","pull");
$APPLICATION->GroupModuleJS("webrtc","pull");
$APPLICATION->GroupModuleCSS("im","pull");
$APPLICATION->GroupModuleCSS("timeman","pull");
$APPLICATION->GroupModuleCSS("webrtc","pull");
$APPLICATION->MoveJSToBody("pull");
$APPLICATION->MoveJSToBody("timeman");
$APPLICATION->SetUniqueJS('bx24', 'template');
$APPLICATION->SetUniqueCSS('bx24', 'template');

$isCompositeMode = defined("USE_HTML_STATIC_CACHE");
$isIndexPage = $APPLICATION->GetCurPage(true) == SITE_DIR."index.php";

if ($isCompositeMode && $isIndexPage)
{
	define("BITRIX24_INDEX_COMPOSITE", true);
}

if ($isCompositeMode)
{
	$APPLICATION->SetAdditionalCSS("/bitrix/js/intranet/intranet-common.css");
}

function showJsTitle()
{
	$GLOBALS["APPLICATION"]->AddBufferContent("getJsTitle");
}

function getJsTitle()
{
	$title = $GLOBALS["APPLICATION"]->GetTitle("title", true);
	$title = html_entity_decode($title, ENT_QUOTES, SITE_CHARSET);
	$title = CUtil::JSEscape($title);
	return $title;
}

$isDiskEnabled = \Bitrix\Main\Config\Option::get('disk', 'successfully_converted', false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?\Bitrix\Main\Localization\Loc::loadMessages($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?if (IsModuleInstalled("bitrix24")):?>
<meta name="apple-itunes-app" content="app-id=561683423" />
<link rel="apple-touch-icon-precomposed" href="/images/iphone/57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/iphone/72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/iphone/114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/iphone/144x144.png" />
<?endif;

$APPLICATION->ShowHead();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/interface.css", true);
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bitrix24.js", true);
?><title><? if (!$isCompositeMode || $isIndexPage) $APPLICATION->ShowTitle()?></title>
</head>

<body class="template-bitrix24">
<?
if ($isCompositeMode && !$isIndexPage)
{
	$frame = new \Bitrix\Main\Page\FrameStatic("title");
	$frame->startDynamicArea();
	?><script type="text/javascript">document.title = "<?showJsTitle()?>";</script><?
	$frame->finishDynamicArea();
}

$profile_link = (CModule::IncludeModule("extranet") && SITE_ID == CExtranet::GetExtranetSiteID()) ? SITE_DIR."contacts/personal" : SITE_DIR."company/personal";
?>
<table class="bx-layout-table">
	<tr>
		<td class="bx-layout-header">
			<?
			if ((!IsModuleInstalled("bitrix24") || $USER->IsAdmin()) && !defined("SKIP_SHOW_PANEL"))
				$APPLICATION->ShowPanel();
			?>
			<div id="header">
				<div id="header-inner">
					<?
					//This component is used for menu-create-but.
					//We have to include the component before bitrix:timeman for composite mode.
					if (CModule::IncludeModule('tasks') && CBXFeatures::IsFeatureEnabled('Tasks')):
						$APPLICATION->IncludeComponent(
							"bitrix:tasks.iframe.popup",
							".default",
							array(
								"ON_TASK_ADDED" => "#SHOW_ADDED_TASK_DETAIL#",
								"ON_TASK_CHANGED" => "BX.DoNothing",
								"ON_TASK_DELETED" => "BX.DoNothing"
							),
							null,
							array("HIDE_ICONS" => "Y")
						);
					endif;

					if (!CModule::IncludeModule("extranet") || CExtranet::GetExtranetSiteID() != SITE_ID)
					{
						if (!IsModuleInstalled("timeman") ||
							!$APPLICATION->IncludeComponent('bitrix:timeman', 'bitrix24', array(), false, array("HIDE_ICONS" => "Y" ))
						)
						{
							$APPLICATION->IncludeComponent('bitrix:planner', 'bitrix24', array(), false, array("HIDE_ICONS" => "Y" ));
						}
					}
					else
					{
						CJSCore::Init("timer");?>
						<div class="timeman-wrap">
							<span id="timeman-block" class="timeman-block">
								<span class="bx-time" id="timeman-timer"></span>
							</span>
						</div>
						<script type="text/javascript">BX.ready(function() {
							BX.timer.registerFormat("bitrix24_time", B24.Timemanager.formatCurrentTime);
							BX.timer({
								container: BX("timeman-timer"),
								display : "bitrix24_time"
							});
						});</script>
					<?
					}
					?>
					<!--suppress CheckValidXmlInScriptTagBody -->
					<script type="text/javascript" data-skip-moving="true">
						(function() {
							var isAmPmMode = <?=(IsAmPmMode() ? "true" : "false") ?>;
							var time = document.getElementById("timeman-timer");
							var hours = new Date().getHours();
							var minutes = new Date().getMinutes();
							if (time)
							{
								time.innerHTML = formatTime(hours, minutes, 0, isAmPmMode);
							}
							else if (document.addEventListener)
							{
								document.addEventListener("DOMContentLoaded", function() {
									time.innerHTML = formatTime(hours, minutes, 0, isAmPmMode);
								});
							}

							function formatTime(hours, minutes, seconds, isAmPmMode)
							{
								var ampm = "";
								if (isAmPmMode)
								{

									ampm = hours >= 12 ? "PM" : "AM";
									ampm = '<span class="time-am-pm">' + ampm + '</span>';
									hours = hours % 12;
									hours = hours ? hours : 12;
								}
								else
								{
									hours = hours < 10 ? "0" + hours : hours;
								}

								return	'<span class="time-hours">' + hours + '</span>' + '<span class="time-semicolon">:</span>' +
									'<span class="time-minutes">' + (minutes < 10 ? "0" + minutes : minutes) + '</span>' + ampm;
							}
						})();
					</script>
					<div class="header-logo-block">
						<span class="header-logo-block-util"></span>
						<?if (IsModuleInstalled("bitrix24")):?>
							<a id="logo_24_a" href="<?=SITE_DIR?>" title="<?=GetMessage("BITRIX24_LOGO_TOOLTIP")?>" class="logo"><?
								$clientLogo = COption::GetOptionInt("bitrix24", "client_logo", "");?>
								<span id="logo_24_text" <?if ($clientLogo):?>style="display:none"<?endif?>>
									<span class="logo-text"><?=htmlspecialcharsbx(COption::GetOptionString("bitrix24", "site_title", ""))?></span><?
									if(COption::GetOptionString("bitrix24", "logo24show", "Y") !=="N"):?><span class="logo-color">24</span><?endif?>
								</span>
								<img id="logo_24_img" src="<?if ($clientLogo) echo CFile::GetPath($clientLogo)?>" <?if (!$clientLogo):?>style="display:none;"<?endif?>/>
							</a>
						<?else:?>
							<?
							$logoID = COption::GetOptionString("main", "wizard_site_logo", "", SITE_ID);
							?>
							<a id="logo_24_a" href="<?=SITE_DIR?>" title="<?=GetMessage("BITRIX24_LOGO_TOOLTIP")?>" class="logo">
								<?if ($logoID):?>
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/company_name.php"), false);?>
								<?else:?>
									<span id="logo_24_text">
										<span class="logo-text"><?=htmlspecialcharsbx(COption::GetOptionString("main", "site_name", ""));?></span>
										<span class="logo-color">24</span>
									</span>
								<?endif?>
							</a>
						<?endif?>
						<?
						$GLOBALS["LEFT_MENU_COUNTERS"] = array();
						if (CModule::IncludeModule("im") && CBXFeatures::IsFeatureEnabled('WebMessenger'))
						{
							$APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array(
								"PATH_TO_SONET_EXTMAIL" => SITE_DIR."company/personal/mail/"
							), false, Array("HIDE_ICONS" => "Y"));
						} ?>
					</div>

					<?$APPLICATION->IncludeComponent("bitrix:search.title", ".default", Array(
						"NUM_CATEGORIES" => "5",
						"TOP_COUNT" => "5",
						"CHECK_DATES" => "N",
						"SHOW_OTHERS" => "Y",
						"PAGE" => "#SITE_DIR#search/index.php",
						"CATEGORY_0_TITLE" => GetMessage("BITRIX24_SEARCH_EMPLOYEE"),
						"CATEGORY_0" => array(
							0 => "intranet",
						),
						"CATEGORY_1_TITLE" => GetMessage("BITRIX24_SEARCH_DOCUMENT"),
						"CATEGORY_1" => array(
							0 => "iblock_library",
						),
						"CATEGORY_1_iblock_library" => array(
							0 => "all",
						),
						"CATEGORY_2_TITLE" => GetMessage("BITRIX24_SEARCH_GROUP"),
						"CATEGORY_2" => array(
							0 => "socialnetwork",
						),
						"CATEGORY_2_socialnetwork" => array(
							0 => "all",
						),
						"CATEGORY_3_TITLE" => GetMessage("BITRIX24_SEARCH_MICROBLOG"),
						"CATEGORY_3" => array(
							0 => "microblog", 1 => "blog",
						),
						"CATEGORY_4_TITLE" => "CRM",
						"CATEGORY_4" => array(
							0 => "crm",
						),
						"CATEGORY_OTHERS_TITLE" => GetMessage("BITRIX24_SEARCH_OTHER"),
						"SHOW_INPUT" => "N",
						"INPUT_ID" => "search-textbox-input",
						"CONTAINER_ID" => "search",
						"USE_LANGUAGE_GUESS" => (LANGUAGE_ID == "ru") ? "Y" : "N"
						),
						false
					);?>

					<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "", array(
						"PATH_TO_SONET_PROFILE" => $profile_link."/user/#user_id#/",
						"PATH_TO_SONET_PROFILE_EDIT" => $profile_link."/user/#user_id#/edit/",
						"PATH_TO_SONET_EXTMAIL_SETUP" => $profile_link."/mail/?page=home",
						"PATH_TO_SONET_EXTMAIL_MANAGE" => $profile_link."/mail/?page=manage"
						),
						false
					);?>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td class="bx-layout-cont">
			<table class="bx-layout-inner-table">
	
				<tr class="bx-layout-inner-top-row">
					
					<td class="bx-layout-inner-center" id="content-table">
	

						<table class="bx-layout-inner-inner-table ">
	
							<tr>
								<td class="bx-layout-inner-inner-cont">
									<?$APPLICATION->ShowViewContent("above_pagetitle")?>
									<div class="pagetitle-wrap">
										<div class="pagetitle-menu" id="pagetitle-menu"><?$APPLICATION->ShowViewContent("pagetitle")?></div>
										<h1 class="pagetitle" id="pagetitle"><span class="pagetitle-inner"><?$APPLICATION->ShowTitle(false);?></span></h1>
										<div class="pagetitle-content-topEnd">
											<div class="pagetitle-content-topEnd-corn"></div>
										</div>
									</div>
									<div id="workarea">



										<div id="workarea-content">
										<?$APPLICATION->ShowViewContent("topblock")?>
										<?CPageOption::SetOptionString("main.interface", "use_themes", "N"); //For grids?>
