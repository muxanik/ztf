<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (
	!$arResult["FatalError"]
	&& !$arResult["CurrentUserPerms"]["Operations"]["viewprofile"]
)
{
	$arResult["FatalError"] = GetMessage("SONET_P_USER_ACCESS_DENIED");
}

if (!$arResult["FatalError"])
{
	global $USER;
	$arResult['CAN_EDIT_USER'] = ($arResult["CurrentUserPerms"]["Operations"]["modifyuser"] && $arResult["CurrentUserPerms"]["Operations"]["modifyuser_main"]);

	if(!IsModuleInstalled("bitrix24") && CModule::IncludeModule("socialnetwork") && $USER->IsAdmin($USER->GetID())
	)
	{
		$arResult['CAN_EDIT_USER'] = $arResult['CAN_EDIT_USER'] && CSocNetUser::IsCurrentUserModuleAdmin();
	}

	// subordinate
	if((!CModule::IncludeModule("extranet") || !CExtranet::IsExtranetSite() || CExtranet::IsIntranetUser()) && CModule::IncludeModule("iblock")
	)
	{
		$subordinate_users = array();
		if(is_array($arResult["DEPARTMENTS"]))
		{
			foreach($arResult["DEPARTMENTS"] as $key => $dep)
			{
				$dbUsers = CUser::GetList($o = "", $b = "", array(
						"!ID" => $arResult["User"]["ID"],
						'UF_DEPARTMENT' => $dep["ID"],
						'ACTIVE' => 'Y',
						'CONFIRM_CODE' => false
					), array('FIELDS' => array("ID", "NAME", "LAST_NAME", "SECOND_NAME", "LOGIN", "WORK_POSITION")));

				while($arRes = $dbUsers->GetNext())
				{
					$subordinate_users[$arRes["ID"]] = $arRes;
				}
			}
		}
		$arResult["SUBORDINATE"] = $subordinate_users;
	}

	// user activity status
	if($arResult["User"]["ACTIVE"] == "Y")
	{
		$arResult["User"]["ACTIVITY_STATUS"] = "active";
	}

	$obUser = new CUser();
	$arGroups = $obUser->GetUserGroup($arResult["User"]['ID']);
	if(in_array(1, $arGroups))
	{
		$arResult["User"]["ACTIVITY_STATUS"] = "admin";
	}

	$arGroups = CUser::GetUserGroup($arResult["User"]['ID']);
	if(
		CModule::IncludeModule('extranet')
		&& in_array(CExtranet::GetExtranetUserGroupID(), $arGroups)
		&& (
			!is_array($arResult["User"]['UF_DEPARTMENT'])
			|| empty($arResult["User"]['UF_DEPARTMENT'][0])
		)
	)
	{
		$arResult["User"]["ACTIVITY_STATUS"] = "extranet";
		$arResult["User"]["IS_EXTRANET"] = true;
	}
	else
	{
		$arResult["User"]["IS_EXTRANET"] = false;
	}

	if($arResult["User"]["ACTIVE"] == "N")
	{
		$arResult["User"]["ACTIVITY_STATUS"] = "fired";
	}

	if (
		$arResult["User"]["ACTIVE"] == "Y"
		&& !empty($arResult["User"]["CONFIRM_CODE"])
	)
	{
		$arResult["User"]["ACTIVITY_STATUS"] = "invited";
	}

	if(
		$arResult["User"]["ID"] == $GLOBALS["USER"]->GetID()
		&& CSocNetUser::IsCurrentUserModuleAdmin(SITE_ID, false)
		&& !isset($_SESSION["SONET_ADMIN"])
	)
	{
		$arResult["SHOW_SONET_ADMIN"] = true;
	}
}

if (\Bitrix\Main\Loader::includeModule("security"))
{
	$arResult["IS_OTP_RECOVERY_CODES_ENABLE"] = \Bitrix\Security\Mfa\Otp::isRecoveryCodesEnabled();
}
?>