<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if(isset($_GET['status'])){
    if($_GET['status'] === 'success'){
        echo "��� ����� ������� ������� � ������� ��������� ������� <a href=\"http://mandarinbank.com\" target=\"_blank\">�������� ����</a>";

    } else {
        echo "��������� ������ ������ ������ � ������� ��������� ������� <a href=\"http://mandarinbank.com\" target=\"_blank\">�������� ����</a><br>! ���������� ��� ���.";
    }
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
