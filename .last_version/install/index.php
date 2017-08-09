<?php
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

IncludeModuleLangFile(__FILE__);

Class mandarinbank_pay extends CModule
{
    const MODULE_ID = 'mandarinbank.pay';
    var $MODULE_ID = 'mandarinbank.pay';
    var $MODULE_VERSION = '1.0.4';
    var $MODULE_VERSION_DATE = "2017-08-09";
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;

    var $strError = '';

    function __construct(){
        include_once('version.php');

        if(is_array($arModuleVersion) && array_key_exists('VERSION',$arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->PARTNER_NAME = 'vuchastyi';
        $this->PARTNER_URI = 'https://'.'github.com/vuchastyi';
        $this->MODULE_NAME = GetMessage('MANDARIN_MODULE_NAME_HOSTED');
        $this->MODULE_DESCRIPTION = GetMessage('MANDARIN_MODULE_DESC_HOSTED');
    }

    function InstallEvents(){return true;}
    function UnInstallEvents(){return true;}

    function rmFolder($dir){
        if(is_dir($dir)){
            $objects = scandir($dir);
            foreach($objects as $object){
                if($object !== '.' && $object !== '..'){
                    if(filetype($dir.'/'.$object) === 'dir')$this->rmFolder($dir.'/'.$object);else unlink($dir.'/'.$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function copyDir($source,$destination){
        if(is_dir($source)){
            @mkdir($destination,0755);
            $directory = dir($source);
            while(FALSE !== ($readdirectory = $directory->read())){
                if($readdirectory === '.' || $readdirectory === '..')continue;

                $PathDir = $source . '/' . $readdirectory;
                if(is_dir($PathDir)){
                    $this->copyDir($PathDir,$destination.'/'.$readdirectory);
                    continue;
                }
                copy($PathDir,$destination.'/'.$readdirectory);
            }
            $directory->close();
        }else copy($source,$destination);
    }

    function InstallFiles($arParams = array()) {
        if (!is_dir($dir_spm = $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_payment/')){
            mkdir($dir_spm,0755);
        }

        if (!is_dir($dir_pay = $_SERVER['DOCUMENT_ROOT'].'/payment/')){
            mkdir($dir_pay,0755);
        }

        if(is_dir($source = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install')) {
            $this->copyDir("$source/sale_payment", $dir_spm);
            $this->copyDir("$source/payment", $dir_pay);
        }
        return true;
    }

    function UnInstallFiles() {
        $this->rmFolder($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_payment/mandarinbank_hosted');
        $this->rmFolder($_SERVER['DOCUMENT_ROOT'].'/payment/mandarinbank_hosted');
        return true;
    }
    function DoInstall() {
        $this->InstallFiles();
        ModuleManager::registerModule(self::MODULE_ID);
    }
    function DoUninstall() {
        ModuleManager::unRegisterModule(self::MODULE_ID);
        $this->UnInstallFiles();
    }
}
