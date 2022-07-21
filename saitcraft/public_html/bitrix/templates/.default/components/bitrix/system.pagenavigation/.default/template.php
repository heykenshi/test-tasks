<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
?>
<nav class="d-flex justify-content-center w-100" aria-label="Page navigation">
    <?= $arResult["NavTitle"] ?>
    <? if ($arResult["bDescPageNumbering"] === true): ?>
        <?= $arResult["NavFirstRecordShow"] ?> <?= GetMessage("nav_to") ?> <?= $arResult["NavLastRecordShow"] ?> <?= GetMessage("nav_of") ?> <?= $arResult["NavRecordCount"] ?>

        <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
            <? if ($arResult["bSavePage"]): ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= GetMessage("nav_begin") ?></a>
                |
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_prev") ?></a>
                |
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_begin") ?></a>
                |
                <? if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)): ?>
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_prev") ?></a>
                    |
                <? else: ?>
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_prev") ?></a>
                    |
                <? endif ?>
            <? endif ?>
        <? else: ?>
            <?= GetMessage("nav_begin") ?>&nbsp;|&nbsp;<?= GetMessage("nav_prev") ?>&nbsp;|
        <? endif ?>

        <? while ($arResult["nStartPage"] >= $arResult["nEndPage"]): ?>
            <? $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1; ?>

            <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                <b><?= $NavRecordGroupPrint ?></b>
            <? elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false): ?>
                <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
            <? else: ?>
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $NavRecordGroupPrint ?></a>
            <? endif ?>

            <? $arResult["nStartPage"]-- ?>
        <? endwhile ?>

        |

        <? if ($arResult["NavPageNomer"] > 1): ?>
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_next") ?></a>
            |
            <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= GetMessage("nav_end") ?></a>
        <? else: ?>
            <?= GetMessage("nav_next") ?>&nbsp;|&nbsp;<?= GetMessage("nav_end") ?>
        <? endif ?>

    <? else: ?>
        <ul class="pagination">
            <? if ($arResult["NavPageNomer"] > 1): ?>

                <? if ($arResult["bSavePage"]): ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"></a>
                    </li>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
                    </li>
                <? else: ?>
                    <? if ($arResult["NavPageNomer"] > 2): ?>
                        <li class="page-item"><a class="page-link"
                                                 href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>"><?= GetMessage("nav_prev") ?></a>
                        </li>
                    <? else: ?>
                        <li class="page-item"><a class="page-link"
                                                 href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= GetMessage("nav_prev") ?></a>
                        </li>
                    <? endif ?>
                <? endif ?>
            <? endif ?>

            <? while ($arResult["nStartPage"] <= $arResult["nEndPage"]): ?>

                <? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
                    <li class="page-item"><b class="page-link"><?= $arResult["nStartPage"] ?></b></li>
                <? elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                    </li>
                <? else: ?>
                    <li class="page-item"><a class="page-link"
                                             href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"><?= $arResult["nStartPage"] ?></a>
                    </li>
                <? endif ?>
                <? $arResult["nStartPage"]++ ?>
            <? endwhile ?>

            <? if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
                <li class="page-item"><a class="page-link"
                                         href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>"><?= GetMessage("nav_next") ?></a>
                </li>
            <? endif ?>
        </ul>
    <? endif ?>

    <? if ($arResult["bShowAll"]): ?>
        <noindex>
            <? if ($arResult["NavShowAll"]): ?>
                |&nbsp;<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=0"
                        rel="nofollow"><?= GetMessage("nav_paged") ?></a>
            <? else: ?>
                |&nbsp;<a
                        href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>SHOWALL_<?= $arResult["NavNum"] ?>=1"
                        rel="nofollow"><?= GetMessage("nav_all") ?></a>
            <? endif ?>
        </noindex>
    <? endif ?>
</nav>